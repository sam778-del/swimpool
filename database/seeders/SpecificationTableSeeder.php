<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specification;
use App\Models\Column;
use App\Models\Row;

class SpecificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(0, 37) as $item)
        {
            Column::create([
                'utility' => 'row',
            ]);
        }

        $row   =   Column::get();
        foreach(range(0, 18) as $item)
        {
            Row::create([
                'utility' => $row[$key]->id
            ]);
        }
    }
}
