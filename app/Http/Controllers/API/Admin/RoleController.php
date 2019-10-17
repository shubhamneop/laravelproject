<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Validator;

class RoleController extends BaseController
{
  function ___construct()
  {
      $this->middleware('permission:role-list');
      $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:role-delete', ['only' => ['destroy']]);

  }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request){

          $roles = Role::latest()->get();

      return $this->sendResponse($roles,'Listing roles.');
   }



  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param  model $roles
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function update(Request $request){

    $validator = Validator::make($request->all(),[
      'name' => 'required|unique:roles,name,'.$request->id,
      'permission' => 'required',
    ]);
    if($validator->fails()){
      return $this->sendError(null,'Please fill proper data.');
    }
      $roles= Role::find($request->id);
      if (is_null($roles)) {
           return $this->sendError(null,'Role not found.');
       }
      $input = array('name'=>$request->input('name') );
      $roles->update($input);
      $roles->syncPermissions($request->input('permission'));

    return $this->sendResponse($roles,'Role updated successfully');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(Request $request){
       $validator = Validator::make($request->all(),[
         'name' => 'required|unique:roles,name',
         'permission' => 'required',
       ]);
       if($validator->fails()){
         return $this->sendError(null,'Please fill proper data.');
       }

      $role = Role::create(['name' => $request->input('name')]);
      $role->syncPermissions($request->input('permission'));

      return $this->sendResponse($role,'Role created successfully.');


  }
  /**
   * Display the specified resource.
   *
   * @param model $roles
   *
   * @return \Illuminate\View\View
   */
   public function show(Request $request){

       $roles = Role::find($request->id);
       if (is_null($roles)) {
            return $this->sendError(null,'Role not found.');
        }
       $permissions= Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
       ->where("role_has_permissions.role_id",$roles->id)
       ->get();
      return $this->sendResponse(['roles'=>$roles,'permissions'=>$permissions],'Role permissions.');
   }

   /**
    * Remove the specified resource.
    *
    * @param model $banner
    *
    * @return \Illuminate\View\View
    */
   public function destroy(Request $request){
     if(empty($request->all())){
       return $this->sendError(null,'Element not found');
     }
     $roles= Role::find($request->id);
     if (is_null($roles)) {
          return $this->sendError(null,'Role not found.');
      }
      $roles->delete();
      return $this->sendResponse(true,'Role deleted successfully.');


   }


}
