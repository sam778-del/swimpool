<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Accesory;
use Validator;
use Auth;

class AccesoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function datatables(Request $request)
    {
        if($request->ajax())
        {
            $mcuap = Accesory::orderBy('id', 'DESC')->get();
            return Datatables::of($mcuap)
                            ->addColumn('action', function(Accesory $data) {
                                return '<a href=" '.route('accessory.edit', $data->id).' " class="btn btn-link btn-sm color-400"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0);" onclick="deleteAction(&quot;' . route('accessory.destroy', $data->id) . '&quot)" class="btn btn-link btn-sm color-400"><i class="fa fa-trash"></i></a>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();
        }
    }

    public function index()
    {
        return view('accessory.index');
    }

    public function create()
    {
        return view('accessory.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'type' => 'required',
            'amount' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        $access = new Accesory();
        $access->name = $request->input('name');
        $access->type = $request->input('type');
        $access->amount = $request->input('amount');
        $access->save();
        return redirect()->route('accessory.index')->with("success", __("Informazioni create con successo."));
    }

    public function edit()
    {

    }

    public function destroy(Accesory $accesory)
    {
        if(Auth::user()->can('Delete Accessories'))
        {
            $accesory->delete();
            return response()->json(["status" => true, "msg" => __("Informazioni modifica successo")], 200);
        }else{
            return response()->json(["status" => false, "msg" => __("Permesso negato.")], 200);
        }
    }
}
