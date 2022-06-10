<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('report.index');
    }

    public function create(Request $request)
    {
        $data = $this->getOrderChart(explode(' - ', $request->date));
        return response()->json(['html' => $data], 200);
    }

    public function getOrderChart(array $arrayParam)
    {
        $begin = new \DateTime( $arrayParam[0] );
        $end = new \DateTime( $arrayParam[1] );
        $end = $end->modify( '+1 day' );
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);

        $arrTask = [];

        foreach($daterange as $key => $dat){
            $data               = Order::select(\DB::raw('SUM(amount) as total'))->whereDate('created_at', '=', $dat->format('Y-m-d'))->first();
            $arrTask['label'][] = $dat->format('Y-m-d');
            $arrTask['data'][]  = $data->total;
        }
        return $arrTask;
    }
}
