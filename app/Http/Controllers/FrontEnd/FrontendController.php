<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\product;
use App\productattributesassoc;
use App\productcategory;
use App\productimage;
use App\cat;
use App\User;
use App\User_order;
use App\Order_detail;
use App\Used_coupon;
use App\coupon;
use App\Address;
use App\banner;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use Auth;
use App\order;
use App\ordersproduct;
class FrontendController extends Controller
{
	public function index(){
        $category =  cat::where('p_id',0)->get();
        $products = product::all();
				$subcategory = cat::where('p_id','!=',0)->get();
         $productlist = product::with('category')->get();
          $banner = banner::all();

    	return view('Frontend.index',compact('products','category','subcategory','productss','banner'));
    }


   public function details($id){

        $category =  cat::where('p_id',0)->get();
        $demo = cat::with('childs','parent')->get();
        $productsDetails = product::with('image','attribute','category')->findOrFail($id);
        return view('Frontend.product-details',compact('products','category','productsDetails'));
    }

    public function shop(){
    	return view('Frontend.demo');
    }

    public function productCat(Request $request){

       $id = $request->id;

			 $products = Product::whereHas('category',function($q) use($id)
			 {
			 $q->where('category_id',$id);
			 })->with('image')->get();
       $category =  cat::where('p_id',0)->get();
			 $subcategory = cat::where('p_id','!=',0)->get();
       $banner = banner::all();
      return view('Frontend.index',compact('products','category','subcategory','banner'));



    }

     public function proCat(Request $request){

            $id = $request->id;
            $productss =Product::whereHas('category',function($q) use($id)
	            	   {
	             	    $q->where('category_id',$id);
	              	 })->with('image')->get();
			     	$products = product::all();
			    	$subcategory = cat::where('p_id','!=',0)->get();
            $category =  cat::where('p_id',0)->get();

        return view('Frontend.demo',compact('productss', json_decode($productss, true),'category','products','subcategory'));



    }

    public function getOrder(){
        if(Auth::guest()) {
         return redirect('login')->with('message', 'Please Login !');
             }
            //  $data = User::with('orderDetails')->get();
						// foreach ($data as $key => $value) {
					  //  	foreach ($value->orderDetails as $key => $value) {
					  //  		echo "$value->status";
						// 	}
						// }
        $orders = Auth::User()->orderDetails;
        $orders->transform(function($order,$key){
         $order->cart = unserialize($order->cart);
         return $order;
        });




       return view('Frontend.order',compact('orders','data'));
    }
     public function trackorder(Request $request){
          $this->validate($request,[
						'email'=>'required|email',
						'orderid'=>'required',
					]);
					$email = $request->input('email');
					$orderid = $request->input('orderid');
					$user = User::whereemail($email)->first();
	               $id = $user->id;
         	$userdata = User_order::where('user_id',$id)->where('order_nos',$orderid)->first();
          if ($userdata==null) {
           return view('Frontend.track',['data' => $userdata])->with('success','Please enter valid details');
          }
					$oid =$userdata->order_id;

					$orders = Order_detail::whereid($oid)->first();
             $order = unserialize($orders->cart);


				  return view('Frontend.track',['data' => $orders,'order'=>$order]);
		 }
		public function test(){
    //   // $orders = Auth::User()->orderDetails;
		// //	  $orders = User::with('orders')->get();
		//    $email = "test1@demo.com";
	  //  	$user = User::whereemail($email)->first();
    //           $id = $user->id;
		// 					$oid = 3;
		// 		$data = User_order::where('user_id',$id)->where('order_id',$oid)->first();
		//
		// 	     $oid =$data->order_id;
    //        //$oid=2;
		// 			 $order = Order_detail::whereid($oid)->first();
		// 			// dd($order->status);
		// 		   return view('Frontend.track',['data' => $order]);
         $id=44;
		$products = Product::whereHas('category',function($q) use($id)
		{
		$q->where('category_id',$id);
		})->with('image')->get();

		dd($products);


		}









}
