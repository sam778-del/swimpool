<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $price = array(
            array(
                'fullday_amount' => 10,
                'morning_amount' => 10,
                'afternoon_amount' => 10,
                'type' => 'lettino'
            ),

            array(
                'fullday_amount' => 12,
                'morning_amount' => 12,
                'afternoon_amount' => 12,
                'type' => 'gazobe'
            )
        );

        foreach ($price as $key => $value) {
            Price::create($value);
        }
    }
}
