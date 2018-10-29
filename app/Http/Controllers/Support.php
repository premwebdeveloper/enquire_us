<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class Support extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('supportmiddleware');
    }

    // Support dashdoard
    public function dashboard()
    {
    	
    	return view('dashboard.support_dashboard');
    }
}
