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

     public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 5;
        
                 if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")

                ->latest()->paginate($perPage);
        } else {
            $roles = Role::latest()->paginate($perPage);
        }
        //$roles = role::orderBy('id')->paginate(5);
        return view('roles.index',compact('roles'))->with('i',($request->input('page',1)-1)*5);
     }


    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    public function edit(Request $request, Role $roles){

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$roles->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('roles','permission','rolePermissions'))->with('i',($request->input('page',1)-1)*5);
    }

    public function update(RoleUpdateRequest $request, $id)
    {


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }
    public function store(RoleRequest $request){



        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
    }
     public function show(Role $roles){


         $permissions= Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
         ->where("role_has_permissions.role_id",$roles->id)
         ->get();
         return view('roles.show',compact('roles','permissions'));
     }


     public function destroy(Role $roles){
         $roles->delete();
         return redirect()->route('roles.index')
         ->with('success','Role Deleted Successfully');

     }



}
