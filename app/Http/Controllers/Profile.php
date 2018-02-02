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

        $location = DB::table('user_location')->where('user_id', $currentuserid)->first();
    	
        $contact = DB::table('user_details')->where('user_id', $currentuserid)->first();

    	return view('profile.profile', array('location' => $location, 'contact' => $contact));
    }
}
