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

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}
