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
        $category = DB::table('category')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.category', '=', 'category.id')
                    ->where('category.status', 1)
                    ->where('websites_page_head_titles.subcategory', null)
                    ->where('websites_page_head_titles.area', null)
                    ->select('category.*', 'websites_page_head_titles.page_url')
                    ->get();

        // Get home page client details
        $home_page_clients = DB::table('user_details')
            ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_details.update_status' => 1))
            ->take(20)
            ->select('user_details.*', 'websites_page_head_titles.page_url', 'user_location.business_name')
            ->get();

        // Get latest listed home page client details
        $latest_home_page_clients = DB::table('user_details')
            ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_details.update_status' => 1))
            ->orderBy('user_location.id', 'desc')
            ->take(5)
            ->select('user_details.*', 'websites_page_head_titles.page_url', 'user_location.business_name')
            ->get();

        // home page slider
        $sliders = DB::table('slider')->get();

        // get all super category
        $super_catgory = DB::table('super_categories')->get();

        $title = 'Enquire us |Best local search engine in Jaipur Rajasthan India';
        $meta_description = 'Get a Best Quote on your Enquiry.We are Providing best solution on your any Needs';
        $meta_keywords = 'Local Search engine, Lead generation, Search Solution';

        return view('welcome', array('super_catgory' => $super_catgory, 'category' => $category, 'sliders' => $sliders, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'home_page_clients' => $home_page_clients, 'latest_home_page_clients' => $latest_home_page_clients));
    }

    // Filter data according to location and any keyword
    public function filter(Request $request)
    {
        $location = $request->location;
        $page_url = $request->page_url;
        $encoded = $request->encoded;

        // decode encoded parameter
        $encoded = base64_decode(urldecode($encoded));

        // get page title for this page
        $page_titles = DB::table('websites_page_head_titles')->where(array('status' => 1, 'page_url' => $page_url))->first();

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
        if(count($encoded) < 4){
            
            // Something went wrong
            return redirect('/');
        }
        elseif(count($encoded) == 4){ 

            // If click on category name from category list
            $title_id = $encoded[1];
            $title_status = $encoded[2];
            $city = $encoded[3];

            // Here check the title status if title status is category then
            if($title_status == 1){

                // Get all subcategories
                $subcategories = DB::table('subcategory')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.subcategory', '=', 'subcategory.id')
                    ->where('subcategory.status', 1)
                    ->where('websites_page_head_titles.category', $title_id)
                    ->where('websites_page_head_titles.area', null)
                    ->select('subcategory.*', 'websites_page_head_titles.page_url')
                    ->get();

                $query = DB::table('user_keywords')
                    ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                    ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                    ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                    ->join('keyword_city_client_visibility', 'keyword_city_client_visibility.user_id', '=', 'user_details.user_id')
                    ->where('user_keywords.keyword_identity', 1)
                    ->where('user_keywords.update_status', 1)
                    ->where('user_location.status', 1)
                    ->where('user_details.status', 1)
                    ->where('keyword_city_client_visibility.status', 1)
                    ->where('keyword_city_client_visibility.keyword', $title_id)
                    ->where('keyword_city_client_visibility.keyword_identity', 1);

                $query->where('category.id', $title_id);

                $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                $clients = $query->get();

                // get this category content
                $title_info = DB::table('category')->where('id', $title_id)->first();

            }else{

                // get sub category name only to show on page
                $title_info = DB::table('subcategory')->where('id', $title_id)->select('subcategory')->first();

                // First get category id of this sub category
                $this_category = DB::table('subcategory')->where('id', $title_id)->first();

                // Get all subcategories
                $subcategories = DB::table('subcategory')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.subcategory', '=', 'subcategory.id')
                    ->where('subcategory.status', 1)
                    ->where('websites_page_head_titles.category', $this_category->cat_id)
                    ->where('websites_page_head_titles.area', null)
                    ->select('subcategory.*', 'websites_page_head_titles.page_url')
                    ->get();

                // If the title status is sub category then
                $query = DB::table('user_keywords')
                    ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                    ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                    ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                    ->join('keyword_city_client_visibility', 'keyword_city_client_visibility.user_id', '=', 'user_details.user_id')
                    ->where('user_keywords.keyword_identity', 2)
                    ->where('user_location.status', 1)
                    ->where('user_details.status', 1)
                    ->where('user_keywords.update_status', 1)
                    ->where('keyword_city_client_visibility.status', 1)
                    ->where('keyword_city_client_visibility.keyword', $title_id)
                    ->where('keyword_city_client_visibility.keyword_identity', 2);

                    $query->where('subcategory.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                     $clients = $query->get();
            }
                        
            return view('frontend.clients', array('clients' => $clients, 'subcategories' => $subcategories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'title_info' => $title_info));
        }
        else{

            // If search from the top of the website
            $title_id = $encoded[1];
            $title_status = $encoded[2];
            $city = $encoded[3];
            $area = $encoded[4];

            if($title_status == 1) {        // If title is category

                // get this category content
                $title_info = DB::table('category')->where('id', $title_id)->first();

                // Get all subcategories
                $subcategories = DB::table('subcategory')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.subcategory', '=', 'subcategory.id')
                    ->where('subcategory.status', 1)
                    ->where('websites_page_head_titles.category', $title_id)
                    ->where('websites_page_head_titles.area', null)
                    ->select('subcategory.*', 'websites_page_head_titles.page_url')
                    ->get();

                // if searching being on city
                if(empty($area)){

                    $query = DB::table('user_keywords')
                        ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('keyword_city_client_visibility', 'keyword_city_client_visibility.user_id', '=', 'user_details.user_id')
                        ->where('user_keywords.keyword_identity', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_location.status', 1)
                        ->where('user_details.status', 1)
                        ->where('keyword_city_client_visibility.status', 1)
                        ->where('keyword_city_client_visibility.keyword', $title_id)
                        ->where('keyword_city_client_visibility.keyword_identity', 1);

                        $query->where('category.id', $title_id);

                        $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                        $clients = $query->get();
                }
                else
                {
                    $query = DB::table('user_keywords')
                        ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->where('user_keywords.keyword_identity', 1)
                        ->where('user_location.status', 1)
                        ->where('user_location.area', $area)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1);

                    $query->where('category.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                    $clients = $query->get();
                   
                    // get clients on selected area with this keyword assigned by admin from table 'user_area_visibility'
                    $queryA = DB::table('user_keywords')
                        ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('user_area_visibility', 'user_area_visibility.user_id', '=', 'user_details.user_id')
                        ->where('user_keywords.keyword_identity', 1)
                        ->where('user_location.status', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1)
                        ->where('user_area_visibility.keyword_id', $title_id)
                        ->where('user_area_visibility.keyword_identity', 1)
                        ->where('user_area_visibility.area', $area)
                        ->where('user_area_visibility.status', 1);

                    $queryA->where('category.id', $title_id);

                    $queryA->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                    $clientsA = $queryA->get();

                    $index = count($clients);

                    // merge both searched clients array  
                    foreach ($clientsA as $keyA => $cA) {
                        $clients{$index} = $cA;
                        $index++;
                    }
                }        

                return view('frontend.clients', array('clients' => $clients, 'subcategories' => $subcategories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'title_info' => $title_info));
            }
            elseif ($title_status == 2) {   // If title is sub category

                // get sub category name only to show on page
                $title_info = DB::table('subcategory')->where('id', $title_id)->select('subcategory')->first();

                // Get all subcategories
                $subcategories = DB::table('subcategory')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.subcategory', '=', 'subcategory.id')
                    ->where('subcategory.status', 1)
                    ->where('websites_page_head_titles.category', $title_id)
                    ->where('websites_page_head_titles.area', null)
                    ->select('subcategory.*', 'websites_page_head_titles.page_url')
                    ->get();

                if(empty($area)){

                    $query = DB::table('user_keywords')
                        ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('keyword_city_client_visibility', 'keyword_city_client_visibility.user_id', '=', 'user_details.user_id')
                        ->where('user_keywords.keyword_identity', 2)
                        ->where('user_location.status', 1)
                        ->where('user_details.status', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('keyword_city_client_visibility.status', 1)
                        ->where('keyword_city_client_visibility.keyword', $title_id)
                        ->where('keyword_city_client_visibility.keyword_identity', 2);

                    $query->where('subcategory.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                    $clients = $query->get();

                }else{

                    $query = DB::table('user_keywords')
                        ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->where('user_keywords.keyword_identity', 2)
                        ->where('user_location.status', 1)
                        ->where('user_location.area', $area)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1);

                    $query->where('subcategory.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                    $clients = $query->get();
                           
                    // get clients on selected area with this keyword assigned by admin from table 'user_area_visibility'
                    $queryA = DB::table('user_keywords')
                        ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('user_area_visibility', 'user_area_visibility.user_id', '=', 'user_details.user_id')
                        ->where('user_keywords.keyword_identity', 2)
                        ->where('user_location.status', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1)
                        ->where('user_area_visibility.keyword_id', $title_id)
                        ->where('user_area_visibility.keyword_identity', 2)
                        ->where('user_area_visibility.area', $area)
                        ->where('user_area_visibility.status', 1);

                    $queryA->where('subcategory.id', $title_id);

                    $queryA->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url');

                    $clientsA = $queryA->get();

                    $index = count($clients);

                    // merge both searched clients array  
                    foreach ($clientsA as $keyA => $cA) {
                        $clients{$index} = $cA;
                        $index++;
                    }
                }                

                return view('frontend.clients', array('clients' => $clients, 'subcategories' => $subcategories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'title_info' => $title_info));
            }
            else {                          // If title is company

                // Get client all details
                $client = DB::table('user_details')
                    ->join('user_company_information', 'user_company_information.user_id', '=', 'user_details.user_id')
                    ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                    ->join('areas', 'areas.id', '=', 'user_location.area')
                    ->join('cities', 'cities.id', '=', 'user_location.city')
                    ->where(array('user_details.user_id' => $title_id, 'user_details.status' => 1))
                    ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'user_company_information.payment_mode', 'user_company_information.year_establishment', 'user_company_information.annual_turnover', 'user_company_information.no_of_emps', 'user_company_information.professional_associations', 'user_company_information.certifications', 'areas.area as area_name', 'cities.name as city_name')
                    ->first();
                        // Get Client Keywords
                $client_keywords =  DB::table('user_keywords')
                    ->where(['user_keywords.user_id' => $title_id, 'user_keywords.status' => 1, 'user_keywords.update_status' => 1])
                    ->leftjoin("category", function($join) use($title_id) {
                    $join->on("category.id", "=", "user_keywords.keyword_id")
                        ->where("user_keywords.keyword_identity", "1");
                })
                ->leftjoin("subcategory",function($sjoin) use($title_id) {
                    $sjoin->on("subcategory.id", "=", "user_keywords.keyword_id")
                        ->where("user_keywords.keyword_identity", "2");
                })->select('user_keywords.*', 'category.category', 'subcategory.subcategory')->get();

                // Get client other information
                $other_info = DB::table('user_other_information')->where('user_id', $title_id)->get();

                // Get client images
                $images = DB::table('user_images')->where('user_id', $title_id)->get();

                return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'client_keywords' => $client_keywords));
            }
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
        $cat_id = Crypt::decrypt($request->id);

        $category = str_replace("-", " ", $category);

        // get all categories to show
        $categories = DB::table('category')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.category', '=', 'category.id')
                    ->where('category.status', 1)
                    ->where('websites_page_head_titles.subcategory', null)
                    ->where('websites_page_head_titles.area', null)
                    ->select('category.*', 'websites_page_head_titles.page_url')
                    ->get();

        // Get this keyword / category'sclient and their details
        $clients = DB::table('user_keywords')
            ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
            ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
            ->where(array('user_keywords.keyword_identity' => 1, 'category.id' => $cat_id, 'user_details.status' => 1, 'user_location.status' => 1))
            ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url')
            ->get();

        return view('frontend.clients', array('clients' => $clients, 'categories' => $categories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
    }

    public function view(Request $request)
    {
        $business_url = $request->business_url;
        $id = $request->id;
        $user_id = Crypt::decrypt($id);

        // Get client page titles
        $page_titles = DB::table('websites_page_head_titles')->where(['business_page' => $user_id, 'status' => 1])->first();

        if(!empty($page_titles))
        {
            $title = $page_titles->title;
            $meta_description = $page_titles->keyword;
            $meta_keywords = $page_titles->description;
        }
        else
        {
            $title = '';
            $meta_description = '';
            $meta_keywords = '';
        }

        // Get client all details
        $client = DB::table('user_details')
            ->join('user_company_information', 'user_company_information.user_id', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->join('areas', 'areas.id', '=', 'user_location.area')
            ->join('cities', 'cities.id', '=', 'user_location.city')
            ->where(array('user_details.user_id' => $user_id))
            ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'user_company_information.payment_mode', 'user_company_information.year_establishment', 'user_company_information.annual_turnover', 'user_company_information.no_of_emps', 'user_company_information.professional_associations', 'user_company_information.certifications', 'areas.area as area_name', 'cities.name as city_name')
            ->first();

        // Get Client Keywords
        $client_keywords =  DB::table('user_keywords')->where(['user_keywords.user_id' => $user_id, 'user_keywords.status' => 1, 'user_keywords.update_status' => 1])
                ->leftjoin("category", function($join) use($user_id) {
                    $join->on("category.id", "=", "user_keywords.keyword_id")
                         ->where("user_keywords.keyword_identity", "1");
                })
                ->leftjoin("subcategory",function($sjoin) use($user_id) {
                    $sjoin->on("subcategory.id", "=", "user_keywords.keyword_id")
                          ->where("user_keywords.keyword_identity", "2");
                })
                ->select('user_keywords.*', 'category.category', 'subcategory.subcategory')
            //dd($client_keywords->tosql());
              
                ->get();
    
        // Get client other information
        $other_info = DB::table('user_other_information')->where('user_id', $user_id)->get();

        // Get client images
        $images = DB::table('user_images')->where('user_id', $user_id)->get();

        return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'client_keywords' => $client_keywords));

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

    // show all categories on click super category
    public function categories(Request $request){

        $super_cat_id = $request->super_cat_id;
        
        // Get all categories according to this super category
        $categories = DB::table('category')->where(['super_category' =>$super_cat_id, 'status' => 1])->get();

        // get all super categories
        $super_catgories = DB::table('super_categories')->get();

        return view('frontend.categories', array('categories' => $categories, 'super_catgories' => $super_catgories));
    }
}
