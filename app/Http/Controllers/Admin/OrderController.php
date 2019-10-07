<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Order_detail;
use App\Cartdetail;
use Redirect;
use App\Mail\Orderstatus;
use Illuminate\Support\Facades\Mail;
use App\User;
use DB;
use App\General;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

           $keyword = $request->get('search');
           $email = $request->get('email');
           $perPage = 5;

     if (!empty($keyword)) {
           $orders = Order_detail::whereHas('user', function ($query) use($keyword) {
                                    $query->where('email','LIKE', "%$keyword%");
                                   })->orwhere('status', 'LIKE', "%$keyword%")
                                  ->orwhere('order_no','LIKE',"%$keyword%")
                                  ->latest()->paginate($perPage);

        } else {

           $orders = Order_detail::orderBy('id','DESC')->paginate(5);

       }
          return view('admin.orders.index',compact('orders'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     *
     * @param Illuminate\Database\Eloquent\Model $order
     *
     * @return \Illuminate\View\View
     */
    public function show(Order_detail $order)
    {

         $orders = $order->cart;
         return view('admin.orders.show',compact('orders','order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Illuminate\Database\Eloquent\Model $order
     * @return \Illuminate\View\View
     */
    public function edit(Order_detail $order)
    {
         $enumoption = General::getEnumValues('order_details','status');
          $status=$order->status;
         $orders = $order->cart;
         return view('admin.orders.edit',compact('status','orders','order','enumoption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param Illuminate\Database\Eloquent\Model $order
     *
     * @return  App\Mail\Orderstatus $order
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Order_detail $order)
    {


          $dataupdate = array(
                    'status'=>$request->input('status'),
                       );
          $order->update($dataupdate);
          $id = $order->user_id;
          $user=User::find($id);
          Mail::to($user->email)->send(new Orderstatus($order));
          return redirect('admin/order')->with('success','order status changed');
    }

    public function getcartdata(){

      $order = Order_detail::all();
        // foreach ($order as $item) {
        //   echo $item->order_no; echo "  "; echo $item->cart->totalQty; echo "  "; echo $item->cart->totalPrice; echo "  "; echo $item->status; echo "  "; echo $item->created_at; echo "  "; echo $item->address['fullname']; echo "<br>";echo "<br>";
        // }
         foreach ($order as $orders) {
           foreach ($orders->cart->items as  $value) {
             return $value['item']['name'];
           }
         }
        dd($order[0]->cart);

    }


}
