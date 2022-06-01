<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use Auth;


class UserController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth'); 
    }

    public function datatables(Request $request)
    {
        $operator = User::orderBy('id', 'DESC')->where(function($query) {
                        $query->where('parent_id', '=', 0)
                            ->where('parent_id', '=', 1)
                            ->orWhere('is_active', '=', 1);
                    })->get();
        if($request->ajax())
        {   
            return Datatables::of($operator)
                            ->editColumn('avatar', function (User $operator) {
                                $avatar = !empty($operator->avatar) ? asset(Storage::url($operator->avatar)) : asset('images/avatar.png');
                                return '<div class="d-flex align-items-center"><img src=' . $avatar  . ' class="rounded-circle sm avatar" alt=""></div>';
                            })
                            ->editColumn('type', function(User $operator) {
                                $op_badge = $operator->parent_id == 0 ? 'Admin' : 'Operator';
                                return '<p class="text-center"><span class="badge bg-success">' . $op_badge . '</span></p>';
                            })
                            ->addColumn('action', function(User $data) {
                                if($data->parent_id == 1)
                                {
                                    return '<a href=" '.route('operator.edit', $data->id).' " class="btn btn-link btn-sm color-400"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0);" onclick="deleteAction(&quot;' . route('operator.destroy', $data->id) . '&quot)" class="btn btn-link btn-sm color-400"><i class="fa fa-trash"></i></a>';
                                }else{
                                    return '<a href=" '.route('operator.edit', $data->id).' " class="btn btn-link btn-sm color-400"><i class="fa fa-pencil"></i></a>';
                                }
                            })
                            ->rawColumns(['avatar', 'type', 'action'])
                            ->toJson();
        }
    }

    public function index()
    {
        if(Auth::user()->can('Manage User'))
        {
            return view('operator.index');
        }else{
            return redirect()->back()->with('error', __('Permesso negato'));
        }
    }

    public function create()
    {
        if(Auth::user()->can('Create User'))
        {
            return view('operator.create');
        }else{
            return redirect()->back()->with('error', __('Permesso negato.'));
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('Create User'))
        {
            $validator = Validator::make($request->all(), [
                'operator_name' => 'required|max:100',
                'operator_email' => 'required|email|unique:users,email',
                'operator_password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirm_operator_password' => 'required_with:operator_password|same:operator_password|min:6'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->with("error", $validator->errors()->first());
            }

            $operator               = new User();
            $operator->name         = $request->input('operator_name');
            $operator->email        = $request->input('operator_email');
            $operator->password     = Hash::make($request->input('password')); 
            $operator->is_active    = 1;
            $operator->parent_id    = $request->input('parent_id');
            $operator->save();

            return redirect()->route("operator.index")->with("success", __("Informazioni create con successo."));
        }else{
            return redirect()->back()->with("error", __("Permesso negato."));
        }
    }

    public function edit(User $operator)
    {
        if(Auth::user()->can('Edit User'))
        {
            return view('operator.edit', compact('operator'));
        }else{
            return redirect()->back()->with("error", __("Permesso negato.")); 
        }
    }

    public function update(Request $request, User $operator)
    {
        if(Auth::user()->can('Edit User'))
        {
            $validator = Validator::make($request->all(), [
                'operator_name' => 'required|max:100',
                'operator_email' => 'required|email|unique:users,email,' . $operator->id. 'id',
                'operator_password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirm_operator_password' => 'required_with:operator_password|same:operator_password|min:6'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->with("error", $validator->errors()->first());
            }

            $operator->name         = $request->input('operator_name');
            $operator->email        = $request->input('operator_email');
            $operator->password     = Hash::make($request->input('password')); 
            $operator->is_active    = 1;
            $operator->parent_id    = $request->input('parent_id');
            $operator->save();

            return redirect()->route("operator.index")->with("success", __("Informazioni modifica successo."));
        }else{
            return redirect()->back()->with("error", __("Permesso negato."));
        }
    }

    public function destroy(User $operator)
    {
        if(Auth::user()->can('Delete User'))
        {
            $operator->is_active = 0;
            $operator->save();
            return response()->json(["status" => true, "msg" => __("Informazioni modifica successo")], 200);
        }else{
            return response()->json(["status" => false, "msg" => __("Permesso negato.")], 200);
        }
    }
}
