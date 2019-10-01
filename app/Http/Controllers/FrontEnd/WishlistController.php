<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wishlist;
use Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $id = Auth::User()->id;
        $wishlists = Wishlist::with('product')->where('user_id',$id)->select('product_id')->distinct()->get();

        return view('Frontend.wishlist',compact('wishlists'));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      if(Auth::guest()) {
              return redirect('login')->with('message', 'Please Login !');
           }
          $productid = $request->id;
          $id = Auth::User()->id;

          $product = new Wishlist;
          $product->user_id = $id;
          $product->product_id =  $productid;

          $product->save();
          return redirect()->back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $uid = Auth::User()->id;
           Wishlist::where('product_id',$id)->where('user_id',$uid)->delete();

         return redirect('wishlist')->with('success','product Removed');
    }
}
