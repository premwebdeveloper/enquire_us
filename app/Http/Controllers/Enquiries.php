<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use Auth;

class Enquiries extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Get and show all enquiries generated by users for clients
    public function enquiries()
    {
    	# Get enquiries
    	$enquiries= DB::table('client_enquiries')
    				->join('user_location', 'user_location.user_id', '=', 'client_enquiries.client_uid')
    				->join('user_details', 'user_details.user_id', '=', 'client_enquiries.client_uid')
    				->where('client_enquiries.status', 1)
    				->select('client_enquiries.*', 'user_location.business_name', 'user_details.name as client_name', 'user_details.email as client_email')
    				->get();

    	return view('enquiry.index', array('enquiries' => $enquiries));
    }

    // Show all reviews to admin given by users
    public function reviews(){

        # Get enquiries
        $reviews= DB::table('client_reviews')
                    ->join('user_location', 'user_location.user_id', '=', 'client_reviews.client_uid')
                    ->join('user_details', 'user_details.user_id', '=', 'client_reviews.client_uid')
                    ->where('client_reviews.status', 1)
                    ->select('client_reviews.*', 'user_location.business_name', 'user_details.name as client_name', 'user_details.email as client_email')
                    ->get();

        return view('enquiry.reviews', array('reviews' => $reviews));
    }

    // Admin can delete any user's review
    public function review_remove(Request $request){

        $review_id = $request->id;

        $delete = DB::table('client_reviews')->where('id', $review_id)->delete();

        // If review deleted successfully
        if($delete){
            $status = 'User review deleted successfully.';
        }else{
            $status = 'Something went wrong !.';            
        }
        return redirect()->route('reviews')->with('status', $status);
    }
}
