<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Productattributesassoc;
use App\Productcategory;
use App\Productimage;
use App\Category;
use App\User;
use App\User_order;
use App\Order_detail;
use App\Used_coupon;
use App\Coupon;
use App\Address;
use App\Banner;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use Auth;
use App\order;
use App\ordersproduct;
class FrontendController extends Controller
{
	public function index(Request $request){
          $keyword = $request->get('search');
				  if (!empty($keyword)) {

						$products = Product::where('name','LIKE',"%$keyword%")
						                     ->orwhere('description','LIKE',"%$keyword%")->get();
						$category =  Category::where('p_id',0)->get();
						$subcategory = Category::where('p_id','!=',0)->get();
						$productlist = Product::with('category')->get();
						$banner = Banner::all();
						$categorycounts =	Productcategory::with('categories','products')->select('category_id', DB::raw('count(*) as total'))
			                  ->groupBy('category_id')
			                  ->get();
					}else{
            $category =  Category::where('p_id',0)->get();
            $products = Product::all();
				    $subcategory = Category::where('p_id','!=',0)->get();
            $productlist = Product::with('category')->get();
            $banner = Banner::all();
				  	$categorycounts =	Productcategory::with('categories','products')->select('category_id', DB::raw('count(*) as total'))
			                  ->groupBy('category_id')
			                  ->get();
				}
    	return view('Frontend.index',compact('products','category','subcategory','productss','banner','categorycounts'));
    }


   public function details($id){

        $category =  Category::where('p_id',0)->get();
        $demo = Category::with('childs','parent')->get();
        $productsDetails = Product::with('image','attribute','category')->findOrFail($id);
				$categorycounts =	Productcategory::with('categories','products')->select('category_id', DB::raw('count(*) as total'))
										->groupBy('category_id')
										->get();
        return view('Frontend.product-details',compact('products','category','productsDetails','categorycounts'));
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
       $category =  Category::where('p_id',0)->get();
			 $subcategory = Category::where('p_id','!=',0)->get();
       $banner = Banner::all();
			 $categorycounts =	Productcategory::with('categories','products')->select('category_id', DB::raw('count(*) as total'))
									 ->groupBy('category_id')
									 ->get();
      return view('Frontend.index',compact('products','category','subcategory','banner','categorycounts'));



    }

     public function proCat(Request $request){

            $id = $request->id;
            $productss =Product::whereHas('category',function($q) use($id)
	            	   {
	             	    $q->where('category_id',$id);
	              	 })->with('image')->get();
			     	$products = Product::all();
			    	$subcategory = Category::where('p_id','!=',0)->get();
            $category =  Category::where('p_id',0)->get();

        return view('Frontend.demo',compact('productss', json_decode($productss, true),'category','products','subcategory'));



    }

    public function getOrder(){
        if(Auth::guest()) {
         return redirect('login')->with('message', 'Please Login !');
             }

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






}
