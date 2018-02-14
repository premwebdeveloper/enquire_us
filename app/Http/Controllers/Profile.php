<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
use Session;
class Profile extends Controller
{
    // Authenticate users
    public function __construct()
    {
        $this->middleware('auth');
    }

    // User Profile View
    public function profile()
    {
    	$currentuserid = Auth::user()->id;

        // Get user location details
        $location = DB::table('user_location')->where('user_id', $currentuserid)->first();

        // Get user contact details
        $contact = DB::table('user_details')->where('user_id', $currentuserid)->first();

        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        // Get user other information
        $company = DB::table('user_company_information')->where('user_id', $currentuserid)->first();

        // Get countries
        $cities = DB::table('cities')->where('state_id', 33)->get();

        return view('profile.profile', array('location' => $location, 'contact' => $contact, 'other' => $other, 'company' => $company, 'cities' => $cities));
    }
}
