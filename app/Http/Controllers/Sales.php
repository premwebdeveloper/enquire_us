<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class Sales extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('salesmiddleware');
    }

    // Support dashdoard
    public function dashboard()
    {
    	
    	return view('dashboard.sales_dashboard');
    }

    // client meetings view page
    public function meetings(){

        $currentuserid = Auth::user()->id;

        // Get all meetings of this sales person
        //$meetings = DB::table('client_meetings')->where('user_id', $currentuserid)->get();
        $users= DB::table('user_details')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where('created_by', $currentuserid)
                ->select('user_details.*', 'user_location.business_name')
                ->get();

        return view('meetings.index', array('users' => $users));
    }

    // Create meeting page view
    public function createMeetingview(){

        $currentuserid = Auth::user()->id;

        // Get all categories
        $categories = DB::table('category')->where('status', 1)->get();

        return view('meetings.addUser_basic_information', array('categories' => $categories));
    }  

    // Meeting schedules / meeting assigned to sales by support sales person will see there schedules
    public function meeting_schedules(){

        $currentuserid = Auth::user()->id;

        // Get meeting schedules assiged to me
        $schedules =    DB::table('client_assigned_to_sales as cats')
                        ->join('user_location as ul', 'ul.user_id', '=', 'cats.user_id')
                        ->join('employees as emps', 'emps.user_id', '=', 'cats.assigned_by')
                        ->join('employees as emp', 'emp.user_id', '=', 'cats.assigned_to')
                        ->where(['cats.assigned_to' => $currentuserid, 'cats.status' => 1])
                        ->select('cats.*', 'ul.business_name', 'emps.name as assigned_by_name', 'emps.phone as assigned_by_phone', 'emp.name as assigned_to_name', 'emp.phone as assigned_to_phone')
                        ->get();

        // Update notification status is  0
        $update = DB::table('client_assigned_to_sales')->where(['assigned_to' => $currentuserid, 'notification_status' => 1])->update([

            'notification_status' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return view('meetings.meetingSchedules', array('schedules' => $schedules));
    }

    // client response view
    public function client_response(Request $request){

        $meeting_id = $request->meeting_id;

        $currentuserid = Auth::user()->id;
        
        # Get User role
        $user = DB::table('user_roles')->where('user_id', $currentuserid)->first();

        # User Role id
        $role_id = $user->role_id;

        // Get old meeting response
        $responses = DB::table('client_meeting_response as cmr')
                    ->join('employees as emp', 'emp.user_id', '=', 'cmr.sales_uid')
                    ->select('emp.name','cmr.*')
                    ->where('cmr.cats_id', $meeting_id)->get();

        return view('meetings.clientMeetingResponse', array('role_id' => $role_id, 'meeting_id' => $meeting_id, 'responses' => $responses));
    }

    // client meeting response submitted by sales executive
    public function client_meeting_response(Request $request){

        $currentuserid = Auth::user()->id;
        $meeting_id = $request->meeting_id;
        $possibility = $request->possibility;
        $date_time = $request->date_time;
        $remark = $request->remark;
        $date = date('Y-m-d H:i:s');

        // Submit client response for this meeting
        $submit = DB::table('client_meeting_response')->insert([

            'sales_uid' => $currentuserid,
            'cats_id' => $meeting_id,
            'possibility' => $possibility,
            'follow_up_date' => $date_time,
            'remark' => $remark,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if($submit)
        {
            $status = 'Response for this meeting submitted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect()->route('client_response', ['meeting_id' => $meeting_id])->with('status', $status);
    }
}
