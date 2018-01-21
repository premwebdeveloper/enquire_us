<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyMail;
use App\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10|min:10',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $date = date('Y-m-d H:i:s');

        // Create User 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'verify_token' => Str::random(40)
        ]);

        // Create User role

        $user_id = $user->id;

        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => 2,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        //  Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id' => $user_id,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);

        return $user;
        exit;

    }


    # Verify Email First
    public function verifyEmailFirst()
    {
        return view('email.verifyEmailFirst');
    }

    # Send Email
    public function sendEmail($thisUser)
    {
        Mail::to($thisUser->email)->send(new verifyMail($thisUser));
    }

    # Send Email Done
    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where(['email'=>$email, 'verify_token'=>$verifyToken])->first();

        if($user)
        {
            User::where(['email'=>$email, 'verify_token'=>$verifyToken])->update(['verify_token'=>NULL]);

            $status = 'Verified email. Please wait for the approval.';
        }
        else
        {
            $status = 'Something Went Wrong Or Already Verified !';
        }

        if($status)
        {
            Session::flash('status', $status);
            return view('auth.login');
        }
    }
}
