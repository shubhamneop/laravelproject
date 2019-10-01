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
use Session;
class UserController extends Controller
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
     * @return \Illuminate\Http\Responce
     */
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 5;

                 if (!empty($keyword)) {
            $data = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = User::latest()->paginate($perPage);
        }

        return view('users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Model $roles
     * @return \Illuminate\View\View
     */
    public function  create(){
           $roles = Role::pluck('name', 'name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
   public function store(UserRequest $request){



        $firstname=$request->input('name');
        $lastname= $request->input('lastname');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $status=$request->input('status');
    DB::beginTransaction();
    try{
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
            Session::put('success','User created successfully');
          DB::commit();
        }catch(Exception $e){
          Session::put('success','User creation failed');
          DB::rollback();
        }

       return redirect()->route('users.index');

   }


       /**
        * Show the form for editing the specified resource.
        *
        * @param  model $user
        *
        * @return \Illuminate\View\View
        */
   public function edit(User $users){

        $roles = Role::pluck('name','name')->all();
        $userRole= $users->roles->pluck('name','name')->all();

        return view('users.edit',compact('users','roles','userRole'));

   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param  model $user
    *
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
    public function update(UserUpdateRequest $request, User $users)
    {
      DB::beginTransaction();
      try{
            $input = $request->all();
            if(!empty($input['password'])){
               $input['password'] = Hash::make($input['password']);
             }else{
               $input = array_except($input,array('password'));
             }
             $users->update($input);
              DB::table('model_has_roles')->where('model_id',$users->id)->delete();


              $users->assignRole($request->input('roles'));
              Session::put('success','User updated successfully');
            DB::commit();
          }catch(Exception $e){
            Session::put('success','User updation failed');
            DB::rollback();
          }

        return redirect()->route('users.index');

    }
    /**
     * Display the specified resource.
     *
     * @param model $user
     *
     * @return \Illuminate\View\View
     */
    public function show(User $users){

        return view('users.show',compact('users'));
    }

    /**
     * Rmove the specified resource.
     *
     * @param model $user
     *
     * @return \Illuminate\View\View
     */
    public function destroy(User $users)
    {
         $users->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }


}
