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

class WebsitePages extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    //website pages
    public function website_pages()
    {
        $web_pages = DB::table('website_pages')->where('status',1)->get();

        return view('website_pages.index', array('web_pages' => $web_pages));
    }

    public function update_page(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $id = $request->id;
        $content = $request->content;

        //$web_page_update = DB::table('website_pages')->where('id', $id)->update({'page_description' => $content});

        $web_page_update = DB::table('website_pages')->where('id', $id)->update(['page_description' => $content, 'updated_at' => $date]);

        if($web_page_update)
        {
            $status = "successfully Update.";
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('website_pages')->with('status', $status);
    }

    // Website page head titles like Title, Meta title, Keyword, Description etc
    public function page_titles(Request $request)
    {
        $category = $request->category;
        $sub_category = $request->sub_category;
        $city = $request->city;
        //$area = $request->area;
        $business = $request->business;
        $page = $request->page;
        $title = $request->title;
        $keyword = $request->keyword;
        $description = $request->description;

        $date = date('Y-m-d H:i:s');

        if(!empty($title) && !empty($keyword) && !empty($description))
        {
            // Create page url
            $page_url = $page;

            // If Page name is blank and category is selected
            if($page == '')
            {
                if(!empty($category))
                {
                    // define page url blank
                    $page_url = '';

                    // If sub category selected then page url will create with sub category
                    if(!empty($sub_category))
                    {
                        // Get sub Category Name
                        $p_subcategory = DB::table('subcategory')->where(array('id' => $sub_category, 'status' => 1))->first();
                        $page_url .= preg_replace('/[^A-Za-z0-9\-]/', '-', $p_subcategory->subcategory);
                    }
                    else    // Page url will create with Category
                    {
                        // Get Category Name
                        $p_category = DB::table('category')->where(array('id' => $category, 'status' => 1))->first();
                        $page_url .= preg_replace('/[^A-Za-z0-9\-]/', '-', $p_category->category);
                    }

                    $page = $category.'|'.$sub_category.'|'.$city.'|';

                    // first insert selected city titles
                    $insert = DB::table('websites_page_head_titles')->insert(array(
                        'page' => $page,
                        'business_page' => $business,
                        'page_url' => $page_url,
                        'title' => $title,
                        'keyword' => $keyword,
                        'description' => $description,
                        'created_at' => $date,
                        'updated_at' => $date,
                        'status' => 1
                    ));

                    // Get city name by city id
                    $cityRow = DB::table('cities')->where('id', $city)->first();
                    $cityName = $cityRow->name;
                    $cityName = strtolower($cityName);

                    // first of all get all areas of selectes city
                    $allAreas = DB::table('areas')->where(['city' => $city, 'status' => 1])->get();

                    if(!empty($allAreas[0])){

                        foreach ($allAreas as $key => $row) {

                            $page = $category.'|'.$sub_category.'|'.$city.'|'.$row->id;

                            // Get Area Name
                            $areaa = preg_replace('/[^A-Za-z0-9\-]/', '-', $row->area);

                            $main_page_url = $page_url;
                            $area_page_url = $main_page_url.'-in-'.$areaa;

                            // Insert titles for all areas of selected
                            $insert = DB::table('websites_page_head_titles')->insert(array(
                                'page' => $page,
                                'business_page' => $business,
                                'page_url' => $area_page_url,
                                'title' => str_replace($cityName, $row->area, strtolower($title)),
                                'keyword' => str_replace($cityName, $row->area, strtolower($keyword)),
                                'description' => str_replace($cityName, $row->area, strtolower($description)),
                                'created_at' => $date,
                                'updated_at' => $date,
                                'status' => 1
                            ));
                        }
                    }

                    dd($allAreas);

                }
            }

            // If business name is selected
            if($business != '')
            {
                // Create page url
                $page_url = '';

                $business = $business.'|'.$city.'|'.$area;

                // Get business name
                $businessDetail = DB::table('user_location')->where(array('user_id' => $business, 'status' => 1))->first();
                $page_url .= preg_replace('/[^A-Za-z0-9\-]/', '-', $businessDetail->business_name);

                if(!empty($area))
                {
                    // Get Area Name
                    $p_areas = DB::table('areas')->where(array('id' => $area, 'status' => 1))->first();
                    $areaa = preg_replace('/[^A-Za-z0-9\-]/', '-', $p_areas->area);
                    $page_url .= '-in-'.$areaa;
                }
                else
                {
                    $page_url .= '-in-jaipur';
                }
            }

            // Insert page titles when category and business name not selected
            $insert = DB::table('websites_page_head_titles')->insert(
                array(
                    'page' => $page,
                    'business_page' => $business,
                    'page_url' => $page_url,
                    'title' => $title,
                    'keyword' => $keyword,
                    'description' => $description,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 1
                )
            );
        }

        //  Get All Categories
        $business = DB::table('user_location')->where('status', 1)->get();

        //  Get All Categories
        $category = DB::table('category')->where('status', 1)->get();

        //  Get All Areas
        $where = array('status' => 1, 'city' => 3378);
        $areas = DB::table('areas')->where($where)->get();

        //  Get All Page titles
        $titles = DB::table('websites_page_head_titles')->where('status', 1)->get();

        return view('website_pages.page_titles', array('category' => $category, 'areas' => $areas, 'business' => $business, 'titles' => $titles));
    }
}
