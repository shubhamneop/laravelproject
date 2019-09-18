 <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('order_no')->unique();
            $table->text('cart');
            $table->integer('address_id')->unsigned();
            $table->string('payment_mode')->nullable();
            $table->integer('total');
            $table->enum('status', ['Pending', 'Processing', 'Dispatched','Shipped','Delivered','Cancelled']);
            $table->String('payment_id')->default(NULL);
            $table->integer('coupon_id')->unsigned();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('used_coupons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
