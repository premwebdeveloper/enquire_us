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
}
