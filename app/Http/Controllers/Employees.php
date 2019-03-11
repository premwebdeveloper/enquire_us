<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Storage;
use Session;
use File;

class Employees extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Show all employees / employees view page
    public function index(){

    	// Get all employees
    	$employees = DB::table('employees')
    				->join('user_roles', 'user_roles.user_id', '=', 'employees.user_id')
    				->join('roles', 'roles.id', '=', 'user_roles.role_id')
    				->where('status', 1)
    				->select('employees.*', 'roles.role')
    				->get();

    	return view('employees.index', array('employees' => $employees));
    }

    // Employee create view page
    public function empCreateView(){

    	return view('employees.create');
    }

    // Show employees clients in chart view
    public function employees_clients(){

        // Get all employees
        $employees = DB::table('employees')
                    ->join('user_roles', 'user_roles.user_id', '=', 'employees.user_id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->leftJoin('user_details', 'user_details.created_by', '=', 'employees.user_id')
                    ->where('employees.status', 1)
                    ->select('employees.*', 'roles.role', DB::raw("count(user_details.created_by) as created_by_count"))
                    ->groupBy('employees.id')
                    ->get();

                    //echo '<pre>';

                    $month_names = array();
                    for($x=11; $x>=0;$x--){
                        $month_names[$x] = date('F', strtotime(date('Y-m')." -" . $x . " month"));
                    }
                    //print_r($month_names);

                    $months = array();
                    for($x=11; $x>=0;$x--){
                        $months[$x] = date('Y-m-d', strtotime(date('Y-m')." -" . $x . " month"));
                    }
                    //print_r($months);

                    $total_emps_clients = array();
                    $month_clients = array();

                    foreach($employees as $key => $emp) {

                        $total_emps_clients[$key]['emp_uid'] = $emp->user_id;
                        $total_emps_clients[$key]['emp_name'] = $emp->name;

                        foreach ($months as $m_key => $first_date) {
                            
                            $last_date = date("Y-m-t", strtotime($first_date));
                            $month_name = date("F", strtotime($first_date));

                            // echo $emp->user_id;echo '<br />';
                            // echo $first_date;
                            // echo $last_date;

                            $clients = DB::table('user_details')
                                        ->join('employees', 'employees.user_id', '=', 'user_details.created_by')
                                        ->where(['user_details.status' => 1, 'user_details.created_by' => $emp->user_id])
                                        //->whereBetween('user_details.created_at', [$first_date,$last_date])
                                        ->whereDate('user_details.created_at', '>', $first_date)
                                        ->whereDate('user_details.created_at', '<', $last_date)
                                        ->select('user_details.*')
                                        ->get();
                            // echo '<br />';
                            // print_r(count($clients));
                            // echo '<br />';
                            // echo '<br />';

                            $month_clients[$m_key]['y'] = substr($month_name, 0, 3);
                            $month_clients[$m_key]['a'] = count($clients);
                        }
                        $total_emps_clients[$key]['month_clients'] = $month_clients;
                    }

                    // print_r($total_emps_clients);

                    // exit;

        return view('employees.employees_clients', array('employees' => $employees, 'total_emps_clients' => $total_emps_clients));
    }

    // add employee function
    public function create(Request $request){

		$role   = $request->emp_role;
		$name   = $request->name;
		$email  = $request->email;
		$phone  = $request->phone;
		$gender = $request->gender;
		$date = date('Y-m-d H:i:s');

        # Set validation for
		$this->validate($request, [
            'emp_role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10',
        ]);

		// create employee's user in usrs table first
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => bcrypt('123456'),
            'status' => 1
        ]);

        $user_id = $user->id;

		// create employee's role in users role table
        $role = DB::table('user_roles')->insert(
            array(
                'role_id' => $role,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

		// create employee in employees table
    	$create = DB::table('employees')->insert(
            array(
                'user_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

    	if($create):

    		$status = 'Employee added successfully.';
    	else:

    		$status = 'Something went wrong!';
    	endif;

        return redirect('employees')->with('status', $status);
    }

    // employee edit view page
    public function editView(Request $request){

    	$user_id   = $request->user_id;

    	$employee = DB::table('employees')
    				->join('user_roles', 'user_roles.user_id', '=', 'employees.user_id')
    				->join('roles', 'roles.id', '=', 'user_roles.role_id')
    				->where('employees.user_id', $user_id)
    				->select('employees.*', 'roles.role', 'user_roles.role_id')
    				->first();

    	return view('employees.edit', array('employee' => $employee));
    }

    // edit employees
    public function edit(Request $request){

		$user_id  = $request->user_id;
		$emp_role = $request->emp_role;
		$name     = $request->name;
		$phone    = $request->phone;
		$gender   = $request->gender;
		$date     = date('Y-m-d H:i:s');

        # Set validation for
		$this->validate($request, [
			'emp_role' => 'required',
			'name'     => 'required',
			'phone'    => 'required|numeric|digits:10',
        ]);

		// Update users table
        $user_update = User::where('id', $user_id)->update([
			'name'       => $name,
			'phone'      => $phone,
			'updated_at' => $date,
        ]);

        // Update user role tale
        $role_update = DB::table('user_roles')->where('user_id', $user_id)->update([            
            'role_id' => $emp_role,
            'updated_at' => $date            
        ]);

        // Update employees table
        $employee_update = DB::table('employees')->where('user_id', $user_id)->update([
            'name' => $name,
            'phone' => $phone,
            'gender' => $gender,
            'updated_at' => $date
        ]);

        if($employee_update):

    		$status = 'Employee updated successfully.';
    	else:

    		$status = 'Something went wrong!';
    	endif;

        return redirect('employees')->with('status', $status);
    }

    // employee delete
    public function delete(Request $request){

    	$user_id   = $request->user_id;
		$date = date('Y-m-d H:i:s');

    	// delete employee user from users table
    	$user = DB::table('users')->where('id', $user_id)->update(
            array(
                'updated_at' => $date,
                'status' => 0
            )
        );

        $update = DB::table('employees')->where('user_id', $user_id)->update(
            array(
                'status' => 0,
                'updated_at' => $date
            )
        );

        if($update):

    		$status = 'Employee deleted successfully.';
    	else:

    		$status = 'Something went wrong!';
    	endif;

        return redirect('employees')->with('status', $status);

    }
}
