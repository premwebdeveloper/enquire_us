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
use Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category = DB::table('category')->where('status', 1)->get();

        $sliders = DB::table('slider')->get();

        $title = 'Home';
        $meta_description = 'Home keywords';
        $meta_keywords = 'Home keywords';

        return view('welcome', array('category' => $category, 'sliders' => $sliders, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
    }

    // Filter data according to location and any keyword
    public function filter(Request $request)
    {
        $location = $request->location;
        $cat = $request->cat;
        $encoded = $request->encoded;

        // decode encoded parameter
        $encoded = base64_decode(urldecode($encoded));

        // get page title for this page
        $page_titles = DB::table('websites_page_head_titles')->where(array('status' => 1, 'page_url' => $cat))->first();

        if(!empty($page_titles))
        {
            $title = $page_titles->title;
            $meta_keywords = $page_titles->keyword;
            $meta_description = $page_titles->description;
        }
        else
        {
            $title = '';
            $meta_keywords = '';
            $meta_description = '';
        }

        $encoded = explode('-', $encoded);

        # If there is something wrong with url and array is not proper then redirect to home
        if(count($encoded) < 3)
        {
            return redirect('/');
        }

        $title_id = $encoded[1];
        $title_status = $encoded[2];

        if($title_status == 1) {        // If title is category

            $categories = DB::table('category')->where('status', 1)->get();

            $query = DB::table('user_keywords')
                ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where('user_keywords.keyword_identity', 1);

                $query->where('category.id', $title_id);

                $temp = explode('-in-', $cat);

                if(count($temp) > 1)
                {
                    $selected_area = $temp[1];

                    $selected_area = str_replace("-", " ", $selected_area);

                    if(!empty($selected_area))
                    {
                       $query->where('user_location.area', $selected_area);
                    }
                }

                $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country');

                $clients = $query->get();

            return view('frontend.clients', array('clients' => $clients, 'categories' => $categories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
        }
        elseif ($title_status == 2) {   // If title is sub category

            $categories = DB::table('category')->where('status', 1)->get();

            $query = DB::table('user_keywords')
                ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where('user_keywords.keyword_identity', 2);

                $query->where('subcategory.id', $title_id);

                $temp = explode('-in-', $cat);

                if(count($temp) > 1)
                {
                    $selected_area = $temp[1];

                    $selected_area = str_replace("-", " ", $selected_area);

                    if(!empty($selected_area))
                    {
                       $query->where('user_location.area', $selected_area);
                    }
                }

                $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country');

                 $clients = $query->get();

            return view('frontend.clients', array('clients' => $clients, 'categories' => $categories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
        }
        else {                          // If title is company

            // Get client all details
            $client = DB::table('user_details')
                ->join('user_company_information', 'user_company_information.user_id', '=', 'user_details.user_id')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where(array('user_details.user_id' => $title_id))
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'user_company_information.payment_mode', 'user_company_information.year_establishment', 'user_company_information.annual_turnover', 'user_company_information.no_of_emps', 'user_company_information.professional_associations', 'user_company_information.certifications')
                ->first();

            // Get client other information
            $other_info = DB::table('user_other_information')->where('user_id', $title_id)->get();

            // Get client images
            $images = DB::table('user_images')->where('user_id', $title_id)->get();

            $actual_area = $client->area;
            $actual_area = str_replace(" ","-",$actual_area);

            $selected_company = explode('-in-', $cat);
            $selected_company_area = $selected_company[1];

            if($selected_company_area != $actual_area)
            {
                $client = array();
            }

            return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));

        }

        exit;
    }

    // Get all clients for perticular category
    public function category(Request $request)
    {
        $title = 'Categories';
        $meta_description = 'Category description';
        $meta_keywords = 'Category keywords';

        $category = $request->category;



        $category = str_replace("-", " ", $category);

        $categories = DB::table('category')->where('status', 1)->get();

        $clients = DB::table('user_keywords')
            ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
            ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_keywords.keyword_identity' => 1, 'category.category' => $category))
            ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country')
            //->groupBy('user_id')
            ->get();

        return view('frontend.clients', array('clients' => $clients, 'categories' => $categories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
    }

    public function view(Request $request)
    {
        $title = 'Category View';
        $meta_description = 'Category View description';
        $meta_keywords = 'Category View keywords';

        $businesswitharea = $request->businesswitharea;

        $business = $request->business;

        $business = Crypt::decrypt($business);

        //dd($business);

        $id = $request->id;
        $user_id = Crypt::decrypt($id);

        // Get client all details
        $client = DB::table('user_details')
            ->join('user_company_information', 'user_company_information.user_id', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_details.user_id' => $user_id))
            ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'user_company_information.payment_mode', 'user_company_information.year_establishment', 'user_company_information.annual_turnover', 'user_company_information.no_of_emps', 'user_company_information.professional_associations', 'user_company_information.certifications')
            ->first();

        // Get client other information
        $other_info = DB::table('user_other_information')->where('user_id', $user_id)->get();

        // Get client images
        $images = DB::table('user_images')->where('user_id', $user_id)->get();

        return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));

        exit;
    }

    # Get dynamic Website Pages and their content
    public function webpage(Request $request)
    {
        $title = 'Category View';
        $meta_description = 'Category View description';
        $meta_keywords = 'Category View keywords';

        $page = $request->webpage;

        $page = str_replace('-', ' ', $page);

        // Get client all details
        $webpages = DB::table('website_pages')->where(array('page_title' => $page, 'status' => 1))->first();

        $website_pages = DB::table('website_pages')->where('status', 1)->get();
        //dd($website_pages);

        return view('frontend.webpage_view', array('webpages' => $webpages, 'website_pages' => $website_pages, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));

    }

    # subscribers functions
    public function subscribers(Request $request)
    {
        $email = $request->sub_email;

        # insert email in subscribers table
        DB::table('subscribers')->insert(['email' => $email]);

        Session::flash('subscribe', 'You are active subscriber now.');

        return redirect('/');
    }
}
