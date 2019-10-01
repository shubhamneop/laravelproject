<?php

namespace App\Http\Controllers\FrontEnd;
use Auth;
use Input;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Models\Role;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\Welcome;
use App\Mail\WelcomeAdmin;
use Illuminate\Support\Facades\Mail;
use App\Configuration;
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
    /**
    *Login the registered user
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function login(LoginRequest $request){



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
     /**
     *Destroy the session of login user
     */
    public function logout(){
        auth::logout();
           return Redirect::to('/');
       }
      /**
      *register user through Social media handle
      *
      *@param $social
      *@return Response
      */
    public function socialLogin($social) {
       return Socialite::driver($social)->redirect();
             }
   /**
    * Obtain the user information from Social Logged in.
    * @param $social
    * @return Response
    */
   public function handleProviderCallback($social)
   {
       $userSocial = Socialite::driver($social)->stateless()->user();
       $user = User::where(['email' => $userSocial->getEmail()])->first();
       if($user){
           Auth::login($user);
              return Redirect::to('/');
        }else{
           return view('Frontend.register',['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
       }
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    *
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
   public function store(RegisterRequest $request) {

     DB::beginTransaction();
     try{
            $input =$request->all();
            $input['password']= Hash::make($input['password']);
            $users = User::create($input);
            $users->assignRole('customer');
            DB::commit();
          }catch(Exception $e){
            DB::rollback();
          }
            $user = array(
               'name'=>$request->input('name'),
               'lastname'=>$request->input('lastname'),
               'email'=>$request->input('email'),
               'password'=>$request->input('password')
              );


           $user = (object)$user;

          if($users){
              Auth::login($users);
              Mail::to($users->email)->send(new Welcome($user));
              $mail = Configuration::find(1);
              Mail::to($mail->value)->send(new WelcomeAdmin($user));
                 return Redirect::to('/');
           }else{
             return view('Frontend.login');
          }

   }





}
