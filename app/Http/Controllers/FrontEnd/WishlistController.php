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
        $wishlists = Wishlist::with('product')->where('user_id',$id)->get();

        return view('Frontend.wishlist',compact('wishlists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
