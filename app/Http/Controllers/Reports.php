<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class Reports extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show reports page
    public function index(){

    	return view('reports.index');
    }

    // Show employees client meetings page
    public function employees_client_meeting(){

    	// Get employees
    	$employees = DB::table('employees')
    				->join('user_roles', 'user_roles.user_id', '=', 'employees.user_id')
    				->join('roles', 'roles.id', '=', 'user_roles.role_id')
    				->where('status', 1)
    				->select('employees.*', 'roles.role')
    				->get();

    	return view('reports.employees_client_meeting', array('employees' => $employees));
    }

    // employee client meeting report generate
    public function generate_employee_client_meeting_report(Request $request){

    	// Get employees
    	$employees = DB::table('employees')
    				->join('user_roles', 'user_roles.user_id', '=', 'employees.user_id')
    				->join('roles', 'roles.id', '=', 'user_roles.role_id')
    				->where('status', 1)
    				->select('employees.*', 'roles.role')
    				->get();

		$employee = $request->employee;
    	$start_date = date('Y-m-d', strtotime($request->start));
    	$end_date = date('Y-m-d', strtotime($request->end));

    	// Get meetings of this employee
    	$meeting_records = DB::table('user_details')
    						->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
    						->where('user_details.created_by', $employee)
    						->whereDate('user_details.created_at', '>=', $start_date)
    						->whereDate('user_details.created_at', '<=', $end_date)
    						->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country')
    						->get();

    	return view('reports.employees_client_meeting', array('employees' => $employees, 'meeting_records' => $meeting_records));
    }

}
