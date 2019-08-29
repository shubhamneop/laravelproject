<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname')->nullable(); 
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('phoneno')->nullable();
            $table->string('mobileno')->nullable();
            $table->integer('user_id')->unsigned();
             $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
