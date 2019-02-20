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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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
        $routeName = Route::currentRouteName();
        
        // get page title for this page
        $page_titles = DB::table('websites_page_head_titles')->where(array('status' => 1, 'page_url' => $routeName))->first();

        if(!empty($page_titles))
        {
            $title = $page_titles->title;
            $meta_keywords = $page_titles->keyword;
            $meta_description = $page_titles->description;
        }
        else
        {
            $title = 'Enquire us |Best local search engine in Jaipur Rajasthan India';
            $meta_keywords = 'Get a Best Quote on your Enquiry.We are Providing best solution on your any Needs';
            $meta_description = 'Local Search engine, Lead generation, Search Solution';
        }

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

        // First convert object in array then suffle and then conver array into object
        $home_page_clients = json_decode(json_encode($home_page_clients), True);
        shuffle($home_page_clients);
        $home_page_clients = (object)$home_page_clients;

        // Get latest listed home page client details
        $latest_home_page_clients = DB::table('user_details')
            ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_details.update_status' => 1, 'user_details.status' => 1))
            ->orderBy('user_location.id', 'desc')
            ->take(5)
            ->select('user_details.*', 'websites_page_head_titles.page_url', 'user_location.business_name')
            ->get();

        // home page slider
        $sliders = DB::table('slider')->get();

        // get all super category
        $super_catgory = DB::table('super_categories')->get();

        return view('welcome', array('super_catgory' => $super_catgory, 'category' => $category, 'sliders' => $sliders, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'home_page_clients' => $home_page_clients, 'latest_home_page_clients' => $latest_home_page_clients));
    }

    // Filter data according to location and any keyword
    public function filter(Request $request)
    {
        $location = $request->location;
        $page_url = $request->page_url;
        $encoded = $request->encoded;
        
        // seo href url items
        $seo_item_herf_url = $encoded;

        $encoded = base64_decode($encoded);
        
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
        if(count($encoded) < 3){
            
            // Something went wrong
            return redirect('/');
        }
        elseif(count($encoded) == 3){ 

            // If click on category name from category list
            $title_id = $encoded[0];
            $title_status = $encoded[1];
            $city = $encoded[2];
            $area = '';

            $city_info = DB::table('cities')->where('id', $city)->first();
            $city_info = json_decode(json_encode($city_info), True);

            // Here check the title status if title status is category then
            if($title_status == 1){

                // Get all page urls for this keyword on this city's all areas
                $pageUrls = DB::table('websites_page_head_titles')
                            ->where(['category' => $title_id, 'city' => $city, 'status' => 1])
                            ->whereNotNull('area')
                            ->whereNull('subcategory')
                            ->get();

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
                    ->join('cities', 'cities.id', '=', 'user_location.city')
                    ->where('user_keywords.keyword_identity', 1)
                    ->where('user_keywords.update_status', 1)
                    ->where('user_location.status', 1)
                    ->where('user_details.status', 1)
                    ->where('keyword_city_client_visibility.status', 1)
                    ->where('keyword_city_client_visibility.keyword', $title_id)
                    ->where('keyword_city_client_visibility.keyword_identity', 1);

                $query->where('category.id', $title_id);

                $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                $clients = $query->get();
                // get this category content
                $title_info = DB::table('category')->where('id', $title_id)->first();

            }else{

                // get sub category name only to show on page
                $title_info = DB::table('subcategory')->where('id', $title_id)->first();

                // First get category id of this sub category
                $this_category = DB::table('subcategory')->where('id', $title_id)->first();

                // Get all page urls for this keyword on this city's all areas
                $pageUrls = DB::table('websites_page_head_titles')
                            ->where(['category' => $this_category->cat_id, 'subcategory' => $title_id, 'city' => $city, 'status' => 1])
                            ->whereNotNull('area')
                            ->get();

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
                    ->join('cities', 'cities.id', '=', 'user_location.city')
                    ->where('user_keywords.keyword_identity', 2)
                    ->where('user_location.status', 1)
                    ->where('user_details.status', 1)
                    ->where('user_keywords.update_status', 1)
                    ->where('keyword_city_client_visibility.status', 1)
                    ->where('keyword_city_client_visibility.keyword', $title_id)
                    ->where('keyword_city_client_visibility.keyword_identity', 2);

                    $query->where('subcategory.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                $clients = $query->get();

            }
            $company_list_elements = array();
            foreach ($clients as $key => $client) {
                
                $company_list_elements[$key]['@type'] = 'ListItem';
                $company_list_elements[$key]['position'] = $key+1;
                $company_list_elements[$key]['url'] = "https://enquireus.com/".$client->city_name."/".$client->page_url."/".$client->encoded_params."";
            }

            $category_company_list_meta_content = array(

                "@context" => "http://schema.org",
                "@type" => "ItemList",
                "itemListElement" => $company_list_elements
            );

            $category_company_list_meta_content = json_encode($category_company_list_meta_content);

            // set breadcrumb on category list page code start here
            if($page_url){
                $seo_item_url = str_replace("-", " ", $page_url);
                $seo_item_url = ucwords($seo_item_url.' '. 'in jaipur');
            }
            $list_seo_title = '<ul>
                                <li class="first">
                                    <a id="brd_cm_city" title="Enquire Us" href="https://enquireus.com/'.$location.'">
                                        <span id="brd_cm_city_txt" class="lng_crcum">'.$location.'</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-title="'.$seo_item_url.'" id="brd_cm_srch" title="'.$seo_item_url.'" href="https://enquireus.com/'.$location.'/'.$page_url.'/'.$seo_item_herf_url.'">
                                        <span id="brd_cm_srch_txt" class="lng_crcum">'.$seo_item_url.'</span>
                                    </a>
                                </li>
                                <li class="lstEmt ">
                                    <a><span class="lng_crcum">10+ Listings</span></a>
                                </li>
                            </ul>';
            // set breadcrumb on category list page code ends here 

            // Create all companies content for meta //
            /* *************************************** */
            $social_links = array("https://twitter.com/enquire_us", "https://www.facebook.com/enquireusindia/", "https://www.instagram.com/enquire_us/", "https://www.linkedin.com/company/enquireus/");

            $all_companies_meta_data = array(
                array(
                    "@context" => "http://schema.org",
                    "@type" => "Organization",
                    "name" => "enquireus.com",
                    "url" => "https://www.enquireus.com/",
                    "logo" => "https://www.enquireus.com/resources/frontend_assets/images/logo.png",
                    "sameAs" => $social_links,
                )
            );

            foreach ($clients as $key => $client) {
                
                $company_data = array(

                    "@context" => "http://schema.org",
                    "@type" => "LocalBusiness",
                    "name" => $client->business_name,
                    "image" => "https://".$_SERVER['HTTP_HOST']."/storage/app/uploads/".$client->logo,
                    "priceRange"=>"$$",
                    "telephone"=>$client->phone,
                    "address" => array(

                            "@type" => "PostalAddress",
                            "streetAddress" => $client->building.', '.$client->street.', '.$client->landmark,
                            "addresslocality" =>$client->city_name,
                            "postalCode" => $client->pincode,
                            "addressCountry" => $client->country
                    )           
                );

                $all_companies_meta_data[$key+1] = $company_data;
            }

            $all_companies_meta_data = json_encode($all_companies_meta_data);

            $list_item_meta_content = array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array(
                        "@type" => "ListItem",
                        "position" => 1,
                        "item" => array(
                            "@id" => "https://enquireus.com/",
                            "name" => "Home"
                        )
                    ),
                    array(
                        "@type" => "ListItem",
                        "position" => 2,
                        "item" => array(
                            "@id" => "https://enquireus.com/".$city_info['name']."/",
                            "name" => $city_info['name']
                        )
                    ),
                    array(
                        "@type" => "ListItem",
                        "position" => 3,
                        "item" => array(
                            "@id" => "https://enquireus.com/".$city_info['name']."/".$page_url."/".$page_titles->encoded_params."",
                            "name" => $page_url
                        )
                    )                        
                )
            );

            $list_item_meta_content = json_encode($list_item_meta_content);

            return view('frontend.clients', array('clients' => $clients, 'subcategories' => $subcategories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'title_info' => $title_info, 'pageUrls' => $pageUrls, 'selected_area' => $area, 'category_company_list_meta_content' => $category_company_list_meta_content, 'list_seo_title' => $list_seo_title, 'all_companies_meta_data' => $all_companies_meta_data, 'list_item_meta_content' => $list_item_meta_content));
        }
        else{

            // If search from the top of the website
            $title_id = $encoded[0];
            $title_status = $encoded[1];
            $city = $encoded[2];
            $area = $encoded[3];

            $city_info = DB::table('cities')->where('id', $city)->first();
            $city_info = json_decode(json_encode($city_info), True);

            if($title_status == 1) {        // If title is category

                // Get all page urls for this keyword on this city's all areas
                $pageUrls = DB::table('websites_page_head_titles')
                            ->where(['category' => $title_id, 'city' => $city, 'status' => 1])
                            ->whereNotNull('area')
                            ->whereNull('subcategory')
                            ->get();

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
                        ->join('cities', 'cities.id', '=', 'user_location.city')
                        ->where('user_keywords.keyword_identity', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_location.status', 1)
                        ->where('user_details.status', 1)
                        ->where('keyword_city_client_visibility.status', 1)
                        ->where('keyword_city_client_visibility.keyword', $title_id)
                        ->where('keyword_city_client_visibility.keyword_identity', 1);

                        $query->where('category.id', $title_id);

                        $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                    $clients = $query->get();
                }
                else
                {
                    $query = DB::table('user_keywords')
                        ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('cities', 'cities.id', '=', 'user_location.city')
                        ->where('user_keywords.keyword_identity', 1)
                        ->where('user_location.status', 1)
                        ->where('user_location.area', $area)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1);

                    $query->where('category.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                    $clients = $query->get();
                   
                    // get clients on selected area with this keyword assigned by admin from table 'user_area_visibility'
                    $queryA = DB::table('user_keywords')
                        ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('user_area_visibility', 'user_area_visibility.user_id', '=', 'user_details.user_id')
                        ->join('cities', 'cities.id', '=', 'user_location.city')
                        ->where('user_keywords.keyword_identity', 1)
                        ->where('user_location.status', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1)
                        ->where('user_area_visibility.keyword_id', $title_id)
                        ->where('user_area_visibility.keyword_identity', 1)
                        ->where('user_area_visibility.area', $area)
                        ->where('user_area_visibility.status', 1);

                    $queryA->where('category.id', $title_id);

                    $queryA->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                    $clientsA = $queryA->get();

                    $index = count($clients);

                    // merge both searched clients array  
                    foreach ($clientsA as $keyA => $cA) {
                        $clients{$index} = $cA;
                        $index++;
                    }
                }        

                // Show company list in meta content on category view
                $company_list_elements = array();
                foreach ($clients as $key => $client) {
                    
                    $company_list_elements[$key]['@type'] = 'ListItem';
                    $company_list_elements[$key]['position'] = $key+1;
                    $company_list_elements[$key]['url'] = "https://enquireus.com/".$client->city_name."/".$client->page_url."/".$client->encoded_params."";
                }

                $category_company_list_meta_content = array(

                    "@context" => "http://schema.org",
                    "@type" => "ItemList",
                    "itemListElement" => $company_list_elements
                );

                $category_company_list_meta_content = json_encode($category_company_list_meta_content);

                // set breadcrumb on category list page code start here
                if($page_url){
                    $seo_item_url = str_replace("-", " ", $page_url);
                    $seo_item_url = ucwords($seo_item_url);
                }
                $list_seo_title = '<ul>
                                    <li class="first">
                                        <a id="brd_cm_city" title="Enquire Us" href="https://enquireus.com/'.$location.'">
                                            <span id="brd_cm_city_txt" class="lng_crcum">'.$location.'</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-title="'.$seo_item_url.'" id="brd_cm_srch" title="'.$seo_item_url.'" href="https://enquireus.com/'.$location.'/'.$page_url.'/'.$seo_item_herf_url.'">
                                            <span id="brd_cm_srch_txt" class="lng_crcum">'.$seo_item_url.'</span>
                                        </a>
                                    </li>
                                    <li class="lstEmt ">
                                        <a><span class="lng_crcum">10+ Listings</span></a>
                                    </li>
                                </ul>';
                // set breadcrumb on category list page code ends here 

                 // Create all companies content for meta //
                /* *************************************** */
                $social_links = array("https://twitter.com/enquire_us", "https://www.facebook.com/enquireusindia/", "https://www.instagram.com/enquire_us/", "https://www.linkedin.com/company/enquireus/");

                $all_companies_meta_data = array(
                    array(
                        "@context" => "http://schema.org",
                        "@type" => "Organization",
                        "name" => "enquireus.com",
                        "url" => "https://www.enquireus.com/",
                        "logo" => "https://www.enquireus.com/resources/frontend_assets/images/logo.png",
                        "sameAs" => $social_links,
                    )
                );

                foreach ($clients as $key => $client) {
                    
                    $company_data = array(

                        "@context" => "http://schema.org",
                        "@type" => "LocalBusiness",
                        "name" => $client->business_name,
                        "image" => "https://".$_SERVER['HTTP_HOST']."/storage/app/uploads/".$client->logo,
                        "priceRange"=>"$$",
                        "telephone"=>$client->phone,
                        "address" => array(

                                "@type" => "PostalAddress",
                                "streetAddress" => $client->building.', '.$client->street.', '.$client->landmark,
                                "addresslocality" =>$client->city_name,
                                "postalCode" => $client->pincode,
                                "addressCountry" => $client->country
                        )           
                    );

                    $all_companies_meta_data[$key+1] = $company_data;
                }

                $all_companies_meta_data = json_encode($all_companies_meta_data);

                // get city name 
                $city_info = DB::table('cities')->where('id', $page_titles->city)->first();
                $city_info = json_decode(json_encode($city_info), True);

                $list_item_meta_content = array(
                    "@context" => "https://schema.org",
                    "@type" => "BreadcrumbList",
                    "itemListElement" => array(
                        array(
                            "@type" => "ListItem",
                            "position" => 1,
                            "item" => array(
                                "@id" => "https://enquireus.com/",
                                "name" => "Home"
                            )
                        ),
                        array(
                            "@type" => "ListItem",
                            "position" => 2,
                            "item" => array(
                                "@id" => "https://enquireus.com/".$city_info['name']."/",
                                "name" => $city_info['name']
                            )
                        ),
                        array(
                            "@type" => "ListItem",
                            "position" => 3,
                            "item" => array(
                                "@id" => "https://enquireus.com/".$city_info['name']."/".$page_url."/".$page_titles->encoded_params."",
                                "name" => $page_url
                            )
                        )                        
                    )
                );

                $list_item_meta_content = json_encode($list_item_meta_content);

                return view('frontend.clients', array('clients' => $clients, 'subcategories' => $subcategories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'title_info' => $title_info, 'pageUrls' => $pageUrls, 'selected_area' => $area, 'category_company_list_meta_content' => $category_company_list_meta_content, 'list_seo_title' => $list_seo_title, 'all_companies_meta_data' => $all_companies_meta_data, 'list_item_meta_content' => $list_item_meta_content));
            }
            elseif ($title_status == 2) {   // If title is sub category

                // First get category id of this sub category
                $this_category = DB::table('subcategory')->where('id', $title_id)->first();

                // Get all page urls for this keyword on this city's all areas
                $pageUrls = DB::table('websites_page_head_titles')
                            ->where(['category' => $this_category->cat_id, 'subcategory' => $title_id, 'city' => $city, 'status' => 1])
                            ->whereNotNull('area')
                            ->get();

                // get sub category name only to show on page
                $title_info = DB::table('subcategory')->where('id', $title_id)->first();

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
                        ->join('cities', 'cities.id', '=', 'user_location.city')
                        ->where('user_keywords.keyword_identity', 2)
                        ->where('user_location.status', 1)
                        ->where('user_details.status', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('keyword_city_client_visibility.status', 1)
                        ->where('keyword_city_client_visibility.keyword', $title_id)
                        ->where('keyword_city_client_visibility.keyword_identity', 2);

                    $query->where('subcategory.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                    $clients = $query->get();

                }else{

                    $query = DB::table('user_keywords')
                        ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('cities', 'cities.id', '=', 'user_location.city')
                        ->where('user_keywords.keyword_identity', 2)
                        ->where('user_location.status', 1)
                        ->where('user_location.area', $area)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1);

                    $query->where('subcategory.id', $title_id);

                    $query->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                    $clients = $query->get();
                           
                    // get clients on selected area with this keyword assigned by admin from table 'user_area_visibility'
                    $queryA = DB::table('user_keywords')
                        ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                        ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                        ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_details.user_id')
                        ->join('user_area_visibility', 'user_area_visibility.user_id', '=', 'user_details.user_id')
                        ->join('cities', 'cities.id', '=', 'user_location.city')
                        ->where('user_keywords.keyword_identity', 2)
                        ->where('user_location.status', 1)
                        ->where('user_keywords.update_status', 1)
                        ->where('user_details.status', 1)
                        ->where('user_area_visibility.keyword_id', $title_id)
                        ->where('user_area_visibility.keyword_identity', 2)
                        ->where('user_area_visibility.area', $area)
                        ->where('user_area_visibility.status', 1);

                    $queryA->where('subcategory.id', $title_id);

                    $queryA->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'websites_page_head_titles.page_url', 'websites_page_head_titles.encoded_params', 'cities.name as city_name');

                    $clientsA = $queryA->get();

                    $index = count($clients);

                    // merge both searched clients array  
                    foreach ($clientsA as $keyA => $cA) {
                        $clients{$index} = $cA;
                        $index++;
                    }
                }                

                // Show company list in meta content on category view
                $company_list_elements = array();
                foreach ($clients as $key => $client) {
                    
                    $company_list_elements[$key]['@type'] = 'ListItem';
                    $company_list_elements[$key]['position'] = $key+1;
                    $company_list_elements[$key]['url'] = "https://enquireus.com/".$client->city_name."/".$client->page_url."/".$client->encoded_params."";
                }

                $category_company_list_meta_content = array(

                    "@context" => "http://schema.org",
                    "@type" => "ItemList",
                    "itemListElement" => $company_list_elements
                );

                $category_company_list_meta_content = json_encode($category_company_list_meta_content);

                // set breadcrumb on category list page code start here
                if($page_url){
                    $seo_item_url = str_replace("-", " ", $page_url);
                    $seo_item_url = ucwords($seo_item_url);
                }
                $list_seo_title = '<ul>
                                    <li class="first">
                                        <a id="brd_cm_city" title="Enquire Us" href="https://enquireus.com/'.$location.'">
                                            <span id="brd_cm_city_txt" class="lng_crcum">'.$location.'</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-title="'.$seo_item_url.'" id="brd_cm_srch" title="'.$seo_item_url.'" href="https://enquireus.com/'.$location.'/'.$page_url.'/'.$seo_item_herf_url.'">
                                            <span id="brd_cm_srch_txt" class="lng_crcum">'.$seo_item_url.'</span>
                                        </a>
                                    </li>
                                    <li class="lstEmt ">
                                        <a><span class="lng_crcum">10+ Listings</span></a>
                                    </li>
                                </ul>';
                // set breadcrumb on category list page code ends here 

                // Create all companies content for meta //
                /* *************************************** */
                $social_links = array("https://twitter.com/enquire_us", "https://www.facebook.com/enquireusindia/", "https://www.instagram.com/enquire_us/", "https://www.linkedin.com/company/enquireus/");

                $all_companies_meta_data = array(
                    array(
                        "@context" => "http://schema.org",
                        "@type" => "Organization",
                        "name" => "enquireus.com",
                        "url" => "https://www.enquireus.com/",
                        "logo" => "https://www.enquireus.com/resources/frontend_assets/images/logo.png",
                        "sameAs" => $social_links,
                    )
                );

                foreach ($clients as $key => $client) {
                    
                    $company_data = array(

                        "@context" => "http://schema.org",
                        "@type" => "LocalBusiness",
                        "name" => $client->business_name,
                        "image" => "https://".$_SERVER['HTTP_HOST']."/storage/app/uploads/".$client->logo,
                        "priceRange"=>"$$",
                        "telephone"=>$client->phone,
                        "address" => array(

                                "@type" => "PostalAddress",
                                "streetAddress" => $client->building.', '.$client->street.', '.$client->landmark,
                                "addresslocality" =>$client->city_name,
                                "postalCode" => $client->pincode,
                                "addressCountry" => $client->country
                        )           
                    );

                    $all_companies_meta_data[$key+1] = $company_data;
                }

                $all_companies_meta_data = json_encode($all_companies_meta_data);

                // get city name 
                $city_info = DB::table('cities')->where('id', $page_titles->city)->first();
                $city_info = json_decode(json_encode($city_info), True);

                $list_item_meta_content = array(
                    "@context" => "https://schema.org",
                    "@type" => "BreadcrumbList",
                    "itemListElement" => array(
                        array(
                            "@type" => "ListItem",
                            "position" => 1,
                            "item" => array(
                                "@id" => "https://enquireus.com/",
                                "name" => "Home"
                            )
                        ),
                        array(
                            "@type" => "ListItem",
                            "position" => 2,
                            "item" => array(
                                "@id" => "https://enquireus.com/".$city_info['name']."/",
                                "name" => $city_info['name']
                            )
                        ),
                        array(
                            "@type" => "ListItem",
                            "position" => 3,
                            "item" => array(
                                "@id" => "https://enquireus.com/".$city_info['name']."/".$page_url."/".$page_titles->encoded_params."",
                                "name" => $page_url
                            )
                        )                        
                    )
                );

                $list_item_meta_content = json_encode($list_item_meta_content);

                return view('frontend.clients', array('clients' => $clients, 'subcategories' => $subcategories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'title_info' => $title_info, 'pageUrls' => $pageUrls, 'selected_area' => $area, 'category_company_list_meta_content' => $category_company_list_meta_content, 'list_seo_title' => $list_seo_title, 'all_companies_meta_data' => $all_companies_meta_data, 'list_item_meta_content' => $list_item_meta_content));
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

                // Get client reviews
                $reviews = DB::table('client_reviews')->where(['client_uid' => $title_id, 'status' => 1])->get();

                // /////////////////////////////////////////////////////////////////////////////////////////////// //
                // Company content show in meta tags start code here //
                // Create client reviews for meta content
                $company_meta_reviews = array();
                foreach ($reviews as $key => $review) {
                    $company_meta_reviews[$key]['@type']="Review";
                    $company_meta_reviews[$key]['datePublished']=$review->created_at;
                    $company_meta_reviews[$key]['reviewBody']=$review->review;
                    $company_meta_reviews[$key]['author']=array(
                                                                    "@type"=>"Person",
                                                                    "name"=>$review->name
                                                                );
                }

                // create meta client keyword
                $company_meta_keywords = [];
                foreach ($client_keywords as $key => $keyword) {
                    if(!empty($keyword->category)){

                        $company_meta_keywords[$key] = $keyword->category;
                    }else{
                        $company_meta_keywords[$key] = $keyword->subcategory;
                    }                    
                }

                // Get company modes
                $payment_mode = $client->payment_mode;
                $payment_mode = explode("|", $payment_mode);
                $company_meta_payment_modes = array();

                if(in_array('1', $payment_mode)){ $company_meta_payment_modes[0] = "Cash"; }
                if(in_array('2', $payment_mode)){ $company_meta_payment_modes[1] = "Master"; }
                if(in_array('3', $payment_mode)){ $company_meta_payment_modes[2] = "Visa"; }                        
                if(in_array('4', $payment_mode)){ $company_meta_payment_modes[3] = "Debit"; }
                if(in_array('5', $payment_mode)){ $company_meta_payment_modes[4] = "Money"; }
                if(in_array('6', $payment_mode)){ $company_meta_payment_modes[5] = "Cheques"; }
                if(in_array('7', $payment_mode)){ $company_meta_payment_modes[6] = "Credit Card"; }
                if(in_array('8', $payment_mode)){ $company_meta_payment_modes[7] = "Travelers Cheque"; }
                if(in_array('9', $payment_mode)){ $company_meta_payment_modes[8] = "Financing Available"; }
                if(in_array('10', $payment_mode)){ $company_meta_payment_modes[9] = "American Express Card"; }
                if(in_array('11', $payment_mode)){ $company_meta_payment_modes[10] = "Diners Club Card"; }

                $meta_payment_modes = array();
                $p= 0;
                foreach ($company_meta_payment_modes as $key => $value) {
                    
                    if(!in_array($value, $meta_payment_modes)){
                        $meta_payment_modes[$p] = $value;
                        $p++;
                    }
                }
                
                $meta_from_time = '';
                $meta_to_time = '';
                $meta_working_days = array();
                foreach ($other_info as $key => $timing) {
                    
                    if($key == 0){
                        $meta_from_time = $timing->from_time;
                        $meta_to_time = $timing->to_time;
                    }

                    if($key < 7){
                        if($timing->working_status == 1){
                            $meta_working_days[$key] = $timing->day;
                        }                        
                    }
                }

                $meta_company_images = array();
                $meta_company_images[0] = "https://".$_SERVER['HTTP_HOST']."/storage/app/uploads/".$client->logo."";
                foreach ($images as $key => $image) {
                    $meta_company_images[$key+1] = "https://".$_SERVER['HTTP_HOST']."/storage/app/uploads/".$image->image."";
                }

                // create an array to show json in head meta part of this company
                $company_meta_content = array(
                    "@context"=>"http://schema.org",
                    "@type"=>"LocalBusiness",
                    "url"=>"https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
                    "name"=>$title,
                    "image"=>"https://".$_SERVER['HTTP_HOST']."/storage/app/uploads/".$client->logo,
                    "priceRange"=>"$$",
                    "address"=>array(
                        "@type"=>"PostalAddress",
                        "streetAddress"=>$client->building.', '.$client->street.', '.$client->landmark,
                        "addressLocality"=>$client->city_name,
                        "postalCode"=>$client->pincode,
                        "addressRegion"=>$client->state,
                        "addressCountry"=>$client->country
                    ),
                    "telephone"=>$client->phone,
                    "aggregateRating"=>array(
                        "@type"=>"AggregateRating",
                        "ratingValue"=>"4.1",
                        "ratingCount"=>"15"
                    ),
                    "review"=>$company_meta_reviews,
                    "paymentAccepted"=>$meta_payment_modes,
                    "openingHoursSpecification"=>array(
                        "@type" => "OpeningHoursSpecification",
                        "dayOfWeek" => $meta_working_days,
                        "opens" => $meta_from_time,
                        "closes" => $meta_to_time
                    ),
                    "photos"=>array(
                        "@type" => "ImageObject",
                        "url" => $meta_company_images
                    )
                );

                $company_meta_content = json_encode($company_meta_content);

                // Company content show in meta tags ENDS code here //
                // /////////////////////////////////////////////////////////////////////////////////////////////// //


                // /////////////////////////////////////////////////////////////////////////////////////////////// //
                // Page url (ListItem) show in meta tags start code here //

                $list_item_meta_content = array(
                    "@context" => "https://schema.org",
                    "@type" => "BreadcrumbList",
                    "itemListElement" => array(
                        array(
                            "@type" => "ListItem",
                            "position" => 1,
                            "item" => array(
                                "@id" => "https://enquireus.com/",
                                "name" => "Home"
                            )
                        ),
                        array(
                            "@type" => "ListItem",
                            "position" => 2,
                            "item" => array(
                                "@id" => "https://enquireus.com/".$client->city_name."/",
                                "name" => $client->city_name
                            )
                        ),
                        array(
                            "@type" => "ListItem",
                            "position" => 3,
                            "item" => array(
                                "@id" => "https://enquireus.com/".$client->city_name."/".$page_url."/".$page_titles->encoded_params."",
                                "name" => $client->business_name
                            )
                        )                        
                    )
                );

                $list_item_meta_content = json_encode($list_item_meta_content);


                // Page url (ListItem) show in meta tags ENDS code here //
                // /////////////////////////////////////////////////////////////////////////////////////////////// //
               
                return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'client_keywords' => $client_keywords, 'reviews' => $reviews, 'company_meta_content' => $company_meta_content, 'list_item_meta_content' => $list_item_meta_content));
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

    # Get content for about us page
    public function aboutus(Request $request)
    {
        $lastParam = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        // get page title, keyword and description
        $page_titles = DB::table('websites_page_head_titles')->where(array('status' => 1, 'page_url' => $lastParam))->first();

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
        
        $page = $request->webpage;

        $page = str_replace('-', ' ', $page);

        // Get page content
        $webpages = DB::table('website_pages')->where(array('id' => 1, 'status' => 1))->first();

        $website_pages = DB::table('website_pages')->where('status', 1)->get();
        
        return view('frontend.webpage_view', array('webpages' => $webpages, 'website_pages' => $website_pages, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));

    }

    # Get content for contact us page
    public function contactus(Request $request)
    {
        $lastParam = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        // get page title, keyword and description
        $page_titles = DB::table('websites_page_head_titles')->where(array('status' => 1, 'page_url' => $lastParam))->first();

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
        
        $page = $request->webpage;

        $page = str_replace('-', ' ', $page);

        // Get page content
        $webpages = DB::table('website_pages')->where(array('id' => 2, 'status' => 1))->first();

        $website_pages = DB::table('website_pages')->where('status', 1)->get();
        
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

        // get current route name to get page title , keyword and description
        $routeName = Route::currentRouteName();

        // get page title for this page
        $page_titles = DB::table('websites_page_head_titles')->where(array('status' => 1, 'page_url' => $routeName))->first();

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

        $super_cat_id = $request->super_cat_id;
        
        // Get all categories according to this super category
        $categories = DB::table('category')->where(['super_category' =>$super_cat_id, 'status' => 1])->get();

        // get all super categories
        $super_catgories = DB::table('super_categories')->get();

        return view('frontend.categories', array('categories' => $categories, 'super_catgories' => $super_catgories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
    }

    // generate dynamic sitemap
    public function sitemap(){

        // get all page urls from database table
        $urls = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where(['websites_page_head_titles.status' => 1, 'websites_page_head_titles.update_status' => 1])
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        $hostname =  'http://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // echo '<pre>';
        // echo $base_url;
        // print_r($urls);
        // exit;

        return response()->view('sitemap.sitemap', array('urls' => $urls, 'base_url' => $base_url))->header('Content-type', 'text/xml');
    }

    // send enquiry to client
    public function send_enquiry(Request $request){
        
        $name = $request->enq_name;
        $email = $request->enq_email;
        $phone = $request->enq_phone;
        $enquiry = $request->enq_enquiry;
        $enq_client = $request->enq_client;
        $temp = explode('_', $enq_client);
        $client_uid = decrypt($temp[1]);

        $date = date('Y-m-d H:i:s');

        // Check phone number is numeric or not
        if (! is_numeric($phone)){
            return Redirect::back()->withErrors(['Phone number is not valid !']);
        }

        // Check the email is valid or not
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Redirect::back()->withErrors(['Email is not valid !']);
        }

        // If all ok then Insert enquiry in table
        $enquiry = DB::table('client_enquiries')->insert([
            'client_uid' => $client_uid,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'enquiry' => $enquiry,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($enquiry){

            // get client information from db
            $client_info = DB::table('websites_page_head_titles')->where(['business_page' => $client_uid, 'status' => 1])->first();

            return Redirect::back()->withErrors(['Enquiry generated successfully.']);

        }else{
            return Redirect::back()->withErrors(['Something went wrong !']);
        }
    }

    // send multiple enquiry for any category
    public function send_multiple_enquiries(Request $request){
        
        $name = $request->enq_name;
        $email = $request->enq_email;
        $phone = $request->enq_phone;
        $enquiry = $request->enq_enquiry;
        $enq_client = $request->enq_client;
        $temp = explode('_', $enq_client);
        $category_id = decrypt($temp[1]);
        $identity = $temp[2];

        $date = date('Y-m-d H:i:s');

        // Check phone number is numeric or not
        if (! is_numeric($phone)){
            return Redirect::back()->withErrors(['Phone number is not valid !']);
        }

        // Check the email is valid or not
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Redirect::back()->withErrors(['Email is not valid !']);
        }

        // If all ok then Insert enquiry in table
        $enquiry = DB::table('category_enquiries')->insert([
            'category_id' => $category_id,
            'identity' => $identity,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'enquiry' => $enquiry,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        // If enquiry submitted successfully
        if($enquiry){
            return Redirect::back()->withErrors(['Enquiry generated successfully.']);

        }else{
            return Redirect::back()->withErrors(['Something went wrong !']);
        }
    }

    // submit user review
    public function review(Request $request){
        
        $name = $request->rev_name;
        $email = $request->rev_email;
        $phone = $request->rev_phone;
        $review = $request->rev_review;
        $rating = $request->rev_rating;
        $client_uid = $request->rev_client;

        $date = date('Y-m-d H:i:s');

        // Check phone number is numeric or not
        if (! is_numeric($phone)){
            return Redirect::back()->withErrors(['Phone number is not valid !']);
        }

        // Check the email is valid or not
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Redirect::back()->withErrors(['Email is not valid !']);
        }

        // If all ok then Insert enquiry in table
        $review = DB::table('client_reviews')->insert([
            'client_uid' => $client_uid,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'review' => $review,
            'rating' => $rating,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($review){

            // If review submitted successfully then redirect with success message
            return Redirect::back()->withErrors(['Review submitted successfully.']);
        }else{

            // Redirect with error message
            return Redirect::back()->withErrors(['Something went wrong !']);
        }
    }
}
