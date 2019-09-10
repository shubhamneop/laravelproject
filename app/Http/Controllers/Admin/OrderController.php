<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order_detail;
use Redirect;
use App\Mail\Orderstatus;
use Illuminate\Support\Facades\Mail;
use App\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $keyword = $request->get('search');
   $perPage = 5;

   if (!empty($keyword)) {
      $orders = Order_detail::where('status', 'LIKE', "%$keyword%")
           ->latest()->paginate($perPage);
           $orders->transform(function($order,$key){
           $order->cart = unserialize($order->cart);
           return $order;
            });
        } else {

           $orders = Order_detail::orderBy('id')->paginate(5);
          $orders->transform(function($order,$key){
          $order->cart = unserialize($order->cart);
          return $order;
           });
       }
        return view('admin.orders.index',compact('orders'))->with('i', ($request->input('page', 1) - 1) * 5);
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
    {
        //
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
      $order = Order_detail::find($id);

         $orders = unserialize($order->cart);
         return view('admin.orders.edit',compact('orders','order'));
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

        $order = Order_detail::find($id);

        $dataupdate = array(
                    'status'=>$request->input('status'),
                       );
              $order->update($dataupdate);

              $id = $order->user_id;
              $user=User::find($id);

              Mail::to($user->email)->send(new Orderstatus($order));
        return redirect('admin/order')->with('success','order status changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
