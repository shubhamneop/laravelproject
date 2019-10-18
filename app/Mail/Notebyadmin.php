<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;
class Notebyadmin extends Mailable
{
    use Queueable, SerializesModels;
      public $contact;
      public $ip;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact,$ip)
    {
        $this->contact = $contact;
        $this->ip = $ip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     public function build()
     {
      $showtemplates = EmailTemplate::where('name','NoteBy_admin')->get();


        foreach($showtemplates as $showtemplate){
            $template = htmlspecialchars_decode($showtemplate->message);
            }

      $template = $this->replace($template,$this->contact);
      return $this->view('emails.email')->with('template',$template);

     // return $this->from('rahul@gmail.com')->subject($showtemplate->subject)->view('email_template')->with('template',$template);
    }

    public function replace($template,$contact){

        $template = str_replace('{{name}}', $contact->name,$template);
        $template = str_replace('{{email}}', $contact->email,$template);
        $template = str_replace('{{contactno}}',$contact->contactno,$template);
        $template = str_replace('{{subject}}',$contact->subject,$template);
        $template = str_replace('{{message}}', $contact->message,$template);
        $template = str_replace('{{note}}', $contact->note,$template);
        $template = str_replace('{{ip}}', $this->ip,$template);

     return $template;

   }





    // public function build()
    // {
    //     return $this->view('emails.notetocustomer');
    // }
}
