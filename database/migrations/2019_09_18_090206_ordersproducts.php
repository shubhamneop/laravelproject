<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ordersproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ordersproducts', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('order_id')->unsigned();
          $table->integer('product_id')->unsigned();
          $table->integer('quantity')->unsigned();
          $table->string('item_name')->nullable();
          $table->integer('total');
          $table->integer('price');
          $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordersproducts');
    }
}
