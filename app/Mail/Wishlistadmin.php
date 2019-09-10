<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        return $this->view('emails.wishlisttoadmin');
    }
}
