<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        //return $request->all();
        return array_merge($request->only($this->username(), 'password'),['status'=>1,'is_deleted'=>0,'is_approved'=>1,'user_role_id'=>$request->user_role_id]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        if($request->rememberme===null){
                setcookie('login_email',$request->email,100);
                setcookie('login_pass',$request->password,100);
             }
             else{
                setcookie('login_email',$request->email,time()+60*60*24*100);
                setcookie('login_pass',$request->password,time()+60*60*24*100);
 
             }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
          $errors = [$this->username() => trans('auth.failed')];

          $user = User::where($this->username(), $request->{$this->username()})->where('is_deleted','=','0')->first();
        
        

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        
        if ($user && \Hash::check($request->password, $user->password) && $user->status == 0) {
            $errors = [$this->username() => trans('You are Inactive/not approved by admin,please contact to admin.')];
        }

        if ($user && \Hash::check($request->password, $user->password) && $user->status == 1 && $user->is_approved == 0) {
            $errors = [$this->username() => trans('You are not approved by admin,please contact to admin.')];
        }

        if ($user && \Hash::check($request->password, $user->password) && $user->status == 0 && $user->is_approved == 2) {
            //$errors = [$this->username() => trans('You are rejected by admin,please contact to admin.')];
            $errors = [$this->username() => trans('Your registration has been rejected by admin, please contact to admin.')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function authenticated(Request $request, $user)
    {         
          //echo"<pre>";print_r($user->user_role_id);die;exit;
          if(!in_array(getenv("REMOTE_ADDR"),['::11']))
          {
            if(date('Y-m-d',strtotime($user->validity)) <=date('Y-m-d'))
            {
              //$errors = [$this->username() => trans('You are Inactive/not approved by admin,please contact to admin.')];
              return redirect(route('logout'))->with('success','ddd');
            }
            if ($user->user_role_id == 1) {
                return redirect(route('home'));
             } else if ($user->user_role_id == 2) {
                return redirect(route('deviceForm'));
             } else {
              abort(403);
             }
          }
          else
          {
            //echo "sdfsd";die;
            return redirect(route('logout'));
            //app('\App\Http\Controllers\Auth\LoginController')->logout();
          }
             
    }
}
