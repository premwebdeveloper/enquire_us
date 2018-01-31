<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    // Authenticate users
    public function __construct()
    {
        $this->middleware('auth');
    }

    // admin dashdoard
    public function dashboard()
    {
    	return view('dashboard.admin_dashboard');
    }
}
