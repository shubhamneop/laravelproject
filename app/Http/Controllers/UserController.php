<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use DB;
use Hash;
class UserController extends Controller
{

    function ___construct()
    {
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }


    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 5;
        // $coupons = coupon::orderBy('id')->paginate(10);
                 if (!empty($keyword)) {
            $data = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = User::latest()->paginate($perPage);
        }

     //   $data = User::orderBy('id','desc')->paginate(2);
        return view('users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);;
    }
    public function  create(){
           $roles = Role::pluck('name', 'name')->all();
        return view('users.create',compact('roles'));
    }
    public function  create2(){
        $roles = Role::pluck('name', 'name')->all();
     return view('users.new2',compact('roles'));
 }

   public function store(UserRequest $request){



        $firstname=$request->input('name');
        $lastname= $request->input('lastname');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $status=$request->input('status');

      $user = new user();

      $user->name=$firstname;
      $user->lastname=$lastname;
      $user->email=$email;
      $user->password=$password;
      $user->status=$status;
      $user->save();

          // $input =$request->all();
          // $input['password']= Hash::make($input['password']);
          // $user = User::create($input);
          $user->assignRole($request->input('roles'));


       return redirect()->route('users.index')
           ->with('success','User created successfully');
   }
   public function edit($id){
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole= $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));

   }
    public function update(UserUpdateRequest $request, $id)
    {
      
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }
    public function show($id){
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }


}
