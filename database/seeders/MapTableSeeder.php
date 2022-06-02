<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TableMap;
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
        $map_twelve_range = range(0, 6);
        foreach ($map_twelve_range as $key => $value) {
            $map_twelve                     = new Map();
            $map_twelve->type               = 'Lettino';
            $map_twelve->lettini_number     = $key + 1;
            $map_twelve->gazebo_number      = $key + 1;
            $map_twelve->gazebo_price       = 34;
            $map_twelve->position           = 7;
            $map_twelve->lettini_price      = 65;
            $map_twelve->save();

            $table_map                      = new TableMap();
            $table_map->map_id              = $map_twelve->id;
            $table_map->morning_price       = 45;
            $table_map->afternoon_price     = 55;
            $table_map->full_day_price      = 60;
            $table_map->hight_summer_price  = 65;
            $table_map->low_summer_price    = 70;
            $table_map->saturday_price      = 80;
            $table_map->saturday_price      = 85;
            $table_map->save();
        }
    }
}
