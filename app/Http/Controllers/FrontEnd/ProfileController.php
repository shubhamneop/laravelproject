<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassworRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateImageRequest;
use App\User;
use Auth;
use DB;
use File;
use Hash;


class ProfileController extends Controller
{
     /**
     *Display user details
     *
     * @param Auth $user
     * @return \Illuminate\View\View
     */
     public function index(){
         $id = Auth::User()->id;
           $profile = User::all()->find($id);

         return view('Frontend.Profile.profile',compact('profile'));

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param Auth $user
      * @return \Illuminate\Http\Response
      */
     public function update(UpdateProfileRequest $request){


              $id = Auth::User()->id;
              $user =  User::where('id',$id);
              $dataupdate = array(
                          'name'=> $request->input('name'),
                          'lastname'=>$request->input('lastname'),
                          'email' => $request->input('email'),
                             );

                   $user->update($dataupdate);


          return redirect()->back()->with('success','Profile Updated');

     }
     /**
      * Update the profile_image in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param Auth $user
      * @return \Illuminate\Http\Response
      */
     public function updateimage(UpdateImageRequest $request){


         $id = Auth::User()->id;
         $user =  User::where('id',$id);
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


        return redirect()->back()->with('success','Profile Updated');
     }

     /**
      * Update the password  resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param Auth $user
      * @return \Illuminate\Http\Response
      */
    public function changePassword(ChangePasswordRequest $request){


      $user = User::find(Auth::id());

       if (!Hash::check($request->password_current, $user->password)) {
           return redirect()->back()->with('error', 'Current password does not match!');

       }

       $user->password = Hash::make($request->password);
       $user->save();

      return redirect('profile')->with('success','Password Changed Successfully !');
    }






}
