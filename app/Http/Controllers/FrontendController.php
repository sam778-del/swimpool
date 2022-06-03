<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
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
                $maps = Map::whereIn('id', json_decode($data["metadata"]["maps"]))->with('maps')->get();
                return $maps;
            }else{
                return redirect()->back()->with('error', __('Payment cannot be processed'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
