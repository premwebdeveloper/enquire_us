<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // admin dashdoard
    public function dashboard()
    {
    	return view('dashboard.admin_dashboard');
    }
}
