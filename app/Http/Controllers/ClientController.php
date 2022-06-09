<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Yajra\DataTables\DataTables;
use App\Models\Order;
use Auth;
use Validator;

class ClientController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function datatables(Request $request)
    {
        $client = Customer::orderBy('id', 'DESC')->get();

        if($request->ajax())
        {
            return Datatables::of($client)
                        ->editColumn('customer_name', function(Customer $customer) {
                            return $customer->first_name.' '.$customer->last_name;
                        })
                        ->editColumn('report', function(Customer $customer) {
                            return '<a href=" '.route('client.show', $customer->id).' " class="btn btn-link bg-light"><i class="fa fa-eye"></i></a>';
                        })
                        ->addColumn('action', function(Customer $data) {
                            return '<a href=" '.route('client.edit', $data->id).'?id='.$data->id.' " class="btn btn-link btn-sm color-400"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0);" onclick="deleteAction(&quot;' . route('client.destroy', $data->id).'?id='.$data->id . '&quot)" class="btn btn-link btn-sm color-400"><i class="fa fa-trash"></i></a>';
                        })
                        ->rawColumns(['report', 'customer_name', 'action'])
                        ->toJson();
        }
    }

    public function index()
    {
        if(Auth::user()->can('Manage Customer'))
        {
            return view('client.index');
        }else{
            return redirect()->back()->with('error', __('Permesso negato.'));
        }
    }

    public function create()
    {
        if(Auth::user()->can('Create Customer'))
        {
            return view('client.create');
        }else{
            return redirect()->back()->with('error', __('Permesso negato.'));
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:customers,email',
            'mobile_number' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $input = $request->all();
        Customer::create($input);
        return redirect()->route("client.index")->with("success", __("Informazioni create con successo."));
    }

    public function edit(Request $request)
    {
        if(Auth::user()->can('Edit Customer'))
        {
            $customer = Customer::findorfail($request->id);
            return view('client.edit', compact('customer'));
        }else{
            return redirect()->back()->with('error', __('Permesso negato.'));
        }
    }

    public function update(Request $request)
    {
        $customer = Customer::findorfail($request->customer_id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:customers,email,' . $customer->id . 'id',
            'mobile_number' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $input = $request->all();
        $customer->update($input);
        return redirect()->route("client.index")->with("success", __("Informazioni modifica con successo."));
    }

    public function show(Customer $client)
    {
        $order = Order::orderBy('id', 'DESC')->where(function($query) use ($client) {
            $query->where('name', $client->first_name.' '.$client->last_name)
            ->orWhere('email', $client->email)
            ->orWhere('mobile_number', $client->mobile_number);
        })->get();
        if(!empty($order))
        {
            return view('client.show', compact('order', 'client'));
        }else{
            return redirect()->back('error', __('No order found for this client'));
        }
    }

    public function destroy(Customer $customer)
    {
        if(Auth::user()->can('Manage Customer'))
        {
            $customer->delete();
            return response()->json(["status" => true, "msg" => __("Informazioni modifica successo")], 200);
        }else{
            return response()->json(["status" => false, "msg" => __("Permesso negato.")], 200);
        }
    }
}
