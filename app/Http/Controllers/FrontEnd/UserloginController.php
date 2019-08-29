<?php

namespace App\Http\Controllers\FrontEnd;
use Auth;
use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Models\Role;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use DB;
use Hash;
use Session;
class UserloginController extends Controller
{

    use AuthenticatesUsers;

     protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');


    }

    public function login(Request $request){

       $this->validate($request,[

           'email'=>'required',
           'password'=>'required',

           ], [
            'email.required'=>'please enter email id',
            'password.required'=>'please enter password',


           ]);

           $userdata = array(
             'email'=>$request->input('email'),
               'password'=>$request->input('password'),
           );
           if(Auth::attempt($userdata)){

               return Redirect::to('/');


           }else{
               return Redirect::to('login')->with('message','Username or Password is incorrect ! ');
           }

    }

    public function logout(){
        auth::logout();
           return Redirect::to('/');
       }

    public function socialLogin($social)
          {
       return Socialite::driver($social)->redirect();
             }
   /**
    * Obtain the user information from Social Logged in.
    * @param $social
    * @return Response
    */
   public function handleProviderCallback($social)
   {
       $userSocial = Socialite::driver($social)->user();
       $user = User::where(['email' => $userSocial->getEmail()])->first();
       if($user){
           Auth::login($user);
              return Redirect::to('/');
        }else{
           return view('Frontend.register',['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
       }
   }






   public function store(Request $request){

            $this->validate($request,[
                 'name'=>'required',
                  'lastname'=>'required',
                 'email'=>'required|email|unique:users,email',
                 'password'=>'required|min:6|required_with:password_confirmation|same:password_confirmation',

            ]);
          $input =$request->all();
          $input['password']= Hash::make($input['password']);
          $user = User::create($input);
          $user->assignRole('customer');


       return view('Frontend.login');






   }





}
