<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order_detail;
use App\EmailTemplate;
class Orderstatus extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
      $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     public function build()
     {
      $showtemplates = EmailTemplate::where('name','Order_status')->get();


        foreach($showtemplates as $showtemplate){
            $template = htmlspecialchars_decode($showtemplate->message);
            }

      $template = $this->replace($template,$this->order);
      return $this->view('emails.email')->with('template',$template);

     // return $this->from('rahul@gmail.com')->subject($showtemplate->subject)->view('email_template')->with('template',$template);
    }

    public function replace($template,$order){
         $address = $order->address->fullname.' '.$order->address->address1.' '.$order->address->address2.' '.$order->address->zipcode.' '.$order->address->country.' '.$order->address->state.' '.$order->address->phoneno.' '.$order->address->mobileno;
        $template = str_replace('{{ order_no }}', $order->order_no,$template);
        $template = str_replace('{{ status }}', $order->status,$template);
        $template = str_replace('{{ billing }}',$order->address->fullname,$template);
        $template = str_replace('{{ shipping }}',$address,$template);
        $template = str_replace('{{ fullname }}', $address,$template);
        $template = str_replace('{{ payment_mode }}', $order->payment_mode,$template);

     return $template;

   }




    // public function build()
    // {
    //
    //     return $this->view('emails.orderstatus');
    // }
}
