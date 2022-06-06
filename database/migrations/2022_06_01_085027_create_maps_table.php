<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('map_number')->nullable();
            $table->float('morning_amount')->nullable()->default(0.00);
            $table->float('afternoon_amount')->nullable()->default(0.00);
            $table->float('fullday_amount')->nullable()->default(0.00);
            $table->string('type', 100)->nullable();
            $table->float('additional_amount')->nullable()->default(0.00);
            $table->dateTime('amount_date')->nullable();
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
        Schema::dropIfExists('maps');
    }
}
