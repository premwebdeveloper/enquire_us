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

        $user_id = $user->id;

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => 2,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
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

        // Create User Location
        $user_details = DB::table('user_location')->insert(
            array(
                'user_id' => $user_id,
                'business_name' => $data['company_name'],
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Other Information
        for($i = 0; $i <= 13; $i++)
        {
            $operation_timing = 1;
            if($i > 6) { $operation_timing = 2; }

            if($i == 0 || $i == 7){ $day = 'monday'; }
            if($i == 1 || $i == 8){ $day = 'tuesday'; }
            if($i == 2 || $i == 9){ $day = 'wednesday'; }
            if($i == 3 || $i == 10){ $day = 'thursday'; }
            if($i == 4 || $i == 11){ $day = 'friday'; }
            if($i == 5 || $i == 12){ $day = 'saturday'; }
            if($i == 6 || $i == 13){ $day = 'sunday'; }

            $user_details = DB::table('user_other_information')->insert(
                array(
                    'user_id' => $user_id,
                    'operation_timing' => $operation_timing,
                    'day' => $day,
                    'from_time' => '10:00:00',
                    'to_time' => '19:00:00',
                    'working_status' => '1',
                    'created_at' => $date,
                    'updated_at' => $date
                )
            );
        }

        // Create User Company Information
        $user_details = DB::table('user_company_information')->insert(
            array(
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Images
        /*$user_details = DB::table('user_images')->insert(
            array(
                'user_id' => $user_id,
                'image' => 'user.png',
                'created_at' => $date,
                'updated_at' => $date
            )
        );*/

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
            User::where(['email'=>$email, 'verify_token'=>$verifyToken])->update(['verify_token'=>NULL, 'status' => '1']);

            DB::table('user_details')->where(['email'=>$email])->update(['status'=>'2']);

            $this->guard()->login($user);

            $status = 'Verified email. Please update your profile now';

            return redirect('profile')->with('status', $status);

        }

    }
}
