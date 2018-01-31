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

        # Get User details
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        return view('admin_users.view', array('user' => $user));
    }

    // Disable user
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


        $update = DB::table('user_details')->where('user_id', $user_id)->update(
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
