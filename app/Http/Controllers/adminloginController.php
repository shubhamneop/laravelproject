<?php

namespace App\Http\Controllers;
use Auth;
use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;


class adminloginController extends Controller
{

   
    use AuthenticatesUsers;
protected $redirectTo = 'admin';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       

    }

    public function login(Request $request){

       $this->validate($request,[

           'email'=>'required',
           'password'=>'required',

           ], [
            'email.required'=>'please enter email id',
            'password.required'=>'please enter password',


           ]);

           $userdata = array(
             'email'=>$request->input('email'),
               'password'=>$request->input('password'),
           );
           if(Auth::attempt($userdata)){
               if(Session::get('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                
                return Redirect::to($oldUrl);
                Session::forget('oldUrl');
                 }
               return Redirect::to('admin-dash');
             

           }else{
               return Redirect::to('admin');
           }

    }

    public function logout(){
        auth::logout(); 
           return Redirect::to('admin');
       }

}