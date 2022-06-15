<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soccer;

class SpecificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Soccer::create([
            'name' => 'soccer camp 1',
            'duration' => '20:00 - 21:00',
            'amount' => '10',
            'type' => 'soccer camp 1'
        ]);

        Soccer::create([
            'name' => 'soccer camp 1',
            'duration' => '21:00 - 22:00',
            'amount' => '10',
            'type' => 'soccer camp 1'
        ]);

        Soccer::create([
            'name' => 'soccer camp 1',
            'duration' => '22:00 - 23:00',
            'amount' => '10',
            'type' => 'soccer camp 1'
        ]);

        Soccer::create([
            'name' => 'soccer camp 1',
            'duration' => '23:00 - 00:00',
            'amount' => '10',
            'type' => 'soccer camp 1'
        ]);
    }
}
