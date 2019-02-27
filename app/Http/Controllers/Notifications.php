<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Storage;
use Auth;

class Notifications extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get
    public function information_update_notifications(Request $request){
    	   
        $type = $request->type;

        // Get notification with relavent status
        $notifications = DB::table('admin_approvals_for_updates as aafu')->where(['aafu.status' =>  $type, 'aafu.notification_status' => 1])
            ->join('employees as emp', 'emp.user_id',  '=', 'aafu.update_by')
            ->join('user_location as ul', 'ul.user_id', '=', 'aafu.client_uid')
            ->select('aafu.*', 'ul.business_name', 'emp.name as update_by_emp', 'emp.phone as update_by_phone')
            ->get();
          
        return view('notifications.index', array('notifications' => $notifications));
    }

    // Admin approves updates for clients
    public function admin_approval_for_updates(Request $request){

        $row_id = $request->row_id;
        $client_uid = $request->client_uid;
        $status = $request->status;

        // Get updates by row id
        $information = DB::table('admin_approvals_for_updates')->where('id', $row_id)->first();

        $fields_for_updation = json_decode($information->fields);

        // If updates for basic information
        if($status == 1){

            $user_details = DB::table('user_details')->where('user_id', $client_uid)->first();
            $user_location = DB::table('user_location')->where('user_location.user_id', $client_uid)->join('areas', 'areas.id', '=', 'user_location.area')->join('cities', 'cities.id', '=', 'user_location.city')->select('user_location.*', 'areas.area as area_name', 'cities.name as city_name')->first();
            $user_keywords = DB::table('user_keywords')->where('user_id', $client_uid)->get();

            $new_user_location = array();
            $new_user_details = array();
            $new_user_location = array();

            if($user_location->business_name != $fields_for_updation->company_name){
                    
                $new_user_location['business_name'] = $fields_for_updation->company_name;
            }

            if($user_details->name != $fields_for_updation->name){
                    
                $new_user_details['name'] = $fields_for_updation->name;
            }

            if($user_details->phone != $fields_for_updation->phone){
                
                $new_user_details['phone'] = $fields_for_updation->phone;
            }

            if($user_location->building != $fields_for_updation->building){
                
                $new_user_location['building'] = $fields_for_updation->building;
            }

            if($user_location->street != $fields_for_updation->street){
               
                $new_user_location['street'] = $fields_for_updation->street;
            }

            if($user_location->landmark != $fields_for_updation->landmark){
              
                $new_user_location['landmark'] = $fields_for_updation->landmark;
            }

            if($user_location->country != $fields_for_updation->country){
              
                $new_user_location['country'] = $fields_for_updation->country;
            }

            if($user_location->state != $fields_for_updation->state){
                
                $new_user_location['state'] = $fields_for_updation->state;
            }

            if($user_location->city != $fields_for_updation->city){
            
                $new_user_location['city'] = $fields_for_updation->city;
            }

            if($user_location->area != $fields_for_updation->area){
            
                $new_user_location['area'] = $fields_for_updation->area;
            }

            if($user_location->pincode != $fields_for_updation->pin_code){
                
                $new_user_location['pincode'] = $fields_for_updation->pin_code;
            }

            if($user_details->mobile != $fields_for_updation->mobile){
                
                $new_user_details['mobile'] = $fields_for_updation->mobile;
            }

            if($user_details->whatsapp != $fields_for_updation->whatsapp){
            
                $new_user_details['whatsapp'] = $fields_for_updation->whatsapp;
            }

            if($user_details->landline != $fields_for_updation->landline){
            
                $new_user_details['landline'] = $fields_for_updation->landline;
            }

            if($user_details->toll_free1 != $fields_for_updation->toll_free){
            
                $new_user_details['toll_free1'] = $fields_for_updation->toll_free;
            }

            if($user_details->about_company != $fields_for_updation->about_company){
            
                $new_user_details['about_company'] = $fields_for_updation->about_company;
            }

            if($user_details->website != $fields_for_updation->website){
            
                $new_user_details['website'] = $fields_for_updation->website;
            }

            // If new keywords submitted for update then get keyword names
            if(isset($fields_for_updation->keyword)):

                foreach ($fields_for_updation->keyword as $key => $row) {
                    
                    $temp = explode('-', $row);
                    $insert = DB::table('user_keywords')->insert([

                        'user_id' => $client_uid,
                        'keyword_id' => $temp[0],
                        'keyword_identity' => $temp[1],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'update_status' => 1,
                        'status' => 1
                    ]);
                }
            endif;

            // Update user details
            if(!empty($new_user_details)){

                $update_u_details = DB::table('user_details')->where('user_id', $client_uid)->update($new_user_details);
            }
            
            // Update user details
            if(!empty($new_user_location)){

                $update_u_location = DB::table('user_location')->where('user_id', $client_uid)->update($new_user_location);
            }


            $update_notify_status = DB::table('admin_approvals_for_updates')->where('id', $row_id)->update([

                'notification_status' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if($update_notify_status){

                $message = 'Basic information updated successfully.';
            }
            
            return redirect('information_update_notifications/'.$status)->with('status', $message);


        // If updates for payment modes
        }elseif($status == 2){

            $user_company_information = DB::table('user_company_information')->where('user_id', $client_uid)->first();

            $update_fields = array();
            if($fields_for_updation->establishment_year != $user_company_information->year_establishment){

                $update_fields['year_establishment'] = $fields_for_updation->establishment_year;
            }

            if($fields_for_updation->annual_turnover != $user_company_information->annual_turnover){

                $update_fields['annual_turnover'] = $fields_for_updation->annual_turnover;
            }

            if($fields_for_updation->number_employees != $user_company_information->no_of_emps){

                $update_fields['no_of_emps'] = $fields_for_updation->number_employees;
            }

            if($fields_for_updation->professional_association != $user_company_information->professional_associations){

                $update_fields['professional_associations'] = $fields_for_updation->professional_association;
            }

            if($fields_for_updation->certification != $user_company_information->certifications){

                $update_fields['certifications'] = $fields_for_updation->certification;
            }

            if($fields_for_updation->payment_mode != $user_company_information->payment_mode){

                $update_fields['payment_mode'] = $fields_for_updation->payment_mode;
            }

            $update= DB::table('user_company_information')->where('user_id', $client_uid)->update($update_fields);

            $update_notify_status = DB::table('admin_approvals_for_updates')->where('id', $row_id)->update([

                'notification_status' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if($update_notify_status){

                $status = 'Payment mode information updated successfully.';
            }
            
            return redirect('information_update_notifications/'.$status)->with('status', $status);

        // If updates for business timing
        }elseif($status == 3){

            $user_other_information = DB::table('user_other_information')->where('user_id', $client_uid)->get();

            $user_other_information = json_decode(json_encode($user_other_information), True);

            $old_from_time = array_column($user_other_information, 'from_time');
            $old_to_time = array_column($user_other_information, 'to_time');
            
            // Match from time 
            for ($i=0; $i < count($fields_for_updation->from_time); $i++) { 
                
                if($fields_for_updation->from_time[$i] != $old_from_time[$i]):

                    $changes_exist = 1;
                endif;
            }

            // Match to time 
            for ($i=0; $i < count($fields_for_updation->to_time); $i++) { 
                
                if($fields_for_updation->to_time[$i] != $old_to_time[$i]){

                    $changes_exist = 1;
                }
            }

            if($changes_exist == 1):

                if(!empty($fields_for_updation->from_time)){
                    $i = 1;
                    $p = 0;
                    foreach ($fields_for_updation->from_time as $from)
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

                        if($from == 'closed') {
                            $from = '00:00';
                            $working_status = 0;
                        } else {
                            $working_status = 1;
                        }

                        if($fields_for_updation->to_time[$p] == 'closed') {
                            $time = '00:00';
                        } else {
                            $time = $fields_for_updation->to_time[$p];
                        }

                        $where = ['user_id' => $client_uid, 'operation_timing' => $operation_timing, 'day' => $day];

                        DB::table('user_other_information')->where($where)->update(
                            array(
                                'from_time' => $from,
                                'to_time' => $time,
                                'working_status' => $working_status,
                                'updated_at' => date('Y-m-d H:i:s')
                            )
                        );
                        $i++;
                        $p++;
                    }
                }

                $update_notify_status = DB::table('admin_approvals_for_updates')->where('id', $row_id)->update([

                    'notification_status' => 0,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                if($update_notify_status){


                    $message = 'Business timing information updated successfully.';
                }
                
                return redirect('information_update_notifications/'.$status)->with('status', $message);
                    
            endif;

        // If updates for images and logo
        }elseif($status == 4){

            $user_images = DB::table('user_images')->where('user_id', $client_uid)->get();
            $user_details = DB::table('user_details')->where('user_id', $client_uid)->first();
           
            // Get client new profile images
            foreach ($fields_for_updation as $f_key => $new_image) {
                
                if(isset($new_image->photos)){

                    $new_p_images = $new_image->photos;
                    $create_new = DB::table('user_images')->insert([

                        'user_id' => $client_uid,
                        'image' => $new_p_images,
                        'update_status' => 1,
                        'status' => 1,
                    ]);
                }
            }
            
            // update logo for this client
            $update_logo = DB::table('user_details')->where('user_id', $client_uid)->update([

                'logo' => $fields_for_updation->logo,
                'updated_at' => date('Y-m-d H:i:s')
            ]); 

            $update_notify_status = DB::table('admin_approvals_for_updates')->where('id', $row_id)->update([

                'notification_status' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if($update_notify_status){


                $message = 'Client Logo and Profile Images updated successfully.';
            }
            
            return redirect('information_update_notifications/'.$status)->with('status', $message);

        }
    }
}
