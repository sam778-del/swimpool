<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\ExtraAmount;
use Validator;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $order = Price::orderBy('id', 'DESC')->with('extraprice')->get();
        return view('price.index', compact('order'));
    }

    public function edit(Price $price)
    {
        $extraprice = ExtraAmount::where('price_id', $price->id)->get();
        return view('price.edit', compact('price', 'extraprice'));
    }

    public function update(Request $request, Price $price)
    {
        $validator = Validator::make($request->all(), [
           // 'date.*' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with("error", $validator->errors()->first());
        }
        // $price->type = $request->nome; 
        $price->fullday_amount = $request->fullday_amount;
        $price->morning_amount = $request->morning_amount;
        $price->afternoon_amount = $request->afternoon_amount;
        $price->save();

        $date = $request->input('date');
        $amount = $request->input('amount');
        $nome = $request->input('order_name');

        ExtraAmount::where('price_id', $price->id)->delete();

        if(!empty($date))
        {
            foreach ($date as $key => $value) {
                $extra_amount = new ExtraAmount();
                $extra_amount->price_id = $price->id;
                $extra_amount->order_name = $nome[$key];
                $extra_amount->date = $date[$key];
                $extra_amount->amount = $amount[$key];
                $extra_amount->save();
            }
        }
        return redirect()->route("price.index")->with("success", __("Informazioni create con successo."));
    }
}
