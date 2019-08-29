<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    // function ___construct()
    // {
    //     $this->middleware('permission:role-list');
    //     $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:role-delete', ['only' => ['destroy']]);

    // }

     public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 5;
        // $coupons = coupon::orderBy('id')->paginate(10);
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

    public function edit(Request $request, $id){
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('role','permission','rolePermissions'))->with('i',($request->input('page',1)-1)*5);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }
    public function store(Request $request){
        $this->validate($request ,[
        'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
    }
     public function show($id){
         $role = Role::find($id);
         $permissions= Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
         ->where("role_has_permissions.role_id",$id)
         ->get();
         return view('roles.show',compact('role','permissions'));
     }


     public function destroy($id){
         Role::where('id',$id)->delete();
         return redirect()->route('roles.index')
         ->with('success','Role Deleted Successfully');

     }
      


}