<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class Blogs extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // View All Blogs
    public function index()
    {
    	$blogs = DB::table('blogs')->where('status', 1)->get();
    	return view('blogs.index', array('blogs' => $blogs));
    }

    // Add blog page view
    public function addBlog()
    {
    	return view('blogs.create');
    }

    // Add new blog
    public function create(Request $request)
    {
    	$title = $request->title;
    	$content = $request->content;
    	echo 'create'; exit;
    }

    // view blog edit page
    public function editBlog(Request $request)
    {
    	$blog_id = $request->blog_id;

    	// Get blog details
    	$blog = DB::table('blogs')->where(['id' => $blog_id, 'status' => 1])->first();

    	return view('blogs.edit', array('blog' => $blog));
    }
}
