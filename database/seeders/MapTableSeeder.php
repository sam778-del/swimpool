<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Map;

class MapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maps   = [
            array(
                'type' => 'lettini',
                'lettini_number' => 1,
                'gazebo_number' => 1,
                'gazebo_price' => 50,
                'position' => 6,
                'lettini_price' => 70,
            )
        ];
    }
}
