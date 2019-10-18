<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Auth;
use DB;
use App\TestOrder;
class OrderController extends BaseController
{
    public function processOrder(Request $request){
      $validator = Validator::make($request->all(),[
        'cart_id'=>'required',
        'address_id'=>'required',
        'total'=>'required',
        'status'=>'required',
         'payment_mode'=>'required',
      ]);
       if($validator->fails()){
         return $this->sendError(null,'Please provide proper data');
       }
    DB::beginTransaction();
       try{
       $latestOrder = TestOrder::orderBy('created_at','DESC')->first();
       $input= $request->all();
       $input['user_id'] = Auth::user()->id;
        if($latestOrder==null){
         $input['order_no'] = 'OD'.'1'.'_'.time();
        }else{
        $input['order_no'] = 'OD'.($latestOrder->id + 1).'_'.time() ;
        }
       $order = TestOrder::create($input);


      DB::commit();
      return $this->sendResponse($order,'order details');

     }catch(Exception $e){
       DB::rollback();
    }
}

    public function updateOrderStatus(Request $request){
      $validator = Validator::make($request->all(),[
        'order_no'=>'required',
        'status'=>'required',
         'payment_id'=>'required',
      ]);
       if($validator->fails()){
         return $this->sendError(null,'Please provide proper data');
       }

       $order = TestOrder::where('order_no',$request->order_no)->get();
       $orders = TestOrder::find($order[0]->id);
       if(empty($order)){
         return $this->sendError(null,'Order not found');
       }
       $orders->update($request->all());
       return $this->sendResponse($order,'order status updated');

    }
}
