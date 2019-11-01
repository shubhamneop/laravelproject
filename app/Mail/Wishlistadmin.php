<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;
class Wishlistadmin extends Mailable
{
    use Queueable, SerializesModels;
    public $wishlists;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($wishlists)
    {
        $this->wishlists = $wishlists;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
     {
      $showtemplates = EmailTemplate::where('name','Wishlists_admin')->get();


        foreach($showtemplates as $showtemplate){
            $template = htmlspecialchars_decode($showtemplate->message);
            }

      $template = $this->replace($template,$this->wishlists);
      return $this->view('emails.wishlisttoadmin');

      return $this->view('emails.email')->with('template',$template);
     // return $this->from('rahul@gmail.com')->subject($showtemplate->subject)->view('email_template')->with('template',$template);
    }

    public function replace($template,$wishlists){
        foreach ($wishlists as $wish) {

        $template = str_replace('{{id}}', 1,$template);
        $template = str_replace('{{username}}', $wish->users->name,$template);
        $template = str_replace('{{product}}',$wish->products->name,$template);
        $template = str_replace('{{price}}',$wish->products->price,$template);

     return $template;
      }
   }






    // public function build()
    // {
    //     return $this->view('emails.wishlisttoadmin');
    // }
}
