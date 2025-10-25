<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('email');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'username' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    protected function credentials(Request $request)
    {
        //return $request->all();
        return array_merge($request->only($this->username(), 'password'), ['status' => 1, 'is_deleted' => 0, 'is_approved' => 1, 'user_role_id' => $request->user_role_id]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password'        => 'required|string',
        ]);

        if ($request->rememberme === null) {
            setcookie('login_email', $request->email, 100);
            setcookie('login_pass', $request->password, 100);
        } else {
            setcookie('login_email', $request->email, time() + 60 * 60 * 24 * 100);
            setcookie('login_pass', $request->password, time() + 60 * 60 * 24 * 100);

        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load the user if it exists and not deleted
        $user = User::where($this->username(), $request->{$this->username()})
            ->where('is_deleted', 0)
            ->first();

        // If user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {

            if ($user->status == 0 && $user->is_approved == 2) {
                // User rejected
                $errors = [$this->username() => trans('Your registration has been rejected by admin, please contact to admin.')];
            } elseif ($user->status == 0) {
                // User inactive
                $errors = [$this->username() => trans('You are inactive/not approved by admin, please contact admin.')];
            } elseif ($user->status == 1 && $user->is_approved == 0) {
                // User active but not approved
                $errors = [$this->username() => trans('You are not approved by admin, please contact admin.')];
            }

        }

        // Return JSON response if requested
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        // Otherwise, redirect back with input and errors
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function authenticated(Request $request, $user)
    {

        if (date('Y-m-d', strtotime($user->validity)) <= date('Y-m-d')) {
            //$errors = [$this->username() => trans('You are Inactive/not approved by admin,please contact to admin.')];
            return redirect(route('logout', ['validityfaild' => 'Access Validity End']))->with('success', 'ddd');
        }
        if ($user->user_role_id == 1) {
            return redirect(route('home'));
        } else if ($user->user_role_id == 2) {
            return redirect(route('deviceForm'));
        } else {
            abort(403);
        }

    }

    /*protected function authenticated(Request $request, $user)
    {

          if(!in_array($this->getUserIpAddr(),[$user->wifi_address]))
          {

            if(date('Y-m-d',strtotime($user->validity)) <=date('Y-m-d'))
            {
              //$errors = [$this->username() => trans('You are Inactive/not approved by admin,please contact to admin.')];
              return redirect(route('logout',['validityfaild'=>'Access Validity End']))->with('success','ddd');
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
              return redirect(route('logout',['validityfaild'=>'Denied Access from IP address']))->with('success','ddd');

          }

    }*/

    public function logout(Request $request)
    {
        // dd('hello');
        //return $request->all();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $response = $this->loggedOut($request);
        return redirect()->route('user.login');

        //$validityfaild=$request->mes;

        // $validityfaild = $request->validityfaild = $request->validityfaild ?? '';
        // return $request->wantsJson()
        //     ? new JsonResponse([], 204)
        //     : redirect('/')->with('fail', $validityfaild);

    }

    public function getUserIpAddr()
    {
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}