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

    // Update other information
	public function update_other_info(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;
        $establishment_year = $request->establishment_year;
        $annual_turnover = $request->annual_turnover;
        $number_employees = $request->number_employees;
        $professional_association = $request->professional_association;
        $certification = $request->certification;
        $from_time = $request->from_time;
        $to_time = $request->to_time;
        $payment_mode = $request->payment_mode;

        if(!empty($payment_mode))
        {
            $payment_mode = implode("|", $payment_mode);
        }
        else
        {
            $payment_mode = '';
        }

        $i = 1;
        $p = 0;
        foreach ($from_time as $from)
        {
            $operation_timing = 1;
            if($i > 7){ $operation_timing = 2; }

            if($i == 1 || $i == 8){ $day = 'monday'; }
            if($i == 2 || $i == 9){ $day = 'tuesday'; }
            if($i == 3 || $i == 10){ $day = 'wednesday'; }
            if($i == 4 || $i == 11){ $day = 'thursday'; }
            if($i == 5 || $i == 12){ $day = 'friday'; }
            if($i == 6 || $i == 13){ $day = 'saturday'; }
            if($i == 7 || $i == 14){ $day = 'sunday'; }

            if($from == 'closed')
            {
                $from = '00:00';
                $working_status = 0;
            }
            else
            {
                $working_status = 1;
            }

            if($to_time[$p] == 'closed')
            {
                $time = '00:00';
            }
            else
            {
                $time = $to_time[$p];
            }

            $where = ['user_id' => $user_id, 'operation_timing' => $operation_timing, 'day' => $day];

            DB::table('user_other_information')
                ->where($where)
                ->update(
                    array(
                        'from_time' => $from,
                        'to_time' => $time,
                        'working_status' => $working_status,
                        'updated_at' => $date
                    )
            );
            $i++;
            $p++;
        }

        $other_info_update = DB::table('user_company_information')->where('user_id', $user_id)->update(
            array(
                'payment_mode' => $payment_mode,
                'year_establishment' => $establishment_year,
                'annual_turnover' => $annual_turnover,
                'no_of_emps' => $number_employees,
                'professional_associations' => $professional_association,
                'certifications' => $certification,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $response = array('message' => 'Update other information successfully');

        return response()->json($response);

        exit;
    }


    public function getStateByCountryForUser(Request $request)
    {
        $country = $request->country;

        // Get all districts of this state
        $states = DB::table('states')->where('country_id', $country)->get();

        return response()->json($states);
    }

    public function getStateByStateForUser(Request $request)
    {
        $state = $request->state;

        // Get all districts of this state
        $cities = DB::table('cities')->where('state_id', $state)->get();

        return response()->json($cities);
    }
}
