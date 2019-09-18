<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('order_no')->unique();
          $table->integer('address_id')->unsigned();
          $table->string('payment_mode')->nullable();
          $table->integer('total');
          $table->string('status')->defult('inactive');
          $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
