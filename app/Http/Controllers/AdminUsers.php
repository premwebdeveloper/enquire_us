<?php

namespace App\Http\Controllers;
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

        // echo '<pre>';
        // print_r($user_other_information);
        // exit;
        // For print query
        //echo $query->toSql();
        //exit;

        return view('admin_users.view', array('user_details' => $user_details, 'other_information' => $user_other_information));
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
