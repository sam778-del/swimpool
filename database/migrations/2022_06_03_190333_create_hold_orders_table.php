<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('map_id')->unsigned()->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->date('booked_date')->nullable();
            $table->integer('accessory_id')->unsigned()->nullable();
            $table->bigInteger('persons')->nullable()->default(1);
            $table->bigInteger('day')->nullable()->default(1);
            $table->float('amount')->nullable()->default(0.00);
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
        Schema::dropIfExists('hold_orders');
    }
}
