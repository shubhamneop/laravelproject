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
					$perPage=6;
				  if (!empty($keyword)) {

						$products = Product::where('name','LIKE',"%$keyword%")
						                     ->orwhere('description','LIKE',"%$keyword%")->paginate($perPage);
						$category =  Category::where('p_id',0)->get();
						$subcategory = Category::where('p_id','!=',0)->get();

						$banner = Banner::all();
						$categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
			                  ->groupBy('category_id')
			                  ->get();
					}else{
            $category =  Category::where('p_id',0)->get();
            $products = Product::paginate($perPage);
				    $subcategory = Category::where('p_id','!=',0)->get();

            $banner = Banner::all();
				  	$categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
			                  ->groupBy('category_id')
			                  ->get();


				}
    	return view('Frontend.index',compact('products','category','subcategory','banner','categorycounts'));
    }


   public function details($id){

        $category =  Category::where('p_id',0)->get();
        $demo = Category::with('childs','parent')->get();
        $productsDetails = Product::with('image','attribute','category')->findOrFail($id);
				$categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
										->groupBy('category_id')
										->get();
        return view('Frontend.product-details',compact('products','category','productsDetails','categorycounts'));
    }

    public function shop(){
    	return view('Frontend.demo');
    }

    public function productCattegory(Request $request){

       $id = $request->id;
      $perPage=5;
			 $products = Product::whereHas('category',function($q) use($id)
			 {
			 $q->where('category_id',$id);
			 })->with('image')->paginate($perPage);
       $category =  Category::where('p_id',0)->get();
			 $subcategory = Category::where('p_id','!=',0)->get();
       $banner = Banner::all();
			 $categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
									 ->groupBy('category_id')
									 ->get();
      return view('Frontend.index',compact('products','category','subcategory','banner','categorycounts'));



    }

     public function productBySubcategory(Request $request){

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
           $orders =Order_detail::whereHas('user', function ($query) use($email) {
                                    $query->where('email',$email);
                                   })->where('order_no',$orderid)
                                     ->first();

          if ($orders==null) {
           return view('Frontend.track',['data' => $orders])->with('success','Please enter valid details');
          }

          $order = unserialize($orders->cart);


				  return view('Frontend.track',['data' => $orders,'order'=>$order]);
		 }






}
