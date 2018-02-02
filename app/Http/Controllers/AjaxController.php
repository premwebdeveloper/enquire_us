<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class AjaxController extends Controller
{
    // update_location_info
	public function update_location_info(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;

        $business_name = $request->business_name;
        $building = $request->building;
        $street = $request->street;
        $landmark = $request->landmark;
        $area = $request->area;
        $city = $request->city;
        $pin_code = $request->pin_code;
        $state = $request->state;
        $country = $request->country;

        $basic_info_update = DB::table('user_location')->where('user_id', $user_id)->update(

            array(
                    'business_name' => $business_name,
                    'building' => $building,
                    'street' => $street,
                    'landmark' => $landmark,
                    'area' => $area,
                    'city' => $city,
                    'pincode' => $pin_code,
                    'state' => $state,
                    'country' => $country,
                    'updated_at' => $date,
                    'status' => 1
            )
        );

        $response = array('messager' => 'Update Location Information');

        return response()->json($response);

        exit;
    }  

    // update_contact_info
	public function update_contact_info(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;

        $contact_person = $request->contact_person;
        $landline = $request->landline;
        $mobile = $request->mobile;
        $fax = $request->fax;
        $fax2 = $request->fax2;
        $toll_free = $request->toll_free;
        $toll_free2 = $request->toll_free2;
        $email = $request->email;
        $website = $request->website;

        $basic_info_update = DB::table('user_details')->where('user_id', $user_id)->update(

            array(
                    'name' => $contact_person,
                    'landline' => $landline,
                    'phone' => $mobile,
                    'fax1' => $fax,
                    'fax2' => $fax2,
                    'toll_free1' => $toll_free,
                    'toll_free2' => $toll_free2,
                    'email' => $email,
                    'website' => $website,
                    'updated_at' => $date,
                    'status' => 1
            )
        );

        $response = array('messager' => 'Update Contact Information');

        return response()->json($response);

        exit;
    }
}
