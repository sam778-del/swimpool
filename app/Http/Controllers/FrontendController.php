<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\HoldOrder;
use App\Mail\OrderReceiveMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Specification;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Stripe;

class FrontendController extends Controller
{
    public function index()
    {
        return view('front.book');
    }

    public function showMap(Request $request)
    {
        $data = [
            'row' => $this->getRow(),
            'column' => $this->getColumn(),
            'mattina' => $this->getFreeBed($request->arrivo, $request->partenza, 2),
            'pomeriggio' => $this->getFreeBed($request->arrivo, $request->partenza, 3),
            'giornata' => $this->getFreeBed($request->arrivo, $request->partenza, 1),
            'data' => $this->getIds($request->arrivo, $request->partenza, $request->giornata)
        ];
        //return view('front.map', compact('data'));
        return $data['data'];
        //return $data['data'];
    }

    public function getFreeBed($from, $to, int $id)
    {
        $map_id = [];
        $hold_order = HoldOrder::where(function($query) use ($from, $to, $id){
            $query->whereBetween('booked_date', [$from, $to]);
        })
        ->where('day', '=', $id)
        ->get();
        foreach($hold_order as $k => $s)
        {
            $map_id[$k] = $s->map_id;
        }
        return Specification::whereNotIn('id', $map_id)->where(function($query) {
            $query->where('type', 'lettino')
            ->orWhere('type', 'gazebo');
        })->get();
    }

    public function getIds($from, $to, int $id)
    {
        $map_id = [];
        $hold_order = HoldOrder::where(function($query) use ($from, $to, $id){
            $query->whereBetween('booked_date', [$from, $to]);
        })
        ->where('day', '=', $id)
        ->get();
        foreach($hold_order as $k => $s)
        {
            $map_id[$k] = $s->map_id;
        }
        return $map_id;
    }

    public function removeSpec(array $map_id)
    {
        return Specification::whereIn('id', '!=', $map_id)->get();
    }

    public function insertMap(Request $request)
    {
        if(isset($request->map_id) && $request->map_id)
        {
            $maps = Specification::whereIn('id', $request->map_id)->get();
            $map_id = json_encode($request->map_id);
            $price_type = $request->price_type;
            $data = [
                'arrivo' => $request->arrivo,
                'partenza' => $request->partenza,
                'giorbata' => $request->price_type
            ];
            return view('front.index', compact('maps', 'map_id', 'price_type', 'data'));
            //return $request->map_id;
        }else{
            return redirect()->back()->with('error', __('Nessun dato selezionato'));
        }
    }

    function remove_empty($array) {
        return array_filter($array, '_remove_empty_internal');
    }

    public function calculationMap(Request $request)
    {
        $data = [];
        $data['start_date'] = $request->from;
        $data['end_date']   = $request->to;
        $data['price_type'] = $request->price_type;
        $data['numerodipersone'] = $request->numerodipersone;
        $data['accesory_id'] = $request->accesory_id;
        $data['map_id'] = $request->map_id;
        $data['map'] = Specification::whereIn('id', json_decode($request->map_id))->get();
        //return $data['map'];
        return view('front.calculation', compact('data'));
        //return $request->all();
        //return $data['map'][0]['maps']->morning_price;
    }

    public function stripePayment(Request $request)
    {
        $data = [];
        $data['from'] = $request->from;
        $data['to']   = $request->to;
        $data['final_amount'] = $request->final_amount;
        $data['price_type'] = $request->price_type;
        $data['numerodipersone'] = $request->numerodipersone;
        $data['accesory_id'] = $request->accesory_id;
        $data['map_id'] = $request->map_id;
        return view('front.stripe', compact('data'));
        //return $request->all();
    }

    public function makePayment(Request $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $data = Stripe\Charge::create (
                [
                    "amount" =>  $request->final_amount * 100,
                    "currency" => "eur",
                    "source" => $request->stripeToken,
                    "description" => "",
                    "metadata" => [
                        "accessory" => $request->accessory_id,
                        "name" => $request->name,
                        "email" => $request->email,
                        "mobile_number" => $request->mobile_number,
                        "numerodipersone" => $request->numerodipersone,
                        "price_type" => $request->price_type,
                        "final_amount" => $request->final_amount,
                        "maps" => json_decode($request->map_id),
                        "from" => $request->from,
                        "to" => $request->to
                    ]
                ]
            );

            if($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1 && $data['status'] == 'succeeded')
            {
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $order                  =   new Order();
                $order->order_id        =   $orderID;
                $order->name            =   $data["metadata"]["name"];
                $order->email           =   $data["metadata"]["email"];
                $order->mobile_number   =   $data["metadata"]["mobile_number"];
                $order->amount          =   $data['metadata']['final_amount'];
                $order->card_number     =   isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '';
                $order->card_exp_month  =   isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '';
                $order->card_exp_year   =   isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '';
                $order->save();

                $maps = Specification::whereIn('id', json_decode($data["metadata"]["maps"]))->get();
                $begin = new \DateTime( $data["metadata"]["from"] );
                $end = new \DateTime( $data["metadata"]["to"] );
                $end = $end->modify( '+1 day' );
                $interval = new \DateInterval('P1D');
                $daterange = new \DatePeriod($begin, $interval ,$end);

                foreach($daterange as $key => $dat){
                    foreach ($maps as $key => $item){
                        $accessoryData = explode(",", $data["metadata"]["accessory"]);
                        $accessory = \App\Models\Accesory::find($accessoryData[$key]);

                        if($accessory)
                        {
                            $accessoryAmount = $accessory->amount;
                        }else{
                            $accessoryAmount = 0;
                        }
                        $price = \App\Models\Specification::getPrice($item->type, $dat->format('Y-m-d'), $data["metadata"]["price_type"]);

                        $hold_order  = new HoldOrder();
                        $hold_order->map_id = $item->id;
                        $hold_order->amount = $price + $accessoryAmount;
                        $hold_order->name = $item->type.' '.$item->spec_id;
                        $hold_order->order_id = $order->id;
                        $hold_order->booked_date = Carbon::parse($dat->format('Y-m-d'));
                        $hold_order->accessory_id = !empty($accessory->id) ? $accessory->id : 0;
                        $hold_order->persons = $data["metadata"]["numerodipersone"];
                        $hold_order->day = $data["metadata"]["price_type"];
                        $hold_order->save();
                    }
                }

                $user = User::where(function($query) {
                    $query->where('parent_id', '=', 0)
                    ->orWhere('parent_id', '=', 1);
                })->get();

                if(!empty($user))
                {
                    foreach ($user as $key => $us) {
                        Mail::to($us->email)->send(new OrderReceiveMail($orderID, $order->amount ));
                    }
                }
                Mail::to($data["metadata"]["email"])->send(new OrderReceiveMail($orderID, $amount));
                return redirect()->intended('/')->with('success', __('Order Placed Succesfully!'));
            }else{
                return redirect()->back()->with('error', __('Payment cannot be processed'));
            }
        } catch (\Exception $e) {
           return redirect()->intended('/')->with('error', $e->getMessage());
        }
    }

    public function checkValid(Request $request)
    {
        // if(Carbon::parse($request->partenza) <= date('d-m', strtotime('19-09')))
        // {
            
        // }else{
        //     return redirect()->back()->with('error', __('Siamo chiusi'));
        // }
        switch ($request->method()) {
            case 'POST':
                $data = [
                    'row' => $this->getRow(),
                    'column' => $this->getColumn(),
                    'mattina' => $this->getFreeBed(date('Y-m-d', strtotime($request->arrivo)), date('Y-m-d', strtotime($request->partenza)), 2),
                    'pomeriggio' => $this->getFreeBed(date('Y-m-d', strtotime($request->arrivo)), date('Y-m-d', strtotime($request->partenza)), 3),
                    'giornata' => $this->getFreeBed(date('Y-m-d', strtotime($request->arrivo)), date('Y-m-d', strtotime($request->partenza)), 1),
                    'data' => $this->getIds(date('Y-m-d', strtotime($request->arrivo)), date('Y-m-d', strtotime($request->partenza)), $request->day),
                    'arrivo' => $request->arrivo,
                    'partenza' => $request->partenza,
                    'giorbata' => $request->day
                ];
                return view('front.map', compact('data'));
                //return $data['data'];
                break;
    
            case 'GET':
                return redirect()->intended('/');
                break;
    
            default:
                return redirect()->intended('/');
                break;
        }
    }

    public function getRow()
    {
        $rowArray = range(1, env('front'));
        return $rowArray;
    }

    public function getColumn()
    {
        $rowArray = range(1, env('column'));
        return $rowArray;
    }
}
