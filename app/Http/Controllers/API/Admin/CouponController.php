<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Coupon;

class CouponController extends BaseController
{
  //Authorized user with permission middleware
   function __construct(){
     $this->middleware('permission:coupon-list');
     $this->middleware('permission:coupon-create', ['only' => ['create', 'store']]);
     $this->middleware('permission:coupon-edit', ['only' => ['edit', 'update']]);
     $this->middleware('permission:coupon-delete', ['only' => ['destroy']]);

  }

  /**
   * Display a listing of the resource.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\View\View
   */

 public function index(Request $request)
 {
     $coupons = Coupon::latest()->get();

     return $this->sendResponse($coupons,'Listing coupons.');
 }


 /**
  * Store a newly created resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  *
  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
  */
 public function store(Request $request) {

    $validator= Validator::make($request->all(),[
      'title'=>'required',
       'code'=>'required|required|regex:/^[a-zA-Z0-9_\-]*$/|unique:coupons,code',
       'type'=>'required',
       'discount'=>'required',
    ]);

    if($validator->fails()){
      return $this->sendError(null,'Please Provide Proper Data.');
    }
      $coupon = Coupon::create($request->toArray());

     return $this->sendResponse($coupon,'coupon added successfully.');
 }

 public function update(Request $request){

   $validator= Validator::make($request->all(),[
     'title'=>'required',
      'code'=>'required|regex:/^[a-zA-Z0-9_\-]*$/|unique:coupons,code,'.$request->id,
      'type'=>'required',
      'discount'=>'required',
   ]);

   if($validator->fails()){
     return $this->sendError(null,'Please Provide Proper Data.');
   }
      $coupon= Coupon::find($request->id);
      if (is_null($coupon)) {
           return $this->sendError(null,'coupon not found.');
       }
     $requestData = $request->all();

     $coupon->update($requestData);

     return $this->sendResponse($coupon, 'coupon updated!');
 }

 public function show(Request $request){
   if(empty($request->all())){
     return $this->sendError(null,'Element not found');
   }
   $coupon = Coupon::find($request->id);
   if (is_null($coupon)) {
        return $this->sendError(null,'coupon not found.');
    }
    return $this->sendResponse($coupon,'Coupon Information.');
 }

 public function destroy(Request $request){

     if(empty($request->all())){
      return $this->sendError(null,'Element not found');
       }
     $coupon= Coupon::find($request->id);
     if (is_null($coupon)) {
          return $this->sendError(null,'coupon not found.');
      }
     $coupons = $coupon->delete();

     return $this->sendResponse($coupons, 'coupon deleted!');
 }

}
