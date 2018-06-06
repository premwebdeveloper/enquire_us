<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class Areas extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
        $this->middleware('supportmiddleware');
    }

    //view area
    public function area()
    {
        $cities = DB::table('cities')->where('state_id', 33)->get();

        $areas = DB::table('areas')
        ->join('cities', 'cities.id', '=', 'areas.city')
        ->join('states', 'states.id', '=', 'areas.state')
        ->join('countries', 'countries.id', '=', 'areas.country')
        ->select('areas.*', 'cities.name as city_name', 'states.name as state_name', 'countries.name as country_name')
        ->where('status', 1)->get();

        return view('admin.Area', array('areas' => $areas, 'cities' => $cities));
    }

    // add area page
    public function add_area()
    {
        $cities = DB::table('cities')->where('state_id', 33)->get();

        return view('admin.addArea', array('cities' => $cities));
    }

    // add area
    public function addarea(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $area = $request->area;
        $pincode = $request->pincode;

        $add_area = DB::table('areas')->insert(
            array('country' => $country, 'state' => $state, 'city' => $city, 'area' => $area, 'pincode' => $pincode, 'created_at' => $date, 'updated_at' => $date)
        );


        if($add_area)
        {
            $status = 'Area Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('add_area')->with('status', $status);
    }

    // add area
    public function update_area(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $id = $request->area_id;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $area = $request->area;
        $pincode = $request->pincode;

        $add_area = DB::table('areas')->where('id', $id)->update(
            array('country' => $country, 'state' => $state, 'city' => $city, 'area' => $area, 'pincode' => $pincode, 'created_at' => $date, 'updated_at' => $date)
        );


        if($add_area)
        {
            $status = 'Area Update successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('area')->with('status', $status);
    }
	
	// Client area visibility page view
	public function client_area_visibility()
	{
		# Get All Users
        $clients = DB::table('user_details')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->join('areas', 'areas.id', '=', 'user_location.area')
                ->join('cities', 'cities.id', '=', 'user_location.city')
                ->where('user_details.status', '!=', 0)
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.state', 'user_location.country', 'user_location.pincode', 'areas.area as area_name', 'cities.name as city_name')
                ->get();

		return view('admin.client_area_visibility', array('clients' => $clients));
	}
	
	// Edit client area visibility Page
	public function edit_client_area_visibility(Request $request)
	{
		$user_id = $request->user_id;
		
		// If user id is empty / user hit on url
		if(empty($user_id))
		{
			return redirect('client_area_visibility');
		}
				
		// First get user details like user location info and other visible areas if available
		$location_info = DB::table('user_location')->where('user_id', $user_id)->first();
				
		// Get total areas of user selectes city
		$areas = DB::table('areas')->where('city', $location_info->city)->get();
		
		// Convert stdClass into array
		$areas = json_decode(json_encode($areas), True);
		
		// First remove user selected area from all areas array
		foreach($areas as $key => $area)
		{
			// If match area then remove area
			if($area['id'] == $location_info->area)
			{
				// Remove array index
				unset($areas[$key]);
			}
		}
		
		// Convert again array into stdClass object
		$areas = (object)$areas;
				
		// Get total visible areas
		$area_visibility_info = DB::table('user_area_visibility')->where('user_id', $user_id)->get();
					
		return view('admin.edit_client_area_visibility', array('visible_area' => $area_visibility_info, 'areas' => $areas, 'user_info' => $location_info));
	}
	
	# Edit client area visibility function
	public function edit_area_visibility(Request $request)
	{
		// Get all selectes areas
		$areas = $request->areas;
		$user_id = $request->this_user;
		
		$date = date('Y-m-d H:i:s');
		
		// First check if this user already have another areas or not
		$exist_areas = DB::table('user_area_visibility')->where('user_id', $user_id)->get();
		
		if(!empty($exist_areas))
		{
			foreach($exist_areas as $e_key => $e_area)
			{
				// If already exist areas then remove all and after then inser new areas
				$delete_area = DB::table('user_area_visibility')->where('id', $e_area->id)->delete();
			}
		}
		
		// Insert areas in db
		foreach($areas as $key => $area)
		{
			// Insert this area in area visible table
			$assign = DB::table('user_area_visibility')->insert([
				'user_id' => $user_id,
				'area' => $area,
				'created_at' => $date,
				'updated_at' => $date,
			]);			
		}
		
		return redirect('client_area_visibility')->with('status', 'Areas Assigned successfully.');
	}
	
}
