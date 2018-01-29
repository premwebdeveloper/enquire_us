<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    // admin dashdoard
    public function dashboard()
    {
    	return view('dashboard.admin_dashboard');
    }
}
