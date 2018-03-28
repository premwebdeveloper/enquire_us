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

    // about_us
    public function aboutus()
    {
        $web_page_update = DB::table('website_pages')->where('id', $id)->update(['page_description' => $content, 'updated_at' => $date]);
    }

    // Website page head titles like Title, Meta title, Keyword, Description etc
    /*public function page_titles_manage()
    {
        return view('website_pages.page_titles');
    }*/

    // Website page head titles like Title, Meta title, Keyword, Description etc
    public function page_titles(Request $request)
    {
        $category = $request->category;
        $sub_category = $request->sub_category;
        $city = $request->city;
        $area = $request->area;
        $business = $request->business;
        $page = $request->page;
        $title = $request->title;
        $keyword = $request->keyword;
        $description = $request->description;

        if(!empty($title) && !empty($keyword) && !empty($description))
        {
            // If Page name is blank and category is selected
            if($page == '')
            {
                if(!empty($category))
                {
                    $page = $category.'|'.$sub_category.'|'.$city.'|'.$area;
                }
            }

            // If business name is selected
            if($business != '')
            {
                $business = $business.'|'.$city.'|'.$area;
            }

            $date = date('Y-m-d H:i:s');

            // Insert page titles
            $insert = DB::table('websites_page_head_titles')->insert(
                array(
                    'page' => $page,
                    'business_page' => $business,
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

        // Get page name if Dynamic page created using category / subcategory / city / area
        foreach ($titles as $key => $title) {
            $page = $title->page;

            // If page is not null
            if(!empty($page))
            {
                $temp = explode('|', $page);

                if(count($temp) > 1)
                {
                    $dynamic_page = '';

                    $p_cat = $temp[0];
                    $p_subcat = $temp[1];
                    $p_city = $temp[2];
                    $p_area = $temp[3];

                    if(!empty($p_subcat))
                    {
                        // Get Category Name
                        $p_subcategory = DB::table('subcategory')->where(array('id' => $p_subcat, 'status' => 1))->first();

                        $dynamic_page .= $p_subcategory->subcategory;
                    }
                    else
                    {
                        // Get Category Name
                        $p_category = DB::table('category')->where(array('id' => $p_cat, 'status' => 1))->first();

                        $dynamic_page .= $p_category->category;
                    }

                    if(!empty($p_area))
                    {
                         // Get Category Name
                        $p_areas = DB::table('areas')->where(array('id' => $p_area, 'status' => 1))->first();

                        $dynamic_page .= '-in-'.$p_areas->area;
                    }
                    else
                    {
                        $dynamic_page .= '-in-jaipur';
                    }

                    $title->dynamic_page = $dynamic_page;
                }
                else
                {
                    $title->dynamic_page = '';
                }
            }
            elseif(!empty($title->business_page))
            {
                $busi_temp = explode('|', $title->business_page);

                $p_busi = $busi_temp[0];
                $p_city = $busi_temp[1];
                $p_area = $busi_temp[2];

                // Get business name
                $businessDetail = DB::table('user_location')->where(array('user_id' => $p_busi, 'status' => 1))->first();
                $businessName = $businessDetail->business_name;

                if(!empty($p_area))
                {
                     // Get Category Name
                    $p_areas = DB::table('areas')->where(array('id' => $p_area, 'status' => 1))->first();

                    $businessName .= '-in-'.$p_areas->area;
                }
                else
                {
                    $businessName .= '-in-jaipur';
                }

                $title->business_page = $businessName;
            }


        }

        return view('website_pages.page_titles', array('category' => $category, 'areas' => $areas, 'business' => $business, 'titles' => $titles));
    }
}
