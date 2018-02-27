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

        // Get selected keywords
        $where = array('user_id' => $currentuserid, 'status' => 1);

        $keywords = DB::table('user_keywords')->where($where)->get();

        $saved_keywords = '';

        foreach ($keywords as $key => $words)
        {
            if($words->keyword_identity == 1)
            {
                $category = DB::table('category')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$category->id.'_1">'.$category->category.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" id="delete_'.$category->id.'_1"></i></div>';
            }
            else
            {
                $subcategory = DB::table('subcategory')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$subcategory->id.'_2">'.$subcategory->subcategory.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" id="delete_'.$subcategory->id.'_2"></i></div>';
            }
        }

        return view('profile.profile', array('location' => $location, 'contact' => $contact, 'other' => $other, 'company' => $company, 'cities' => $cities, 'keywords' => $saved_keywords));
    }
}
