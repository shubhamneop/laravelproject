<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Mail\Orderdetails;
use Illuminate\Support\Facades\Mail;
use App\Cart;
use App\Product;
use App\Coupon;
use App\Category;
use App\Order_detail;
use App\User_order;
use App\User;
use App\Sample;
use App\Used_coupon;
use App\Cartdetail;
use App\Configuration;
use App\Productattributesassoc;
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


                 $shipTotalPrice = $newTotal;


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
            			 	$coupons = Coupon::whereNotIn('id',$ids)
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

       $product = Product::with('image','attribute','category')->find($id);

       $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->add($product,$product->id);

       $request->session()->put('cart', $cart);
      return redirect()->back();



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
      $coupons = Coupon::all();

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

         if(count($data)<=0)
            {
              $coupons = Coupon::all();
            }else{
              foreach ($data as $key => $value) {
                  $ids[] = $value->coupon_id;
                  }
              $coupons =   Coupon::whereNotIn('id',$ids)->get();
            }


     return view('Frontend.checkout',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice,'shipTotalPrice'=>$cart->shipTotalPrice,'total'=>null,'addresses'=>$addresses,'data'=>$data,'coupons'=>$coupons]);

  }

  public function saveorder(AddressRequest $request){



     if(!Session::has('cart')){
      return view('Frontend.cart',['products'=>null]);
    }
     $oldCart = Session::get('cart');
     $cart = new Cart($oldCart);

      $coupons = Coupon::all();

      $totalPrice = $cart->totalPrice;
      $newTotal = $request->input('amount');
       $shipTotalPrice = 0;
       if($totalPrice>500){
         $shipTotalPrice = $totalPrice+50;

       }
      $addressId = $request->input('address');

       if($addressId==null){
         $userid = Auth::User()->id;
        $data = new Address;

        $data->fullname = $request->input('fullname');
        $data->address1 = $request->input('address1');
        $data->address2 = $request->input('address2');
        $data->zipcode = $request->input('zipcode');
        $data->country = $request->input('country');
        $data->state = $request->input('state');
        $data->phoneno = $request->input('phoneno');
        $data->mobileno = $request->input('mobileno');
        $data->user_id = $userid;


       $data->save();
         $addressId = $data->id;
       }
       $coupon = Used_coupon::with('coupon','user')->orderBy('id','DESC')->first();
       $latestOrder = Order_detail::orderBy('created_at','DESC')->first();
       $status ='Processing';
       $id = Auth::User()->id;

       $order = new Order_detail();
       $order->user_id = $id;
       if($latestOrder==null){
         $order->order_no = 'OD'.'1'.'_'.time();
       }else{
          $order->order_no = 'OD'.($latestOrder->id + 1).'_'.time() ;
       }
       $order->cart = serialize($cart);
       $order->address_id =  $addressId;
        $order->total = $request->input('amount');
       $order->status = $status;
       $order->payment_mode = $request->input('PaymentMode');
       if($totalPrice>$newTotal){
          $order->coupon_id= $coupon->id;
        }
       $order->save();

       $userorder = new User_order();
       $userorder->user_id = $id;
       $userorder->order_id = $order->id;
       $userorder->order_nos = $order->order_no;
       $userorder->save();




       $order = Order_detail::find($order->id);

          $orders = unserialize($order->cart);

            foreach ($orders->items as $item) {
                 $cartdetails = new Cartdetail;
                    $cartdetails->order_id = $order->id;
                    $cartdetails->product_id=$item['item']['id'];
                    $cartdetails->product_name=$item['item']['name'];
                    $cartdetails->product_image=$item['image'];
                    $cartdetails->quantity=$item['qty'];
                    $cartdetails->price=$item['price'];
                    $cartdetails->category=$item['item']['category']['category_id'];
                    $cartdetails->save();

                    $product = productattributesassoc::where('product_id',$item['item']['id'])->get();
                     foreach ($product as $dataid){
                          $id=$dataid->id;
                        }
                     $productid = productattributesassoc::find($id);
                         $productquantity=$productid->quantity;
                         $productquantity = $productquantity-$item['qty'];
                         $dataupdate=array(
                           'quantity'=> $productquantity,
                              );
                        $productid->update($dataupdate);
                }

        $email = Auth::User()->email;
      Mail::to($email)->send(new Orderdetails($orders,$order));
      $mail = Configuration::find(1);
        Mail::to($mail->value)->send(new Orderdetails($orders,$order));
      Session::put('success', 'Order Placed Successfully');
       Session::forget('cart');
      return redirect('payonfo');



  }

  public function removecoupon(){
     $coupon = Used_coupon::with('coupon','user')->orderBy('id','DESC')->first();
     Used_coupon::where('id',$coupon->id)->delete();
     return redirect('check_out');

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
