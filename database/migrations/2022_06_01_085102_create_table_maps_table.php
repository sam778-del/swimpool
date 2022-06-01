<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_maps', function (Blueprint $table) {
            $table->id();
            $table->integer('map_id')->unsigned()->nullable();
            $table->float('morning_price')->nullable()->default(0.00);
            $table->float('afternoon_price')->nullable()->default(0.00);
            $table->float('full_day_price')->nullable()->default(0.00);
            $table->float('hight_summer_price')->nullable()->default(0.00);
            $table->float('low_summer_price')->nullable()->default(0.00);
            $table->float('saturday_price')->nullable()->default(0.00);
            $table->float('sunday_price')->nullable()->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_maps');
    }
}
