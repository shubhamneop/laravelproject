<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Newsletter;

class NewsletterController extends Controller
{

    public function store(Request $request)
    {
        if ( ! Newsletter::isSubscribed($request->email) )
        {
            Newsletter::subscribePending($request->email);
            return redirect()->back()->with('success','Thank you for subscription');

        }
          return redirect()->back()->with('error','Sorry! You have already subscribed');


    }
}
