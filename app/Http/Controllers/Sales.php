<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class Sales extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('salesmiddleware');
    }

    // Support dashdoard
    public function dashboard()
    {
    	
    	return view('dashboard.sales_dashboard');
    }
}
