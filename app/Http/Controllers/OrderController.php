<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Order;
use App\Models\HoldOrder;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function datatables()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return Datatables::of($orders)
                        ->editColumn('amount', function(Order $order) {
                            return '<p class="text-center">&euro;' . $order->amount . '</p>';
                        })
                        ->editColumn('type', function(Order $order) {
                            if(!empty($order->card_number) && !empty($order->card_exp_month) && !empty($order->card_exp_year))
                            {
                                return '<p class="text-center">' . 'Card'. '</p>';
                            }else{
                                return '<p class="text-center">' . 'Cash'. '</p>';
                            }
                        })
                        ->editColumn('action', function(Order $order) {
                            return '<a href=" '.route('order.show', $order->id).' " class="btn btn-link bg-light"><i class="fa fa-eye"></i></a>';
                        })
                        ->rawColumns(['type', 'amount', 'action'])
                        ->toJson();
    }

    public function index()
    {
        if(Auth::user()->can('Manage Order'))
        {
            return view('order.index');
        }else{
            return redirect()->back()->with('error', __('Permesso negato.'));
        }
    }

    public function show(Order $order)
    {
        if(Auth::user()->can('Manage Order'))
        {
            $data['maps'] = HoldOrder::where('order_id', $order->id)->get();
            if(!empty($data['maps']))
            {
                return view('order.show', compact('data', 'order'));
            }else{
                abort(404);
            }
        }else{
            return redirect()->back()->with('error', __('Permesso negato.'));
        }
    }
}
