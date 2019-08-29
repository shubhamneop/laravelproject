<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productattributesassoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('productattributesassocs',function(Blueprint $table){
             $table->increments('id');
             $table->unsignedInteger('product_id');
             $table->string('color');
             $table->string('quantity');
             $table->timestamps();
             $table->foreign('product_id')
            ->references('id')->on('products')->onDelete('cascade');
               });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productattributesassocs');
           }
}
