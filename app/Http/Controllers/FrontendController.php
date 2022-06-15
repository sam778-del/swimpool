<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\HoldOrder;
use App\Mail\OrderReceiveMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Specification;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Soccer;
use Auth;
use Session;
use Stripe;

class FrontendController extends Controller
{
    private $hold_order_id;
    
    public function __construct(Request $request)
    {
        if($request->route()->getName() == 'check-valid')
        {
            $this->hold_order_id =  $this->getHoldMap($request->arrivo, $request->type);
        }
        //$this->hold_order_id =  $this->getHoldMap($request->arrivo, $request->type);
    }

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
        //return view('front.ap', compact('data'));
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
        $data['from'] = $request->arrivo;
        $data['item_id'] = $request->item_id;
        $data['day'] = $request->day;
        $data['final_amount'] = Soccer::findorfail($request->item_id);
        if($request->player)
        {
            $data['player'] = $request->player;
        }else{
            $data['player'] = '';
        }
        return view('front.stripe', compact('data'));
        //return $request->all();
    }

    public function makePayment(Request $request)
    {
        try {
            if(Auth::guest())
            {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $data = Stripe\Charge::create (
                    [
                        "amount" =>  $request->final_amount * 100,
                        "currency" => "eur",
                        "source" => $request->stripeToken,
                        "description" => "",
                        "metadata" => [
                            "name" => $request->name,
                            "email" => $request->email,
                            "mobile_number" => $request->mobile_number,
                            "day" => $request->day,
                            "player" => $request->player,
                            "final_amount" => $request->final_amount,
                            "from" => $request->from,
                            "item_id" => $request->item_id
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

                    $soccer = Soccer::findorfail($data["metadata"]["item_id"]);
    
                    if(!empty($soccer))
                    {
                        $hold_order  = new HoldOrder();
                        $hold_order->map_id = $soccer->id;
                        $hold_order->amount = $data['metadata']['final_amount'];
                        $hold_order->name = $soccer->name;
                        $hold_order->order_id = $order->id;
                        $hold_order->booked_date = date("Y-m-d H:i:s", strtotime($data["metadata"]["from"]));
                        $hold_order->day = $data["metadata"]["day"];
                        $hold_order->persons = !empty($data["metadata"]["player"]) ? $data["metadata"]["player"] : 0;
                        $hold_order->save();
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
            }else{
                $customer = Customer::findorfail($request->client_id);
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
    
                $order                  =   new Order();
                $order->order_id        =   $orderID;
                $order->name            =   $customer->first_name.' '.$customer->last_name;
                $order->email           =   $customer->email;
                $order->mobile_number   =   $customer->mobile_number;
                $order->amount          =   $request->final_amount;
                $order->save();

                $soccer = Soccer::findorfail($request->item_id);
    
                if(!empty($soccer))
                {
                    $hold_order                 = new HoldOrder();
                    $hold_order->map_id         = $soccer->id;
                    $hold_order->amount         = $request->final_amount;
                    $hold_order->name           = $soccer->name;
                    $hold_order->order_id       = $order->id;
                    $hold_order->booked_date    = date("Y-m-d H:i:s", strtotime($request->from));
                    $hold_order->day            = $request->day;
                    $hold_order->persons = !empty($request->player) ? $request->player : 0;
                    $hold_order->save();
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
                Mail::to($customer->email)->send(new OrderReceiveMail($orderID, $amount));
                return redirect()->route('order.index')->with('success', __('Order Placed Succesfully!'));
            }
        } catch (\Exception $e) {
            if(Auth::guest())
            {
                return redirect()->intended('/')->with('error', $e->getMessage());
            }else{
                return redirect()->route('order.index')->with('error', $e->getMessage());
            }
          // return $e->getMessage();
        }
    }

    public function checkValid(Request $request)
    {
        $date = strtolower(date('l', strtotime($request->arrivo)));
        if($request->type == 'soccer1' || $request->type == 'soccer2')
        {
            if($date == 'saturday' || $date == 'sunday')
            {
                return redirect()->intended('/')->with('error', "Booking can only be made from Monday to friday for soccer1 and soccer2");
            }
        }

        switch ($request->type == 'tennis') {
            case $date == 'saturday':
                break;
            
            case $date == 'sunday':
                break;
            
            default:
                return redirect()->intended('/')->with('error', "Booking can only be made from Satruday to Sunday for tennis");
                break;
        }

        switch ($request->method()) {
            case 'POST':
                $data = [
                    'arrivo' => $request->arrivo,
                    'partenza' => $request->partenza,
                    'giorbata' => $request->day,
                    'type' => $request->type,
                    'booked' => $this->getBookedSoccer($request->type),
                    'map' => $this->getSoccer($request->type),
                    'holdmap' => $this->getHoldMap($request->arrivo, $request->type),
                ];
                return view('front.ap', compact('data'));
                //return $this->hold_order_id;
                break;
    
            case 'GET':
                return redirect()->intended('/');
                break;
    
            default:
                return redirect()->intended('/');
                break;
        }
    }

    public function getHoldMap(String $date, String $type)
    {
        $hold_order = [];

        if($type == 'soccer1')
        {
            $holdorder =  HoldOrder::whereDate('booked_date', Carbon::parse($date))
                            ->where('name', '=', 'soccer camp 1')
                            ->get(['map_id']);
            foreach ($holdorder as $key => $value) {
                $hold_order[$key] = $value->map_id;
            }
        }

        if($type == 'soccer2')
        {
            $holdorder =  HoldOrder::whereDate('booked_date', Carbon::parse($date))
                            ->where('name', '=', 'soccer camp 2')
                            ->get(['map_id']);
            foreach ($holdorder as $key => $value) {
                $hold_order[$key] = $value->map_id;
            }
        }

        if($type == 'tennis')
        {
            $holdorder =  HoldOrder::whereDate('booked_date', Carbon::parse($date))
                            ->where('name', '=', 'tennis')
                            ->get(['map_id']);
            foreach ($holdorder as $key => $value) {
                $hold_order[$key] = $value->map_id;
            }
        }
        return $hold_order;
    }

    public function getSoccer(String $type)
    {
        if($type == 'soccer1')
        {
            return Soccer::whereNotIn('id', $this->hold_order_id)->where(function($query) {
                $query->where('type', 'soccer camp 1');
            })->get();
        }

        if($type == 'soccer2')
        {
            return Soccer::whereNotIn('id', $this->hold_order_id)->where(function($query) {
                $query->where('type', 'soccer camp 2');
            })->get();
        }

        if($type == 'tennis')
        {
            if(strtolower(date('l')) == 'saturday')
            {
                return Soccer::whereNotIn('id', $this->hold_order_id)->where(function($query) {
                    $query->where('type', 'tennis option 1')
                    ->orWhere('type', 'tennis option 1 night')
                    ->orWhere('type', 'tennis option 2')
                    ->orWhere('type', 'tennis')
                    ->orWhere('type', 'tennis option 2 night');
                })->get();
            }else{
                return Soccer::whereNotIn('id', $this->hold_order_id)->where(function($query) {
                    $query->where('type', 'tennis option 1')
                    ->orWhere('type', 'tennis option 1 night')
                    ->orWhere('type', 'tennis option 2')
                    ->orWhere('type', 'tennis')
                    ->orWhere('type', 'tennis option 2 night');
                })->get();
            }
        }
    }

    public function getBookedSoccer(String $type)
    {
        if($type == 'soccer1')
        {
            return Soccer::whereIn('id', $this->hold_order_id)->where(function($query) {
                $query->where('type', 'soccer camp 1');
            })->get();
        }

        if($type == 'soccer2')
        {
            return Soccer::whereIn('id', $this->hold_order_id)->where(function($query) {
                $query->where('type', 'soccer camp 2');
            })->get();
        }

        if($type == 'tennis')
        {
            if(strtolower(date('l')) == 'saturday')
            {
                return Soccer::whereIn('id', $this->hold_order_id)->where(function($query) {
                    $query->where('type', 'tennis option 1')
                    ->orWhere('type', 'tennis option 1 night')
                    ->orWhere('type', 'tennis option 2')
                    ->orWhere('type', 'tennis')
                    ->orWhere('type', 'tennis option 2 night');
                })->get();
            }else{
                return Soccer::whereIn('id', $this->hold_order_id)->where(function($query) {
                    $query->where('type', 'tennis option 1')
                    ->orWhere('type', 'tennis option 1 night')
                    ->orWhere('type', 'tennis option 2')
                    ->orWhere('type', 'tennis')
                    ->orWhere('type', 'tennis option 2 night');
                })->get();
            }
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
