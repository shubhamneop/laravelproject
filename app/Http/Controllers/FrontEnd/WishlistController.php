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
        $wishlists =  Auth::user()->userwishlist;

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
          Auth::User()->userwishlist()->attach($request->id);

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
           Auth::User()->userwishlist()->detach($id);
         return redirect('wishlist')->with('success','product Removed');
    }
}
