<?php

namespace App\Http\Controllers\Auth;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    protected function sendLoginResponse(Request $request)
        {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            # Get user id
            $currentuserid = Auth::user()->id;

            # Get User role
            $user = DB::table('user_roles')->where('user_id', $currentuserid)->first();

            # User Role id
            $role_id = $user->role_id;

            // if user role is admin
            if($role_id == 1):

                return redirect(route('dashboard'));

            // if user role is support
            elseif($role_id == 3):

                return redirect(route('support'));

            // if user role is sales
            elseif($role_id == 6):

                return redirect(route('sales'));

            // if user role is client / user
            else:

                return redirect(route('profile'));

            endif;

            /*return $this->authenticated($request, $this->guard()->user())
                    ?: redirect()->intended($this->redirectPath());*/
        }

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom function to redirect after login failed
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect('/login')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => [trans('auth.failed')]
            ]);
    }
}
