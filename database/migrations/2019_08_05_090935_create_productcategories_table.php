<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('productcategories', function (Blueprint $table) {
            $table->increments('id');
             $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();
            $table->foreign('product_id')
            ->references('id')->on('products')->onDelete('cascade');
           
             $table->foreign('category_id')
            ->references('id')->on('cats')->onDelete('cascade');
          

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productcategories');
    }
}
