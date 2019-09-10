<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Order_detail;
use App\Mail\OrderDetailsAdmin;
use DB;

class PlacedOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'placed:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to admin of placed orders.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $orders = Order_detail::whereDate('created_at',DB::raw('CURDATE()'))->get();;
      $orders->transform(function($order,$key){
       $order->cart = unserialize($order->cart);
       return $order;
      });
       Mail::to('admin@demo.com')->send(new OrderDetailsAdmin($orders));
    }
}
