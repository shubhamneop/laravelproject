<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

class ProfileController extends Controller
{
     public function index(){
         $id = Auth::User()->id;
           $profile = User::all()->find($id);

         return view('Frontend.Profile.profile',compact('profile'));

     }

     public function update(Request $request){

          $this->validate($request,[
            'name'=>'required|alpha',
            'lastname'=>'required|alpha',
            'email'=>'required|email'
              ]);
              $id = Auth::User()->id;
              $user =  User::where('id',$id);
              $dataupdate = array(
                          'name'=> $request->input('name'),
                          'lastname'=>$request->input('lastname'),
                          'email' => $request->input('email')

                             );

                   $user->update($dataupdate);


          return redirect()->back()->with('success','Profile Updated');

     }
}
