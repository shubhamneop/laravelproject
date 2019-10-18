<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
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

class CartController extends BaseController
{


  public function getAddToCart(Request $request){

       $product = Product::with('image','attribute','category')->find($request->id);
       if(is_null($product)){
         return $this->sendError(null,'Element not found');
       }
       $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->add($product,$product->id);

          $data = session()->put('cart', $cart);
       return $this->sendResponse($data,'Product added in cart');

  }

  public function getCart(){

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return $this->sendResponse($cart,'Cart Product.');

      }




}
