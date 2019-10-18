<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Contactus;
use App\Configuration;
use App\Mail\NotificationToAdmin;
use App\Mail\Notebyadmin;
use Illuminate\Support\Facades\Mail;


class ContactusController extends BaseController
{

    function __construct(){
       $this->middleware('role:admin',['except' => ['store']]);
    }

    public function index(){
        $contacts = Contactus::latest()->get();

        return $this->sendResponse($contacts,'All contacts');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
          'name'=>'required',
          'contactno'=>'required|numeric|min:10',
          'email'=>'required|email',
          'subject'=>'required',
          'message'=>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Please fill all data');
        }
        $input = $request->all();
        $contact = Contactus::create($input);
        $mail = Configuration::find(1);
        Mail::to($mail->value)->send(new NotificationToAdmin($contact));
      return $this->sendResponse($contact,'Query sent to admin.');

    }

    public function Update(Request $request){
        $validator = Validator::make($request->all(),[
           'note' => 'required',
         ]);

         if($validator->fails()){
           return $this->sendError(null,'Note is required');
         }
        $contactus = Contactus::find($request->id);
        if (is_null($contactus)) {
             return $this->sendError(null,'Contact not found.');
         }
         $input = $request->all();
         $contactus->update($input);
         $message = $contactus;

         $mail = Configuration::find(1);
         Mail::to($message->email)->send(new Notebyadmin($message));

       return $this->sendResponse($message,'Note added by admin.');

    }

    public function show(Request $request){
      if(empty($request->all())){
        return $this->sendError(null,'Element not found');
      }
    $contactus = Contactus::find($request->id);
    if (is_null($contactus)) {
         return $this->sendError(null,'Contact not found.');
     }
       return $this->sendResponse($contactus,'Contact Information.');
    }

    public function destroy(Request $request){
      $contactus = Contactus::find($request->id);
      if (is_null($contactus)) {
           return $this->sendError(null,'Contact not found.');
       }
      $data =  $contactus->delete();

       return $this->sendResponse($data,'contact delete successfully.');

    }


}
