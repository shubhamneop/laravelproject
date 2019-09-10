<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Orderdetails extends Mailable
{
    use Queueable, SerializesModels;
    public $orders;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders,$order)
    {
        $this->orders = $orders;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orderinfo');
    }
}
