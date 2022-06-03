<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id',100)->unique();
            $table->string('name',100)->nullable();
            $table->string('mobile_number', 100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('card_number',10)->nullable();
            $table->string('card_exp_month',10)->nullable();
            $table->string('card_exp_year',10)->nullable();
            $table->integer('map_id')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
