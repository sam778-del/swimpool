<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSpecificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_specification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('utility', 100)->nullable()->default('lettino');
            $table->bigInteger('spec_id')->nullable();
            $table->string('type', 100)->nullable()->default('-');
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
        Schema::dropIfExists('table_specification');
    }
}
