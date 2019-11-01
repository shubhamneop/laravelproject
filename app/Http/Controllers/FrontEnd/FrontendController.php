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
use App\Cart;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use Auth;
use App\order;
use App\ordersproduct;
class FrontendController extends Controller
{

	/**
	 * Display a listing of the resource. for front product page
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request){
          $keyword = $request->get('search');
					$perPage=6;
				  if (!empty($keyword)) {
						$oldCart = Session::get('cart');
					 $cart = new Cart($oldCart);
					 $randomproduct = Product::all()->random(3);
					 $randomproduct1 = Product::all()->random(3);

						$products = Product::where('name','LIKE',"%$keyword%")
						                     ->orwhere('description','LIKE',"%$keyword%")
																 ->orwhereHas('category',function($q) use($keyword){
				                             $q->where('category_name','LIKE',"%$keyword%");
				                         })->Activeproduct()->paginate($perPage);
						$category =  Category::parentcategory()->Activecategory()->get();
						$subcategory = Category::subCategory()->Activecategory()->get();

						$banner = Banner::Activebanner()->get();
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
						$oldCart = Session::get('cart');
						$cart = new Cart($oldCart);
            $randomproduct = Product::all()->random(3);
						$randomproduct1 = Product::all()->random(3);
            $category =  Category::parentcategory()->Activecategory()->get();
            $products = Product::Activeproduct()->paginate($perPage);
				    $subcategory = Category::subCategory()->Activecategory()->get();

						$banner = Banner::Activebanner()->get();

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



				}
    	return view('Frontend.index',compact('randomproduct','randomproduct1','cartvalue','products','category','subcategory','banner','categorycounts'));
    }

		/**
		 * Display a product details .
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\View\View
		 */
   public function details($id){
		 $oldCart = Session::get('cart');
		 $cart = new Cart($oldCart);

        $category =  Category::parentcategory()->Activecategory()->get();
        $demo = Category::with('childs','parent')->get();
        $productsDetails = Product::with('image','attribute','category')->findOrFail($id);
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
        return view('Frontend.product-details',compact('cartvalue','products','category','productsDetails','categorycounts'));
    }

    public function shop(){
    	return view('Frontend.demo');
    }

		/**
		 * Display a listing of the resource with specified category.
		 *
		 * @param \Illuminate\Http|Request $request
		 *
		 * @return \Illuminate\View\View
		 */
    public function productCattegory(Request $request){

       $id = $request->id;
      $perPage=5;
			$oldCart = Session::get('cart');
			$cart = new Cart($oldCart);
        $randomproduct = Product::all()->random(3);
				$randomproduct1 = Product::all()->random(3);
			 $products = Product::whereHas('category',function($q) use($id)
			 {
			 $q->where('category_id',$id);
			 })->with('image')->Activeproduct()->paginate($perPage);
       $category =  Category::parentcategory()->Activecategory()->get();
			 $subcategory = Category::subCategory()->Activecategory()->get();
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

      return view('Frontend.index',compact('randomproduct','randomproduct1','cartvalue','products','category','subcategory','banner','categorycounts'));



    }
		/**
		 * Display a listing of the resource with specified category on index page.
		 *
		 * @param \Illuminate\Http|Request $request
		 *
		 * @return \Illuminate\View\View
		 */
     public function productBySubcategory(Request $request){

            $id = $request->id;
						$oldCart = Session::get('cart');
						$cart = new Cart($oldCart);
            $productss =Product::whereHas('category',function($q) use($id)
	            	   {
	             	    $q->where('category_id',$id);
	              	 })->with('image')->Activeproduct()->get();
			     	$products = Product::all();
			    	$subcategory = Category::subCategory()->Activecategory()->get();
            $category =  Category::parentcategory()->Activecategory()->get();
						if(count($cart->items)<=0){
		 				 $cartvalue[] = 0;
		 				 	}else{
		 					foreach ($cart->items as  $value) {
		 						$cartvalue[] = $value['item']['id'];
		 				 			}
		 				 		}

        return view('Frontend.demo',compact('cartvalue','productss', json_decode($productss, true),'category','products','subcategory'));



    }

		 /**
		 *Display listing orders of login user
		 *
		 * @param Auth $user
		 * @return \Illuminate\Http\Response
		 */
    public function getOrder(){
        if(Auth::guest()) {
         return redirect('login')->with('message', 'Please Login !');
             }

          $orders = Auth::User()->orderDetails;

       return view('Frontend.order',compact('orders'));
    }
		/**
		*Display the order status for given user and orders
		*
		* @param \Illuminate\Http\Request $request
		* @return \Illuminate\View\View
		*/
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
          $order = $orders->cart;
			  return view('Frontend.track',['data' => $orders,'order'=>$order]);
		 }






}
