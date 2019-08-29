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
use App\Used_coupon;
use App\coupon;
use DB;
use Auth;
class FrontendController extends Controller
{
	public function index(){
	  // $products = product::with('image','attribute','category')->get();
	   //dd($products->image);
        $category =  cat::where('p_id',0)->get();
       $demo = cat::with('childs','parent')->get();

      // dd($demo);
/*
        $parents  = DB::table('cats')
            ->join('cats as c','c.p_id','=','cats.id')
            ->select('cats.id','cats.category_name','cats.p_id')
             ->get();
             dd($parents);
             */
		$products = DB::table('products')
     ->join('productimages','productimages.product_id','=','products.id')
     ->join('productcategories','productcategories.product_id','=','products.id')
     ->join('cats','cats.id','=','productcategories.category_id')
     ->join('productattributesassocs','productattributesassocs.product_id','=','products.id')
     ->select('products.id','products.name','products.description','productimages.image_path','cats.category_name','products.price','productattributesassocs.color','productattributesassocs.quantity')

	->get();


    	return view('Frontend.index',compact('products','category'));
    }


   public function details($id){
      // $products = product::with('image','attribute','category')->get();
       //dd($products->image);
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

        $products = DB::table('products')
        ->join('productcategories','productcategories.product_id','products.id')
        ->join('cats','cats.id','productcategories.category_id')
        ->join('productimages','productimages.product_id','products.id')
        ->where('cats.id',$id)
        ->get();
             $category =  cat::where('p_id',0)->get();
      return view('Frontend.index',compact('products','category'));



    }

     public function proCat(Request $request){

       $id = $request->id;

       $productss = DB::table('products')
        ->join('productcategories','productcategories.product_id','products.id')
        ->join('cats','cats.id','productcategories.category_id')
        ->join('productimages','productimages.product_id','products.id')
        ->where('cats.id',$id)
        ->get();
             $category =  cat::where('p_id',0)->get();
        return view('Frontend.demo',compact('productss','category'));



    }

    public function getOrder(){
        if(Auth::guest()) {
         return redirect('login')->with('message', 'Please Login !');
             }
             $data = User::with('orderDetails')->get();
        $orders = Auth::User()->orderDetails;
        $orders->transform(function($order,$key){
         $order->cart = unserialize($order->cart);
         return $order;
        });

       return view('Frontend.order',compact('orders','data'));
    }

		public function test(){
			$id = Auth::User()->id;
	  $data =  Used_coupon::with('coupon')->where('user_id',$id)->get();
        foreach ($data as $key => $value) {
            $ids[] = $value->coupon_id;

            }
			 	$users =   coupon::whereNotIn('id',$ids)
			                    ->get();
			foreach ($users as  $value) {
					echo "$value->code";
			}

				// $coupon = coupon::whereIn('id','!=',$ids)->get();
				// echo "$coupon";echo "<br>";

	  // $data = coupon::with('usedcoupon')->get();
    // dd($data);
		// foreach ($data as $value) {
		//     dd($value);
		// }
		// 	 //
		// 	 // foreach ($data as $p) {
		// 		//      dd($p);
   //     //        }
		// 	 //  foreach($data as $value){
		// 		// 	$coupon = coupon::where('id','!=',$value->coupon_id)->get();
		// 		// 	dd($coupon);
	 //
		// 	 }


		}


}
