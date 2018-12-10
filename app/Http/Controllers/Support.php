<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Mail;
use App\Mail\SendEMail;

class Support extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('supportmiddleware');
    }

    // Support dashdoard
    public function dashboard()
    {
    	
    	return view('dashboard.support_dashboard');
    }

    // client meetings view page
    public function clientMeetings(){

        $currentuserid = Auth::user()->id;

        // Get all meetings of this sales person
        //$meetings = DB::table('client_meetings')->where('user_id', $currentuserid)->get();
        $users = DB::table('user_details')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->leftjoin('client_assigned_to_sales', 'client_assigned_to_sales.user_id', '=', 'user_details.user_id')
                ->where('created_by', $currentuserid)
                ->select('user_details.*', 'user_location.business_name', 'client_assigned_to_sales.assigned_by', 'client_assigned_to_sales.assigned_to', 'client_assigned_to_sales.assign_date_time', 'client_assigned_to_sales.id as cas_id')
                ->get();

        return view('meetings.clientMeetings', array('users' => $users));
    }

    // Create meeting page view
    public function createMeetingview(){

        $currentuserid = Auth::user()->id;

        // Get all categories
        $categories = DB::table('category')->where('status', 1)->get();

        return view('meetings.addUser_basic_information', array('categories' => $categories));
    }

    // Client assign to sales executive
    public function client_assign_to_sales(Request $request){

        $currentuserid = Auth::user()->id;
        $date = date('Y-m-d H:i:s');
        $date_time = $request->date_time;
        $sales_person = $request->sales_person;
        $meeting_client_uid = $request->meeting_client_uid;

        $temp = explode('_', $meeting_client_uid);
        $client_uid = $temp[1];

        // First check if this user assigned to any sales executive already or not
        $already = DB::table('client_assigned_to_sales')->where(['user_id' => $client_uid, 'assigned_by' => $currentuserid, 'status' => 1])->first();

        // If client not assigned already
        if(!empty($already)){

            // Assign client to sales person by support person
            $assign = DB::table('client_assigned_to_sales')->where(['user_id' => $client_uid, 'assigned_by' => $currentuserid, 'status' => 1])->update([
                'assigned_to' => $sales_person,
                'assign_date_time' => $date_time.':00',
                'updated_at' => $date,
            ]);
        }else{
            
            // Client assigned to sales first time
            // Assign client to sales person by support person
            $assign = DB::table('client_assigned_to_sales')->insert([

                'user_id' => $client_uid,
                'assigned_by' => $currentuserid,
                'assigned_to' => $sales_person,
                'assign_date_time' => $date_time.':00',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        if($assign)
        {
            // Get sales person information who is assigned meeting by support
            $sales_info = DB::table('users')->where('id', $sales_person)->first();

            // Get support information who is assigning meeting to sales
            //$sales_info = DB::table('users')->where('id', $sales_person)->first();

            // Send email to sales executive thet meeting assigned to him with client
            Mail::to($sales_info->email)->send(new SendEmail(Auth::user()));
            
            $status = 'Client assigned to sales executive.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect()->route('clientMeetings');
    }

    // Assigned meeting view
    public function assigned_meetings(Request $request){

        // client assigned to sales table id
        $id = $request->id;

        // Get all information of this meeting
        $meeting_information =  DB::table('client_assigned_to_sales as cats')
                                ->join('user_location as ul', 'ul.user_id', '=', 'cats.user_id')
                                ->join('employees as emps', 'emps.user_id', '=', 'cats.assigned_by')
                                ->join('employees as emp', 'emp.user_id', '=', 'cats.assigned_to')
                                ->where(['cats.id' => $id, 'cats.status' => 1])
                                ->select('cats.*', 'ul.business_name', 'emps.name as assigned_by_name', 'emps.phone as assigned_by_phone', 'emp.name as assigned_to_name', 'emp.phone as assigned_to_phone')
                                ->first();

        return view('meetings.clientMeetingView', array('meeting_information' => $meeting_information));
    }

    // client meeting response view submitted by sales person
    public function client_meeting_response_view(Request $request){

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

        // update notification status for this meeting
        $update = DB::table('client_meeting_response')->where(['cats_id' => $meeting_id, 'notification_status' => 1])->update([

            'notification_status' => 0, 
        ]);

        return view('meetings.clientMeetingResponse', array('role_id' => $role_id, 'meeting_id' => $meeting_id, 'responses' => $responses));
    }
}
