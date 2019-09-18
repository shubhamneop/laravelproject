<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Order_detail;
use App\Used_coupon;

class ReportController extends Controller
{

  function ___construct()
  {
      $this->middleware('permission:report-list');
      $this->middleware('permission:report-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:report-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:report-delete', ['only' => ['destroy']]);

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $keyword=$request->get('search');

      $start = date("Y-m-d",strtotime($request->get('fromdate')));
      $end = date("Y-m-d",strtotime($request->get('todate')));
      $perPage = 5;
      if (!empty($keyword)) {
        $users = User::whereHas('roles' , function($q){
         $q->where('name', 'customer');
       })->where('email','LIKE',"%$keyword%")
         ->orwhere('name','LIKE',"%$keyword%")
         ->orwhere('lastname','LIKE',"%$keyword%")
              ->paginate($perPage);

      }else{
       if ('1970-01-01'!=($start)) {
             $users = User::whereHas('roles' , function($q){
              $q->where('name', 'customer');
            })->whereBetween('created_at',[$start,$end])
                   ->paginate($perPage);

        } else {

           $users = User::whereHas('roles' , function($q){
            $q->where('name', 'customer');
           })->orderBy('id','DESC')->paginate($perPage);
       }

     }
        return view('admin.reports.customer.index',compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);
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
    {      $user = User::find($id);
          $orders = $user->orderDetails;
          $orders->transform(function($order,$key){
          $order->cart = unserialize($order->cart);
           return $order;
              });
        return view('admin.reports.customer.show',compact('orders'));

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
        //
    }

    public function allCoupon(Request $request){

           $keyword = $request->get('search');
           $perPage = 5;

      if (!empty($keyword)) {
            $coupons = Used_coupon::whereHas('user', function ($query) use($keyword) {
                                     $query->where('email','LIKE', "%$keyword%");
                                   })->orwhereHas('coupon',function($query) use($keyword){
                                     $query->where('code','LIKE',"%$keyword%");
                                   })->with('coupon','user','order_detail')->latest()->paginate($perPage);

         } else {

            $coupons = Used_coupon::with('coupon','user','order_detail')->orderBy('id','DESC')->paginate($perPage);
        }



    return view('admin.reports.coupons.index',compact('coupons'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function sales(Request $request){
        $keyword=$request->get('search');
        $start = date("Y-m-d",strtotime($request->get('fromdate')));
        $end = date("Y-m-d",strtotime($request->get('todate')));

      if(!empty($keyword)){
        $sales= Order_detail::where('order_no','LIKE',"%$keyword%")->get();
        $sales->transform(function($order,$key){
          $order->cart=unserialize($order->cart);
          return $order;
           });

      }else {

        if('1970-01-01'!=($start)){
                 $start = $start.' '.'00:00:00';
                 $end = $end.' '.'23:59:58';
                 $sales= Order_detail::whereBetween('created_at',[$start,$end])->get();

                 $sales->transform(function($order,$key){
                 $order->cart=unserialize($order->cart);
                 return $order;
                    });

          }else{
           $sales= Order_detail::all();
           $sales->transform(function($order,$key){
           $order->cart=unserialize($order->cart);
           return $order;
         });
       }
      }
      return view('admin.reports.sales.index',compact('sales'));
    }
}