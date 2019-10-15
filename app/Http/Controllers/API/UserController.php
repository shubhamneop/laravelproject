<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\RegisterRequest;
use Auth;
use Hash;
use Validator;
use App\User;

class UserController extends BaseController
{
    public function login() {
      if(Auth::attempt(['email'=>request('email'),'password'=> request('password')])){

         $user = Auth::user();
         $user->createToken('Laravel')-> accessToken;
        return $this->sendResponse($user, ' Login successfully.');
      }else{

        return $this->sendError(null,'Invalid Credentials !');

      }

    }

    public function register(Request $request){

         $validator = Validator::make($request->all(), [
           'name'=>'required',
            'lastname'=>'required',
           'email'=>'required|email|unique:users,email',
           'password'=>'required|min:6|required_with:password_confirmation|same:password_confirmation',
        ]);
        if ($validator->fails()) {
            return $this->sendError(null, 'Account not created try again');
        }
      $input =$request->all();
      $input['password']= Hash::make($input['password']);
      $users = User::create($input);
      $users->createToken('Laravel')-> accessToken;
      $users->assignRole('customer');

         return $this->sendResponse($users, 'Account created successfully.');


    }


}
