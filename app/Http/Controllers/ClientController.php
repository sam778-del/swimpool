<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ClientController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function datatables(Request $request)
    {
        $client = User::orderBy('id', 'DESC')
                    ->where('parent_id', '=', 2)
                    ->where('is_active', '=', 1)
                    ->get();

        if($request->ajax())
        {
            return Datatables::of($client)
                    ->rawColumns(['total_order', 'order_history', 'avatar', 'type', 'action'])
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
}
