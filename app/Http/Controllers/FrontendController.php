<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\HoldOrder;
use App\Models\Order;
use Carbon\Carbon;
use Session;
use Stripe;

class FrontendController extends Controller
{
    public function index()
    {
        return view('front.book');
    }

    public function showMap()
    {
        return view('front.map');
    }

    public function insertMap(Request $request)
    {
        if(isset($request->map_id) && $request->map_id)
        {
            $maps = Map::whereIn('id', $request->map_id)->with('maps')->get();
            $map_id = json_encode($request->map_id);
            return view('front.index', compact('maps', 'map_id'));
        }else{
            return redirect()->back()->with('error', __('Nessun dato selezionato'));
        }
    }

    public function calculationMap(Request $request)
    {
        $data = [];
        $data['start_date'] = date('d/m/Y', strtotime($request->from));
        $data['end_date']   = date('d/m/Y', strtotime($request->to));
        $data['map'] = Map::whereIn('id', json_decode($request->map_id))->with('maps')->get();
        return view('front.calculation', compact('data'));
        //return $data['map'][0]['maps']->morning_price;
    }

    public function stripePayment(Request $request)
    {
        return view('front.stripe');
        //return $request->all();
    }

    public function makePayment(Request $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $data = Stripe\Charge::create (
                [
                    "amount" =>  $request->final_amount,
                    "currency" => "eur",
                    "source" => $request->stripeToken,
                    "description" => "",
                    "metadata" => [
                        "accessory" => $request->accessory_id,
                        "numerodipersone" => $request->numerodipersone,
                        "price_type" => $request->price_type,
                        "maps" => json_decode($request->map_id),
                        "from" => $request->from,
                        "to" => $request->to
                    ]
                ]
            );

            if($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1 && $data['status'] == 'succeeded')
            {
                $order          =   new Order();
                $order->name    = $data["metadata"]["name"];
                $order->email   = $data["metadata"]["email"];
                $order->mobile_number = $data["metadata"]["mobile_number"];
                 

                $maps = Map::whereIn('id', json_decode($data["metadata"]["maps"]))->with('maps')->get();
                $begin = new \DateTime( date('Y-m-d', strtotime($data["metadata"]["from"]) ));
                $end = new \DateTime( date('Y-m-d', strtotime($data["metadata"]["to"])) );
                $end = $end->modify( '+1 day' );
                $interval = new \DateInterval('P1D');
                $daterange = new \DatePeriod($begin, $interval ,$end);
                foreach($daterange as $date){
                    foreach ($maps as $key => $item){
                        $accessoryData = explode(",", $data["metadata"]["accessory"]);
                        $accessory = \App\Models\Accesory::find($accessoryData[$key]);

                        $hold_order  = new HoldOrder();
                        $hold_order->map_id = $item->id;
                        $hold_order->order_id = $order->id;
                        $hold_order->booked_date = Carbon::parse($date->format('d-m-Y'));
                        $hold_order->accessory_id = !empty($accessory->id) ? $accessory->id : '';
                        $hold_order->persons = $data["metadata"]["numerodipersone"];
                        $hold_order->day = $data["metadata"]["price_type"];
                        $hold_order->amount = $price;
                        $hold_order->save();
                    }
                }
            }else{
                return redirect()->back()->with('error', __('Payment cannot be processed'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
            //return $e;
        }
    }
}
