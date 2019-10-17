<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Spatie\Permission\Models\Role;
use App\User;
use DB;
use Hash;
use Session;
use Validator;

class UserController extends BaseController
{
  function ___construct()
  {
      $this->middleware('permission:user-list');
      $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:user-delete', ['only' => ['destroy']]);

  }

  /**
   * Display a listing of the resource.
   *
   * @param \Illuminate\Http\Request $request
   * @return json
   */
  public function index(Request $request){
          $users = User::latest()->get();
      return $this->sendResponse($users,'Listing all users.');
  }

  public function store(Request $request){
     $validator = Validator::make($request->all(),[
       'name'=>'required',
       'lastname'=>'required',
       'email'=>'required|email|unique:users,email',
       'password' => 'min:6|required_with:confirm-password|same:confirm-password',
       'confirm-password' => 'min:6',
       'roles'=>'required',
       'status'=>'required',
     ]);
     if($validator->fails()){
       return $this->sendError(null,'Please fill proper data.');
     }
   DB::beginTransaction();
   try{
         $input = $request->all();
         $input['password']= Hash::make($request->password);
         $user = User::create($input);
         $user->assignRole($request->input('roles'));

         DB::commit();
           return $this->sendResponse($user,'User created successfully');
       }catch(Exception $e){
         DB::rollback();
         return $this->sendError(null,'User creation failed');
       }

      // return redirect()->route('users.index');

  }

  public function update(Request $request) {

    $validator = Validator::make($request->all(),[
      'name'=>'required',
      'lastname'=>'required',
      'email'=>'required|email|unique:users,email,'.$request->id,
      'password' => 'min:6|required_with:confirm-password|same:confirm-password',
      'confirm-password' => 'min:6',
      'roles'=>'required',
      'status'=>'required',
    ]);
    if($validator->fails()){
      return $this->sendError(null,'Please fill proper data.');
    }
    DB::beginTransaction();
    try{
          $input = $request->all();
          if(!empty($input['password'])){
             $input['password'] = Hash::make($input['password']);
           }else{
             $input = array_except($input,array('password'));
           }
           $users = User::find($request->id);
           $users->update($input);
           DB::table('model_has_roles')->where('model_id',$users->id)->delete();

           $users->assignRole($request->input('roles'));
           DB::commit();
           return $this->sendResponse($users,'User updated successfully');

        }catch(Exception $e){
          DB::rollback();
          return $this->sendError(null,'User updation failed');
          }

  }


  public function show(Request $request){
    if(empty($request->all())){
      return $this->sendError(null,'Element not found');
    }
     $users = User::with('roles')->findOrFail($request->id);
     return $this->sendResponse($users,'User Information.');
  }

  public function destroy(Request $request) {
    if(empty($request->all())){
      return $this->sendError(null,'Element not found');
    }
    $users = User::findOrFail($request->id);
     DB::table('model_has_roles')->where('model_id',$users->id)->delete();
     $user = $users->delete();

     return $this->sendResponse($user,'User deleted successfully.');
  }


}
