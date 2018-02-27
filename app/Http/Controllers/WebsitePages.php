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
}
