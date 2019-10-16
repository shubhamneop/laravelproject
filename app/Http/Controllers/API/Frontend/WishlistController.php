<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Auth;
class WishlistController extends BaseController
{
    public function index(){
      $wishlists = Auth::user()->userwishlist;
       if(count($wishlists)<=0){
         return $this->sendError(null,'Nothing in wishlist');
       }
      return $this->sendResponse($wishlists,'User wihslist.');
    }

    public function store(Request $request){

      $wishlists = Auth::User()->userwishlist()->attach($request->id);

      return $this->sendResponse($wishlists,'Product added in wishlist');

    }


    public function remove(Request $request){

     $wishlists = Auth::User()->userwishlist()->detach($request->id);
     if($wishlists==false){
       return $this->sendError(null,'Product not in wishlist');
     }
       return $this->sendResponse($wishlists,'Product removed from wishlist');

    }
}
