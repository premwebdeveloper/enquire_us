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
        $users = DB::table('user_details')->where('status', 1)->get();

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
    public function delete(Request $request)
    {
        $user_id = $request->user_id;

        $user = User::where(['id'=>$user_id])->update(['status'=>'0']);

        if($user)
        {
            $disable = DB::table('user_details')->where('user_id', $user_id)->update(
                array(
                        'status' => 0
                )
            );
        }

        if($disable)
        {
            $status = 'User Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }
}
