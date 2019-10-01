<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
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
        $keyword = $request->get('search');
        $perPage = 5;

                 if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")

                ->latest()->paginate($perPage);
        } else {
            $roles = Role::latest()->paginate($perPage);
        }
        return view('roles.index',compact('roles'))->with('i',($request->input('page',1)-1)*5);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\View\View
      */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model $roles
     *
     * @return \Illuminate\View\View
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $roles){

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$roles->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('roles','permission','rolePermissions'))->with('i',($request->input('page',1)-1)*5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  model $roles
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoleUpdateRequest $request, Role $roles)
    {


          $input = array('name'=>$request->input('name') );
          $roles->update($input);
         $roles->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                   ->with('success','Role updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleRequest $request){



        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param model $roles
     *
     * @return \Illuminate\View\View
     */
     public function show(Role $roles){


         $permissions= Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
         ->where("role_has_permissions.role_id",$roles->id)
         ->get();
         return view('roles.show',compact('roles','permissions'));
     }

     /**
      * Remove the specified resource.
      *
      * @param model $banner
      *
      * @return \Illuminate\View\View
      */
     public function destroy(Role $roles){
         $roles->delete();
         return redirect()->route('roles.index')
         ->with('success','Role Deleted Successfully');

     }



}
