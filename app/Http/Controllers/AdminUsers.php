<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddUserValidation;
use App\User;
use Illuminate\Http\Request;
use DB;

class AdminUsers extends Controller
{
    // View All User
    public function index()
    {
        # Get All Users
        $users = DB::table('user_details')->where('status','!=', 0)->get();

        return view('admin_users.index', array('users' => $users));
    }

    // add new User view page
    public function addUser()
    {
        //$mother_tongue = DB::table('mother_tongue')->where('status', 1)->get();

        return view('admin_users.addUser');
    }

    // add new User
    public function add_user(AddUserValidation $request)
    {

        $date = date('Y-m-d H:i:s');

        $company_name = $request->company_name;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        $password = bcrypt($password);

        // Create User
        $user = DB::table('users')->insert(
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $user_id = DB::getPdo()->lastInsertId();

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
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        // Create User Location
        $user_details = DB::table('user_location')->insert(
            array(
                'user_id' => $user_id,
                'business_name' => $company_name,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
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
                    'working_status' => '0',
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 1
                )
            );
        }

        // Create User Company Information
        $user_details = DB::table('user_company_information')->insert(
            array(
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        if($user_details)
        {
            $status = 'Add User successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }
    // View User Detail
    public function View(Request $request)
    {
        $user_id = $request->user_id;

        // Get basic / location / company information
        $query = DB::table('user_details as ud')
            ->join('user_location as ul', 'ud.user_id', '=', 'ul.user_id')
            ->join('user_company_information as uci', 'ud.user_id', '=', 'uci.user_id')
            ->select('ud.*', 'ul.business_name', 'ul.building', 'ul.street', 'ul.landmark', 'ul.area', 'ul.city', 'ul.pincode', 'ul.state', 'ul.country', 'uci.payment_mode', 'uci.payment_mode', 'uci.year_establishment', 'uci.annual_turnover', 'uci.no_of_emps', 'uci.professional_associations', 'uci.certifications')
            ->where('ud.user_id', '=', $user_id);

        $user_details = $query->first();

        # Get Other information
        $user_other_information = DB::table('user_other_information')->where('user_id', $user_id)->get();

        # Get Images
        $images = DB::table('user_images')->where('user_id', $user_id)->get();

        // echo '<pre>';
        // print_r($user_other_information);
        // exit;
        // For print query
        //echo $query->toSql();
        //exit;

        return view('admin_users.view', array('user_details' => $user_details, 'other_information' => $user_other_information, 'images' => $images));
    }

    // Active / Inactive user
    public function active_inactive(Request $request)
    {
        $user_id = $request->user_id;

        $status = $request->status;

        if($status == 1)
        {
        	$status = 2;
        }
        else
        {
        	$status = 1;
        }

        // update user details
        $update = DB::table('user_details')->where('user_id', $user_id)->update(
            array(
                    'status' => $status
            )
        );

        // update user location
        $update_location = DB::table('user_location')->where('user_id', $user_id)->update(
            array(
                    'status' => $status
            )
        );

        if($update)
        {
            $status = 'User successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }
}
