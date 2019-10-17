<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Address;
use Auth;
use Validator;
class AddressController extends BaseController
{
    public function index(){

      $addresses = Auth::user()->useraddress;

      if($addresses==null){
        return $this->sendError(null,'User does not have address');
      }
      return $this->sendResponse($addresses,'User Addresses.');
    }

    public function store(Request $request){

     $validator = Validator::make($request->all(),[
        'fullname'=>'required',
        'address1'=>'required',
        'zipcode'=>'required|max:6',
        'country'=>'required|alpha',
        'state'=>'required|alpha',
        'mobileno'=>'required|numeric|min:10',
      ]);

      if ($validator->fails()) {
          return $this->sendError(null, 'Address not created try again');
      }

       $input = $request->all();
       $input['user_id'] = Auth::user()->id;
       $useraddress = Address::create($input);


      return $this->sendResponse($useraddress,'Address added successfully');

    }

    public function update(Request $request,Address $useraddress){

      $validator = Validator::make($request->all(),[
         'fullname'=>'required',
         'address1'=>'required',
         'zipcode'=>'required|max:6',
         'country'=>'required|alpha',
         'state'=>'required|alpha',
         'mobileno'=>'required|numeric|min:10',
       ]);

       if ($validator->fails()) {
           return $this->sendResponse($validator->errors(), 'Address not created try again');
       }

       
       $userid = Auth::User()->id;
       $address = $request->all();
       $address['user_id']= $userid;

       $useraddress->update($address);

       return $this->sendResponse($useraddress,'Address updated successfully');

    }

    public function destroy(Address $useraddress){
      $data = $useraddress->delete();

      return $this->sendResponse($data,'Address delete successfully');

    }



}
