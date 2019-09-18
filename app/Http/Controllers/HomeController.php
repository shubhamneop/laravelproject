<?php

namespace App\Http\Controllers;
use App\User;
use App\Order_detail;
use App\Contactus;
use DB;
use Charts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $orders = Order_detail::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
              ->get();
         $chart = Charts::database($orders, 'bar', 'highcharts')
            ->title("Monthly Order Placed")
            ->elementLabel("Total Orders")
            ->dimensions(500, 350)
            ->responsive(false)
            ->groupByMonth(date('Y'), true);
         $usercount = User::count();
         $ordercount = Order_detail::count();
         $msgcount = Contactus::count();
        return view('index',compact('usercount','ordercount','msgcount','chart'));
    }
}
