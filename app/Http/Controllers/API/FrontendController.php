<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
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
use App\Cart;
use App\Page;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use Auth;
use Validator;
use App\order;
use App\ordersproduct;

class FrontendController extends BaseController
{
   public function getCategory(){

     $categories = Category::with('childs')->get();

     return $this->sendResponse($categories,'All Category With Subcategory');
   }
   public function getProduct(Request $request) {
     $id = $request->id;
     $p_id = $request->p_id;
     $products = Product::whereHas('category',function($q) use($id,$p_id)
       {
         $q->where('category_id',$id);
         $q->where('p_id',$p_id);
       })->with('image')->get();

       if(count($products)<=0){
         return $this->sendError(null,'Products not found');
       }

       return $this->sendResponse($products,'All Products.');

   }

   public function getProductDetails(Request $request) {
     $id = $request->id;
     $productsDetails = Product::with('attribute','image')->find($id);

     if(is_null($productsDetails)){
       return $this->sendError(null,'Sorry, the product you are looking for could not be found.');
   }
  return $this->sendResponse($productsDetails,'Product details');

   }






    public function index(Request $request){
          $keyword = $request->get('search');
  				$perPage=6;
  				if (!empty($keyword)) {
  				  $oldCart = Session::get('cart');
  				 	$cart = new Cart($oldCart);
  					$randomproduct = Product::all()->random(3);
  					$products = Product::where('name','LIKE',"%$keyword%")
  						                     ->orwhere('description','LIKE',"%$keyword%")->get();
  					$category =  Category::parentcategory()->get();
  					$subcategory = Category::subCategory()->get();

  					$banner = Banner::all();
  					$categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
  			                  ->groupBy('category_id')
  			                  ->get();
  					if(count($cart->items)<=0){
  						   $cartvalue[] = 0;
  					  	}else{
  						foreach ($cart->items as  $value) {
  					   	$cartvalue[] = $value['item']['id'];
  							    }
  							}


  					}else{
           $products = Product::with('attribute','image','category')->get();
           $randomproduct = Product::all()->random(3);
           $category =  Category::parentcategory()->get();
           $subcategory = Category::subCategory()->get();

           $banner = Banner::all();
           $categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
                   ->groupBy('category_id')
                   ->get();
             }
        if($products==null){
          return $this->sendError(null,'Nothing to display.');
        }
       return $this->sendResponse(['products'=>$products,'randomproduct'=>$randomproduct,'category'=>$category,'subCategory'=>$subcategory,'banner'=>$banner,'categorycounts'=>$categorycounts],'All Products');
    }

    public function productdetails($id){
         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);

         $category =  Category::parentcategory()->get();
         $demo = Category::with('childs','parent')->get();
         $productsDetails = Product::with('image','attribute','category')->find($id);
         $categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
                     ->groupBy('category_id')
                     ->get();
         if(count($cart->items)<=0){
          $cartvalue[] = 0;
           }else{
           foreach ($cart->items as  $value) {
               $cartvalue[] = $value['item']['id'];
               }
             }
         if($productsDetails==null){
           return $this->sendError(null,'Sorry, the page you are looking for could not be found.');
       }
      return $this->sendResponse(['cartvalue'=>$cartvalue,'category'=>$category,'productsDetails'=>$productsDetails,'categorycounts'=>$categorycounts],'Product details');
    }

    public function productcatgory($id){
         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);

         $category =  Category::parentcategory()->get();
         $categorycounts =	Productcategory::select('category_id', DB::raw('count(*) as total'))
                  ->groupBy('category_id')
                  ->get();
         if(count($cart->items)<=0){
            $cartvalue[] = 0;
          }else{
          foreach ($cart->items as  $value) {
             $cartvalue[] = $value['item']['id'];
             }
           }
         $products = Product::whereHas('category',function($q) use($id)
           {
             $q->where('category_id',$id);
           })->with('image')->get();
          $category =  Category::parentcategory()->get();
          if(count($products)<=0){
            return $this->sendError(null,'no product in this category.');
          }
         return $this->sendResponse(['products'=> $products,'category'=>$category,'cartvalue'=>$cartvalue,'categorycounts'=>$categorycounts],'Category related Products');
    }

    public function getOrder(){

         $orders = Auth::User()->orderDetails;

         if(count($orders)<=0){
           return $this->sendError(null,'Customer does not have order.');
           }
        return $this->sendResponse($orders,'user Ordred Product');

    }

    public function trackorder(Request $request){
         $validator = Validator::make($request->all(),[
           'email'=>'required|email',
           'orderid'=>'required',
         ]);
         if($validator->fails()){
           return $this->sendError(null,'Please enter valid details.');
         }
         $email = $request->input('email');
         $orderid = $request->input('orderid');
          $orders =Order_detail::whereHas('user', function ($query) use($email) {
                                   $query->where('email',$email);
                                  })->where('order_no',$orderid)
                                    ->first();

         if ($orders==null) {
           return $this->sendError(null,'Order not found.');
         }
         return $this->sendResponse(['id'=>$orders->order_no,'status'=>$orders->status],'Order Status');


    }

    public function pages(Request $request){
      $pages = Page::where('slug',$request->slug)->get();
      if (is_null($pages)) {
           return $this->sendError(null,'Page not found.');
       }
       return $this->sendResponse($pages,'Page Information.');
    }


}
