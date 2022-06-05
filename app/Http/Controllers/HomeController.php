<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($lang = '')
    {
        $data = [
            'getOrderChart' => $this->getOrderChart(['duration' => 'week']),
            'todayOrder' => Order::whereDate('created_at', Carbon::now())->sum('amount'),
            'monthOrder' => Order::select(DB::raw('month(created_at) as month'))->sum('amount'),
            'yearOrder'  => Order::sum('amount'),
            'totalCustomer' => count(Customer::get()),
            'totalOperator' => $this->getTotalOperator()

        ];
        //return print_r($this->getOrderChart(['duration' => 'week']));
        return view('dashboard.sa_home', compact('data'));
    }

    public function getTotalOperator()
    {
        return User::orderBy('id', 'DESC')->where(function($query) {
            $query->where('parent_id', '=', 0)
                ->where('parent_id', '=', 1)
                ->orWhere('is_active', '=', 1);
        })->get();
    }

    public function getOrderChart(array $arrParam)
    {
        $arrDuration = [];
        if($arrParam['duration'])
        {
            if($arrParam['duration'] == 'week')
            {
                $previous_week = strtotime("-2 week +1 day");

                for($i = 0; $i < 14; $i++)
                {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);

                    $previous_week = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }
        $arrTask = [];
        foreach($arrDuration as $date => $label)
        {
            $data               = Order::select(DB::raw('SUM(amount) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }

        return $arrTask;
    }
}
