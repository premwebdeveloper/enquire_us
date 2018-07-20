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

        # Set validation for
        $this->validate($request, [
            'area' => 'required|unique:areas',
        ]);

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

		// Get clients all keyword
		$client_keywords =  DB::table('user_keywords')->where(['user_keywords.user_id' => $user_id, 'user_keywords.status' => 1])
							->leftjoin("category", function($join) use($user_id) {
								$join->on("category.id", "=", "user_keywords.keyword_id")
				                	 ->where("user_keywords.keyword_identity", "1");
				            })
				            ->leftjoin("subcategory",function($sjoin) use($user_id) {
								$sjoin->on("subcategory.id", "=", "user_keywords.keyword_id")
				                	  ->where("user_keywords.keyword_identity", "2");
				            })
				            ->select('user_keywords.*', 'category.category', 'subcategory.subcategory')->get();

				            // dd($client_keywords);
				
		// Get total visible areas
		$area_visibility_info = DB::table('user_area_visibility')->where('user_id', $user_id)->groupby('area')->get();

		//dd($area_visibility_info);
					
		return view('admin.edit_client_area_visibility', array('visible_area' => $area_visibility_info, 'areas' => $areas, 'user_info' => $location_info, 'client_keywords' => $client_keywords));
	}
	
	# Edit client area visibility function
	public function edit_area_visibility(Request $request)
	{
		// Get all selectes areas
		$areas = $request->areas;
		$user_id = $request->this_user;

		/*$keyword_name = $request->keyword_name;
		$temp = explode('_', $keyword_name);
		$keyword_id = $temp[0];
		$keyword_identity = $temp[1];*/
		
		$date = date('Y-m-d H:i:s');
		
		// First check if this user already have another areas or not
		//$exist_areas = DB::table('user_area_visibility')->where(['user_id' => $user_id, 'keyword_id' => $keyword_id, 'keyword_identity' =>$keyword_identity])->get();
		
		// get all exist areas assigned by admin
		$exist_areas = DB::table('user_area_visibility')->where(['user_id' => $user_id])->get();
		
		// delete all assigned area
		if(!empty($exist_areas))
		{
			foreach($exist_areas as $e_key => $e_area)
			{
				// If already exist areas then remove all and after then inser new areas
				$delete_area = DB::table('user_area_visibility')->where('id', $e_area->id)->delete();
			}
		}

		// Get clients all keyword which are approved keyword by admin
		$client_keywords =  DB::table('user_keywords')->where(['user_keywords.user_id' => $user_id, 'user_keywords.status' => 1, 'user_keywords.update_status' => 1])
							->leftjoin("category", function($join) use($user_id) {
								$join->on("category.id", "=", "user_keywords.keyword_id")
				                	 ->where("user_keywords.keyword_identity", "1");
				            })
				            ->leftjoin("subcategory",function($sjoin) use($user_id) {
								$sjoin->on("subcategory.id", "=", "user_keywords.keyword_id")
				                	  ->where("user_keywords.keyword_identity", "2");
				            })
				            ->select('user_keywords.*', 'category.category', 'subcategory.subcategory')->get();

		# Assign area with keyword for client
		if(!empty($client_keywords{0})  && !empty($areas))
		{
			foreach($areas as $a_key => $area)
			{
				// Insert areas in db
				foreach($client_keywords as $key => $keyword)
				{
					// Insert this area in area visible table
					$assign = DB::table('user_area_visibility')->insert([
						'user_id' => $user_id,
						'keyword_id' => $keyword->keyword_id,
						'keyword_identity' => $keyword->keyword_identity,
						'area' => $area,
						'created_at' => $date,
						'updated_at' => $date,
					]);			
				}				
			}

			return redirect('client_area_visibility')->with('status', 'Areas Assigned successfully.');
		}
		else
		{
			return redirect('client_area_visibility')->with('status', 'You do not have any keyword OR area !');
		}
		
	}

	# keyword city visibility
	public function keyword_city_visibility()
	{
		# Get all category
		$categories = DB::table('category')->where('status', 1)->get();

		# Get all sub category
		$subcategories = DB::table('subcategory')->where('status', 1)->get();

		return view('admin.keyword_city_visibility', array('categories' => $categories, 'subcategories' => $subcategories));
	}

	# Edit keyword city visibility page
	public function edit_keyword_city_visibility(Request $request)
	{
		$keyword_id = $request->keyword_id;
		$keyword_identity = $request->keyword_identity;

		# check the keyword is empty or not if empty then redirect to back page
		if(empty($keyword_id) && empty($keyword_identity))
		{
			return redirect('keyword_city_visibility')->with('status', 'Something went wrong. Please try again !');
		}

		# Get keyword info
		if($keyword_identity == 1){
			$table = 'category';
		}
		else{
			$table = 'subcategory';
		}

		$keyword_info = DB::table($table)->where('id', $keyword_id)->first();

		$keyword_info->{'identity'} = $keyword_identity;

		# Get all clients
		$clients =  DB::table('user_location')
					->join('user_keywords', 'user_keywords.user_id', '=', 'user_location.user_id')
					->join('websites_page_head_titles', 'websites_page_head_titles.business_page', '=', 'user_location.user_id')
					->where('user_keywords.status', 1)
					->where('user_keywords.keyword_id', $keyword_id)
					->where('user_keywords.keyword_identity', $keyword_identity)
					->where('user_keywords.update_status', 1)
					->where('user_location.status', 1)
					->get();

		return view('admin.edit_keyword_city_visibility', array('clients' => $clients, 'keyword_info' => $keyword_info));
	}

	# Edit keyword city visibility
	public function edit_city_visibility(Request $request)
	{
		$keyword = $request->this_keyword;
		$keyword_identity = $request->keyword_identity;
		$clients = $request->clients;
		$this_city = $request->this_city;

		# First check client array is empty or not if empty then redirect back to page
		if(empty($clients)){
			return redirect('keyword_city_visibility')->with('status', 'You do not have any client to assign keyword for the selected city !');
		}

		$date = date('Y-m-d H:i:s');

		# first get all clients on this keyword and city
		$exist_clients = DB::table('keyword_city_client_visibility')->where(['keyword' => $keyword, 'keyword_identity' => $keyword_identity, 'city' => $this_city, 'status' => 1])->get();

		# If exist clients available on this keyword and city then first delete them and then insert new clients
		if(!empty($exist_clients))
		{
			foreach ($exist_clients as $key => $exist) {
				$delete = DB::table('keyword_city_client_visibility')->where('id', $exist->id)->delete();
			}
		}

		# Insert new clients on this keyword and city
		foreach ($clients as $key => $client) {
			$insert = DB::table('keyword_city_client_visibility')->insert([
				'keyword' => $keyword,
				'keyword_identity' => $keyword_identity,
				'city' => $this_city,
				'user_id' => $client,
				'status' => 1,
				'created_at' => $date,
				'updated_at' => $date,
			]);
		}

		return redirect('keyword_city_visibility')->with('status', 'Clients Assigned successfully.');
	}

	
}
