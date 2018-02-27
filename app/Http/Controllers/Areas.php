<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class Areas extends Controller
{
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

        $add_area = DB::table('areas')->insert(
            array('country' => $country, 'state' => $state, 'city' => $city, 'area' => $area, 'created_at' => $date, 'updated_at' => $date)
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

        $add_area = DB::table('areas')->where('id', $id)->update(
            array('country' => $country, 'state' => $state, 'city' => $city, 'area' => $area, 'created_at' => $date, 'updated_at' => $date)
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
}
