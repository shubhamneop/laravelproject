<?php

namespace App\Http\Controllers\API\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Auth;
use Validator;
use File;
use Hash;
use App\User;

class ProfileController extends BaseController
{
    public function index(){

      $profile = User::findOrFail(Auth::user()->id);

      return $this->sendResponse($profile,'User Profile Details');
    }


    public function updateprofile(Request $request){
        $validator = Validator::make($request->all(),[
          'name'=>'required',
          'lastname'=>'required',
          'email'=>'required|email'
        ]);

        if($validator->fails()){
          return $this->sendError(null,'something went wrong.');
        }

        $user =  User::where('id',Auth::User()->id);
        $dataupdate = array(
                    'name'=> $request->input('name'),
                    'lastname'=>$request->input('lastname'),
                    'email' => $request->input('email'),
                       );

         $user->update($dataupdate);

         return $this->sendResponse($user,'Profile updated Successfully');

    }

    public function updateprofileimage(Request $request){
      $validator = Validator::make($request->all(),[
           'profile'=>'required|image',
      ]);

      if($validator->fails()){
        return $this->sendError(null,'something went wrong.');
      }


      $user =  User::where('id',Auth::User()->id);
      $path = public_path('User_profile');

      if(!File::isDirectory($path)){
        File::makeDirectory($path, 0777, true, true);
         }
      $name = Auth::User()->name;
      $profileImage = $request->file('profile');
      $profileImageSaveAsName = $name."-".time() . "." .
      $profileImage->getClientOriginalExtension();

      $profile_image_url = $profileImageSaveAsName;
      $success = $profileImage->move($path, $profileImageSaveAsName);


      $dataupdate = array(
                'profile_image'=>$profile_image_url,
                   );
       $user->update($dataupdate);
       return $this->sendResponse($user,'Profile picture updated.');

    }

    public function changePassword(Request $request){

       $validator = Validator::make($request->all(),[
         'password_current'=>'required',
         'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
         'password_confirmation' => 'min:6',
       ]);

       if($validator->fails()){
         return $this->sendError(null,'Plase Provide Proper Data.');
       }

       $user = User::find(Auth::id());

        if (!Hash::check($request->password_current, $user->password)) {
            return $this->sendError(null,'Current password does not match!');

        }

        $user->password = Hash::make($request->password);
        $user->save();

       return $this->sendResponse($user,'Password Changed Successfully !');
    }
}
