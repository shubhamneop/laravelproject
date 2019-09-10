<?php

namespace App\Http\Controllers;
use App\User;
use App\Order_detail;
use App\Contactus;

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
         $usercount = User::count();
         $ordercount = Order_detail::count();
         $msgcount = Contactus::count();
        return view('index',compact('usercount','ordercount','msgcount'));
    }
}
