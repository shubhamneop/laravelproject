<?php

namespace App\Http\Controllers\FrontEnd;
use Auth;
use App\Http\Requests;
use App\Http\Requests\AddressRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use Illuminate\Http\Request;
use App\Cart;
use App\product;
use App\coupon;
use App\cat;
use DB;
use Session;
class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
         if(Auth::check()){
            $id = Auth::User()->id;
                 }else{
             $id = 0;
         }
        if (!empty($keyword)) {
            $addresses = Address::where('address1', 'LIKE', "%$keyword%")
                ->orWhere('fullname', 'LIKE', "%$keyword%")
                ->orWhere('address2', 'LIKE', "%$keyword%")
                ->orWhere('zipcode', 'LIKE', "%$keyword%")
                ->orWhere('country', 'LIKE', "%$keyword%")
                ->orWhere('state', 'LIKE', "%$keyword%")
                ->orWhere('phoneno', 'LIKE', "%$keyword%")
                ->orWhere('mobileno', 'LIKE', "%$keyword%")
                ->where('user_id',$id)
                ->latest()->paginate($perPage);
        } else {
            $addresses = Address::latest()->where('user_id',$id)->paginate($perPage);
        }

         if(Auth::check()){
             return view('Frontend.addresses.index', compact('addresses'));
                 }else{
            return redirect('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(Auth::check()){
       return view('Frontend.addresses.create');
        }else{
            return redirect('login');
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AddressRequest $request)
    {



         $userid = Auth::User()->id;
        $useraddress = new Address;

        $useraddress->fullname = $request->input('fullname');
        $useraddress->address1 = $request->input('address1');
        $useraddress->address2 = $request->input('address2');
        $useraddress->zipcode = $request->input('zipcode');
        $useraddress->country = $request->input('country');
        $useraddress->state = $request->input('state');
        $useraddress->phoneno = $request->input('phoneno');
        $useraddress->mobileno = $request->input('mobileno');
        $useraddress->user_id = $userid;


       $useraddress->save();



        return redirect('addresses')->with('flash_message', 'Address added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Address $address)
    {


        return view('Frontend.addresses.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Address $address)
    {
        //   $userid = Auth::User()->id;
        // $address = Address::findOrFail($id);

        return view('Frontend.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AddressRequest $request, Address $address)
    {


         
         $userid = Auth::User()->id;
         $useraddress = $request->all();
         $useraddress['user_id']= $userid;

         $address->update($useraddress);

        return redirect('addresses')->with('flash_message', 'Address updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Address $address)
    {
         $address->delete();

        return redirect('addresses')->with('flash_message', 'Address deleted!');
    }

   public function getAddress($id){

    if(Auth::check()){
            $uid = Auth::User()->id;
                 }else{
             $uid = 0;
         }
           $addresses = Address::where('user_id',$uid)->get();

         $data = Address::where('id',$id)->get();

      if(!Session::has('cart')){
      return view('Frontend.cart',['products'=>null]);
    }
     $oldCart = Session::get('cart');
     $cart = new Cart($oldCart);
      $coupons = coupon::all();

     return view('Frontend.data',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice,'total'=>null,'addresses'=>$addresses,'data'=>$data]);


   }

   public function saveaddress(Request $request){
    $this->validate($request,[
          'fullname'=>'required',
          'address1'=>'required',

          'country'=>'required',
          'state'=>'required',
          'mobileno'=>'required|numeric|min:10',
        ]);


         $userid = Auth::User()->id;
        $data = new Address;

        $data->fullname = $request->input('fullname');
        $data->address1 = $request->input('address1');
        $data->address2 = $request->input('address2');
        $data->zipcode = $request->input('zipcode');
        $data->country = $request->input('country');
        $data->state = $request->input('state');
        $data->phoneno = $request->input('phoneno');
        $data->mobileno = $request->input('mobileno');
        $data->user_id = $userid;


       $data->save();



        return redirect()->back()->with('flash_message', 'Address added!');
   }

}
