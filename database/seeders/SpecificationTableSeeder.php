<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specification;

class SpecificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 780) as $item)
        {
            Specification::create([
                'utility' => 'lettino',
                'spec_id' => $item,
                'type' => '-'
            ]);
        }
    }
}
