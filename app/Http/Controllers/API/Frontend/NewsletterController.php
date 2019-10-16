<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Newsletter;
use Validator;
class NewsletterController extends BaseController
{


  public function store(Request $request)
   {
      $validator = Validator::make($request->all(),[
        'email'=>'required|email',
       ]);

      if($validator->fails()){
         return $this->sendError(null,'Sorry, Provide proper email.');
      }
      if ( ! Newsletter::isSubscribed($request->email) )
      {
          Newsletter::subscribePending($request->email);
          return $this->sendResponse(true,'Thank you for subscription');

      }
        return $this->sendError(null,'Sorry! You have already subscribed');


   }
}
