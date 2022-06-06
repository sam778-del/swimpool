<?php

namespace App\Models;
use App\Models\Price;
use App\Models\ExtraAmount;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $table = 'table_specification';

    public function getOuterSpec(int $id, array $itemId)
    {
        return Specification::where('id', $id)->whereNotIn('id', $itemId)->first(['type', 'id', 'spec_id']);
    }

    public function getSpec(int $id)
    {
        return Specification::where('id', $id)->first(['type', 'id', 'spec_id']);
    }

    public function getPrice(String $type, $date, String $priceType)
    {
        $price = Price::where('type', $type)->first(['id', 'fullday_amount']);
        $addition_amount = 0;
        $additional_price = ExtraAmount::where('date', $date)->get();
        foreach ($additional_price as $key => $value) {
            $addition_amount += $value->amount;
        }
        if($priceType == 1)
        {
            $prices = $price->fullday_amount + $addition_amount;
        }
        else if($priceType == 2){
            $prices = $price->fullday_amount + $addition_amount;
        }
        else if($priceType == 3){
            $prices = $price->fullday_amount + $addition_amount;
        }
        return $prices;
    }

    public function getDay($date, $priceType, $ConverDate)
    {
        if($priceType == 1)
        {
            return '' . $ConverDate . ' ' . $date . ' <font><br><i>&#187; Giornata intera 9:00-18:00</i>';
        }
        else if($priceType == 2){
            return '' . $ConverDate . ' ' . $date . ' <font><br><i>&#187; Mattina 9:00-13:00</i>';
        }
        else if($priceType == 3){
            return '' . $ConverDate . ' ' . $date . ' <font><br><i>&#187; Pomeriggio 13:30-18:00</i>';
        }
    }
}
