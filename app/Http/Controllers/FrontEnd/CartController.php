<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use App\product;
use App\coupon;
use App\cat;
use App\Order_detail;
use App\User_order;
use App\User;
use App\Sample;
use App\Used_coupon;
use Redirect;
use DB;
use Auth;
use App\Address;
use Session;

class CartController extends Controller
{
    //
  public function __construct() {

       if(Auth::guest()) {
       //is a guest so redirect
        return redirect('login');
       }
      }

  public function index(){

  	return view('Frontend.cart.index');
  }


  public function checkCoupon(Request $request){


     // $code = $request->code;

  	$code = $request->input('coupon');
   //  $amount = 12520;
  	$amount = $request->input('total');




      $check = DB::table('coupons')
        ->where('code',$code)
        ->get();
        if(count($check)=="1")
         {

            $user_id = Auth::user()->id;
            $check_used = DB::table('used_coupons')
            ->where('user_id',$user_id)
            ->where('coupon_id',$check[0]->id)
            ->count();
           if($check_used=="0")
            {
                //insert used one
                 $used_add = DB::table('used_coupons')
                  ->insert([
                    'coupon_id' => $check[0]->id,
                    'user_id' => $user_id
                     ]);
                  $type = $check[0]->type ;
                  $discount = $check[0]->discount;

                   if($type == 'Percent'){
                     $amt = $discount*$amount/100;
                      $newTotal = $amount-$amt;
                      }else{

                       $newTotal = $amount-$discount;
                       }

               $shipTotalPrice = 0;
                if($newTotal>500){
                 $shipTotalPrice = $newTotal;

                 }
                  if(Auth::check()){
            $id = Auth::User()->id;
                 }else{
             $id = 0;
         }
           $addresses = Address::where('user_id',$id)->get();
           $data = null;
                  $oldCart = Session::get('cart');
                  $cart = new Cart($oldCart);

                  $id = Auth::User()->id;
            	  $data =  Used_coupon::with('coupon')->where('user_id',$id)->get();
                    foreach ($data as $key => $value) {
                        $ids[] = $value->coupon_id;

                        }
            			 	$coupons = coupon::whereNotIn('id',$ids)
            			                    ->get();

                 return view('Frontend.checkout',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'total'=>$newTotal,'coupons'=>$coupons,'data'=>$data,'shipTotalPrice'=>$shipTotalPrice,'addresses'=>$addresses]);

             }else{

               return redirect()->back()->with('message', 'You already used this coupon!');


                 }


             } else{
                  return redirect()->back()->with('message', 'Wrong Coupon code you entered!');

          }












      // print_r($type);
     //  print_r($discount);







  }

  public function getAddToCart(Request $request ,$id){
          if(Auth::guest()) {
             return redirect('login')->with('message', 'Please Login !');
              }

       $product = product::with('image','attribute','category')->find($id);

       $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->add($product,$product->id);

       $request->session()->put('cart', $cart);
      return redirect()->back()->with('success', 'Product added to cart successfully!');



  }



  public function getReduceByOne($id){
  	   $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->reduceByOne($id);
       Session::put('cart',$cart);

         return redirect()->back();
  }
  public function getAddByOne($id){
  	   $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->addByOne($id);
       Session::put('cart',$cart);

         return redirect()->back();
  }
  public function getRemoveItem($id){
  	   $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->removeItem($id);
       Session::put('cart',$cart);

        return redirect()->back();
  }
  public function getCart(){
          if(Auth::guest()) {
         return redirect('login')->with('message', 'Please Login !');
       }

  	if(!Session::has('cart')){
  		return view('Frontend.cart',['products'=>null]);
  	}
     $oldCart = Session::get('cart');
     $cart = new Cart($oldCart);
      $coupons = coupon::all();

     return view('Frontend.cart',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice,'shipTotalPrice'=>$cart->shipTotalPrice,'total'=>null,'coupons'=>$coupons]);




  }

  public function getChekout(){
      if(Auth::check()){
            $id = Auth::User()->id;
                 }else{
             $id = 0;
         }
           $addresses = Address::where('user_id',$id)->get();
       $data = null;

    if(!Session::has('cart')){
      return view('Frontend.cart',['products'=>null]);
    }
     $oldCart = Session::get('cart');
     $cart = new Cart($oldCart);

     $data =  Used_coupon::with('coupon')->where('user_id',$id)->get();
         foreach ($data as $key => $value) {
             $ids[] = $value->coupon_id;

             }
          // if ($ids== null) {
          //  $coupons = coupon::all();
          // }else {
          //     $coupons =   coupon::whereNotIn('id',$ids)->get();
          // }
           $ids=[0];
          $coupons =   coupon::whereNotIn('id',$ids)->get();
      // $coupons = coupon::all();

     // $totalPrice = $cart->totalPrice;
       //$shipTotalPrice = 0;
       //if($totalPrice>500){
         //$shipTotalPrice = $totalPrice+50;}



     return view('Frontend.checkout',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice,'shipTotalPrice'=>$cart->shipTotalPrice,'total'=>null,'addresses'=>$addresses,'data'=>$data,'coupons'=>$coupons]);

  }

  public function saveorder(Request $request){

        $this->validate($request,[
            'fullname'=>'required',
            'address1'=>'required',
            'zipcode'=>'required|numeric',
            'country'=>'required|alpha',
            'state'=>'required|alpha',
            'mobileno'=>'required|numeric',


         ]);


     if(!Session::has('cart')){
      return view('Frontend.cart',['products'=>null]);
    }
     $oldCart = Session::get('cart');
     $cart = new Cart($oldCart);
      $coupons = coupon::all();

      $totalPrice = $cart->totalPrice;
       $shipTotalPrice = 0;
       if($totalPrice>500){
         $shipTotalPrice = $totalPrice+50;

       }
       $status ='Processing';
     $id = Auth::User()->id;
       $order = new Order_detail();
       $order->user_id = $id;
       $order->cart = serialize($cart);
       $order->address = serialize($request->all());

       $order->status = $status;


       $order->save();

       $save = new User_order();

       $save->user_id = $id;
       $save->order_id = $order->id;

       $save->save();


      Session::put('success', 'Order Placed Successfully');
       Session::forget('cart');
      return redirect('payonfo');



  }

  public function test(){
    // $data = product::with('image','attribute','category')->findOrFail(19);
     //$data = User::with('orderDetails','orders')->get();
       //$data = Order_detail::with('user')->get();
          // $data = Session::get('payment_id');

      return view('Frontend.demo',compact('data'));


  }


  public function update(Request $request){

          $data = Session::get('payment_id');
      /*
       $order = new Sample();

       $order->payment_id = $data;

       $order->save();
      */

       $id =  Auth::User()->id;
            $user =  Order_detail::where('user_id',$id);
                $dataupdate = array(
                             'status'=> 'Processing',
                            'payment_id' => $data

                               );

                     $user->update($dataupdate);
       return $data;




  }



}
