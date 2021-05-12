<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('store')->nullable();
            $table->unsignedBigInteger('customer')->nullable();
            $table->unsignedBigInteger('deliver')->nullable();
            $table->integer('time');
            $table->string('content');
            $table->string('status');
            $table->timestamps();
            $table->foreign('store')->references('id')->on('stores');
            $table->foreign('customer')->references('id')->on('customers');
            $table->foreign('deliver')->references('id')->on('delivers');
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
