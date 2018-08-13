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
use Illuminate\Support\Facades\Crypt;

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
        $business = $request->business;
        $page = $request->page;
        $title = $request->title;
        $keyword = $request->keyword;
        $description = $request->description;
        $date = date('Y-m-d H:i:s');
        $status = '';

        // First of all check if page url and page titles are already created or not for selected category, subcategory and city
        $rows = DB::table('websites_page_head_titles')
                ->where(['category' => $category, 'subcategory' => null, 'city' => $city, 'area' => null, 'status' => 1]);
                
                $rows->where('encoded_params', '!=', null);
                
        // If the sub category is selected
        if(!empty($sub_category)){
            $rows->where('subcategory', $sub_category);
        }

        $exist = $rows->first();

        // define blank array for ignore error when admin go to page directly
        $sub_category_info = array();

        // If the entry is already not exist for selected data then process this to create page url and titles n all
        if(empty($exist)){
            
            if(!empty($title) && !empty($keyword) && !empty($description))
            {
                // Create page url
                $page_url = $page;

                // when category is selected and page name and business name is not seleted
                if(!empty($category))
                {
                    // define page url blank
                    $page_url = '';

                    // If sub category selected then page url will create with sub category
                    if(!empty($sub_category))
                    {
                        $params = $sub_category.'-2-'.$city;

                        // Get sub Category Name
                        $p_subcategory = DB::table('subcategory')->where(array('id' => $sub_category, 'status' => 1))->first();
                        $page_url .= preg_replace('/[^A-Za-z0-9\-]/', '-', $p_subcategory->subcategory);
                    }
                    else    // Page url will create with Category
                    {
                        $params = $category.'-1-'.$city;

                        // Get Category Name
                        $p_category = DB::table('category')->where(array('id' => $category, 'status' => 1))->first();
                        $page_url .= preg_replace('/[^A-Za-z0-9\-]/', '-', $p_category->category);
                    }

                    $encrypted = base64_encode($params);

                    // first insert selected city titles
                    $insert = DB::table('websites_page_head_titles')->insert(array(
                        'category' => $category,
                        'subcategory' => $sub_category,
                        'city' => $city,
                        'business_page' => $business,
                        'page_url' => strtolower($page_url),
                        'encoded_params' => $encrypted,
                        'title' => ucfirst(strtolower($title)),
                        'keyword' => ucfirst(strtolower($keyword)),
                        'description' => ucfirst(strtolower($description)),
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

                            // Get Area Name
                            $areaa = preg_replace('/[^A-Za-z0-9\-]/', '-', $row->area);

                            $main_page_url = $page_url;
                            $area_page_url = $main_page_url.'-in-'.$areaa;

                            // If the subcategory is blank then
                            if(!empty($sub_category)){
                                $params = $sub_category.'-2-'.$city.'-'.$row->id;
                            }else{ 
                                $params = $category.'-1-'.$city.'-'.$row->id;
                            }

                            $encrypted = base64_encode($params);            
                            
                            // Insert titles for all areas of selected
                            $insert = DB::table('websites_page_head_titles')->insert(array(
                                'category' => $category,
                                'subcategory' => $sub_category,
                                'city' => $city,
                                'area' => $row->id,
                                'business_page' => $business,
                                'page_url' => strtolower($area_page_url),
                                'encoded_params' => $encrypted,
                                'title' => str_replace($cityName, $row->area.', '.$cityName, ucfirst(strtolower($title))),
                                'keyword' => str_replace($cityName, $row->area.', '.$cityName, ucfirst(strtolower($keyword))),
                                'description' => str_replace($cityName, $row->area.', '.$cityName, ucfirst(strtolower($description))),
                                'created_at' => $date,
                                'updated_at' => $date,
                                'status' => 1
                            ));

                            $params = '';
                        }
                    }
                }

                if(!empty($page) && $page != '')    // If page name is selected and category name and business name not selected
                {
                    // Insert page titles when category and business name not selected
                    $insert = DB::table('websites_page_head_titles')->insert(array(
                        'page_url' => $page_url,
                        'title' => $title,
                        'keyword' => $keyword,
                        'description' => $description,
                        'created_at' => $date,
                        'updated_at' => $date,
                        'status' => 1
                    ));
                }

                $status = "Page url and titles created successfully.";
            }
        }else{

            // get sub category name if selected
            $sub_category_info = DB::table('subcategory')->where('id', $sub_category)->first(); 

            // If enteries are already exist then hit error
            $status = "Page url and titles are already created for the category / subcategory with this city ! You can update this information.";
        }

        //  Get All Categories
        $business = DB::table('user_location')->where('status', 1)->get();

        //  Get All Categories
        $category = DB::table('category')->where('status', 1)->get();

        //  Get All Page titles
        $titles = DB::table('websites_page_head_titles')->where('status', 1)->get();

        return view('website_pages.page_titles', array('category' => $category, 'business' => $business, 'titles' => $titles, 'status' => $status, 'exist' => $exist, 'sub_category_info' => $sub_category_info));
    }

    // Update Website page head titles like Title, Meta title, Keyword, Description etc
    public function update_page_titles(Request $request){

        $category = $request->u_cat_id;
        $sub_category = $request->u_subcat_id;
        $city = $request->u_city_id;
        $title = $request->u_title;
        $keyword = $request->u_keyword;
        $description = $request->u_description;
        $date = date('Y-m-d H:i:s');

        // if anyone directly come to this function then through back
        if(empty($sub_category) &&  empty($sub_category) && empty($city)){
            return redirect('page_titles');
        }

        // If subcategory is exist
        if($sub_category){            
            $where = array('category' => $category, 'subcategory' => $sub_category, 'city' => $city);
        }else{            
            $where = array('category' => $category, 'city' => $city);
        }

        // Update title, keyword and description
        $update = DB::table('websites_page_head_titles')->where($where)->update([
            'title' => ucfirst(strtolower($title)),
            'keyword' => ucfirst(strtolower($keyword)),
            'description' => ucfirst(strtolower($description)),
            'updated_at' => $date
        ]);

        // first of all get all areas of selectes city
        $allAreas = DB::table('areas')->where(['city' => $city, 'status' => 1])->get();

        // Get city name by city id
        $cityRow = DB::table('cities')->where('id', $city)->first();
        $cityName = $cityRow->name;
        $cityName = strtolower($cityName);

        if(!empty($allAreas[0])){

            foreach ($allAreas as $key => $row) {

                // If subcategory is exist
                if($sub_category){
                    $where = array('category' => $category, 'subcategory' => $sub_category, 'city' => $city, 'area' => $row->id);
                }else{
                    $where = array('category' => $category, 'city' => $city, 'area' => $row->id);
                }

                $new_title = str_replace($cityName, $row->area.', '.$cityName, ucfirst(strtolower($title)));
                $new_keyword = str_replace($cityName, $row->area.', '.$cityName, ucfirst(strtolower($keyword)));
                $new_description = str_replace($cityName, $row->area.', '.$cityName, ucfirst(strtolower($description)));
                
                // Update title, keyword and description for area
                $update_area = DB::table('websites_page_head_titles')->where($where)->update([
                    'title' => $new_title,
                    'keyword' => $new_keyword,
                    'description' => $new_description,
                    'updated_at' => $date
                ]);
            }
        }

        $status = "Page url and titles are description updated successfully.";
        
        //  Get All users with location
        $business = DB::table('user_location')->where('status', 1)->get();

        //  Get All Categories
        $category = DB::table('category')->where('status', 1)->get();

        //  Get All Page titles
        $titles = DB::table('websites_page_head_titles')->where('status', 1)->get();

        return view('website_pages.page_titles', array('category' => $category, 'business' => $business, 'titles' => $titles, 'status' => $status));
    }

    # Update page titles data
    public function editPageUrlTitle(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $id = $request->row_id;
        $title = $request->edit_title;
        $keyword = $request->edit_keyword;
        $description = $request->edit_description;

        $update = DB::table('websites_page_head_titles')->where('id', $id)->update([
            'title' => $title,
            'keyword' => $keyword,
            'description' => $description,
            'updated_at' => $date
        ]);

        if($update)
        {
            $status = "Page Titles Updated Successfully.";
        }
        else
        {
            $status = 'Something Went Wrong !';
        }

        return redirect('page_titles')->with('status', $status);
    }
}
