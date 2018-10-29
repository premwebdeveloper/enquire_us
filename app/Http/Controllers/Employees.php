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
