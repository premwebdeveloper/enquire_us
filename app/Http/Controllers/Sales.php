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
        $meetings = DB::table('client_meetings')->where('user_id', $currentuserid)->get();

        return view('meetings.index', array('meetings' => $meetings));
    }

    // Create meeting page view
    public function createMeetingview(){

        $currentuserid = Auth::user()->id;

        // Get all categories
        $categories = DB::table('category')->where('status', 1)->get();

        return view('meetings.create', array('categories' => $categories));
    }

    // Create meeting
    public function create(Request $request){

        $currentuserid = Auth::user()->id;
            
        # Set validation for
        $this->validate($request, [
            'contact_person' => 'required',
            'company' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
        ]);

        $contact_person = $request->contact_person;
        $company = $request->company;
        $email = $request->email;
        $phone = $request->phone;
        $category = $request->category;
        $custom_category = $request->custom_category;
        $address = $request->address;
        $date = date('Y-m-d H:i:s');

        $meeting = DB::table('client_meetings')->insert([

            'user_id' => $currentuserid,
            'contact_person' => $contact_person,
            'company' => $company,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'category' => $category,
            'custom_category' => $custom_category,
            'user_location' => null,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if($meeting):
            $status = 'Meeting details submitted successfully.';
        else:
            $status = 'Something went wrong!'; 
        endif;
        return redirect('meetings')->with('status', $status);
    }

    // edit Meeting View
    public function editMeetingView(Request $request){

        $meetingID = $request->meetingID;
        
        // get meeting details
        $meeting = DB::table('client_meetings')->where('id', $meetingID)->first();

        // Get all categories
        $categories = DB::table('category')->where('status', 1)->get();

        return view('meetings.edit', array('meeting' => $meeting, 'categories' => $categories));
    }

    // Edit meeting 
    public function editMeeting(Request $request){

        $currentuserid = Auth::user()->id;
            
        # Set validation for
        $this->validate($request, [
            'contact_person' => 'required',
            'company' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
        ]);

        $meeting_id = $request->meeting_id;
        $contact_person = $request->contact_person;
        $company = $request->company;
        $email = $request->email;
        $phone = $request->phone;
        $category = $request->category;
        $custom_category = $request->custom_category;
        $address = $request->address;
        $date = date('Y-m-d H:i:s');

        $meeting = DB::table('client_meetings')->where('id', $meeting_id)->update([

            'contact_person' => $contact_person,
            'company' => $company,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'category' => $category,
            'custom_category' => $custom_category,
            'user_location' => null,
            'updated_at' => $date,
        ]);

        if($meeting):
            $status = 'Meeting details updated successfully.';
        else:
            $status = 'Something went wrong!'; 
        endif;
        return redirect('meetings')->with('status', $status);
    }

    // delete meeting
    public function deleteMeeting(Request $request){

        $meetingID = $request->meetingID;

        $delete = DB::table('client_meetings')->where('id', $meetingID)->delete();

        if($delete):

            $status = 'Meeting deleted successfully.';
        else:

            $status = 'Something went wrong!';
        endif;
        
        return redirect('meetings')->with('status', $status);
    }
}
