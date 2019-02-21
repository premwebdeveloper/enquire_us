<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddUserValidation;
use App\User;
use Illuminate\Http\Request;
use DB;
use Storage;
use Auth;

class AdminUsers extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
    }

    // View All User
    public function index()
    {
        # Get All Users
        $users = DB::table('user_details')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->join('user_keywords', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->leftjoin('category', 'category.id', '=', 'user_keywords.keyword_id')
                ->leftjoin('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                ->join('areas', 'areas.id', '=', 'user_location.area')
                ->join('cities', 'cities.id', '=', 'user_location.city')
                ->where('user_details.status', '!=', 0)
                //->where('user_keywords.keyword_identity', '=', 1)
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.state', 'user_location.country', 'user_location.pincode', 'category.category', 'areas.area as area_name', 'cities.name as city_name')
                ->groupBy('user_id')
                ->get();
        //dd($users);
        return view('admin_users.index', array('users' => $users));
    }

    // Show un approved users to admin console
    public function un_approved_users(){

        Auth::user()->id;

        # Get All Users
        $users = DB::table('user_details')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->join('areas', 'areas.id', '=', 'user_location.area')
                ->join('cities', 'cities.id', '=', 'user_location.city')
                ->join('users', 'users.id', '=', 'user_details.created_by')
                //->leftjoin('user_keywords', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->where('user_details.status', '=', 0)
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.state', 'user_location.country', 'user_location.pincode', 'areas.area as area_name', 'cities.name as city_name', 'users.name as created_by_name', 'users.phone as created_by_phone')
                ->orderBy('user_details.id', 'desc')
                ->get();
            foreach ($users as $key => $user) {
                
                $keywords = DB::table('user_keywords')->where(['user_id' => $user->user_id, "status" => 1])->first();
                if(!empty($keywords))
                {
                    $users[$key]->keyword_exit = 1;
                }
                else{
                    $users[$key]->keyword_exit = 0;   
                }
            }
            //exit;
        return view('admin_users.un_approved_users', array('users' => $users));
        
    }

    // Update user status / approve and unapprove user with status
    public function updateUserStatus(Request $request){

        $user_id = $request->user_id;

        // Approve user in users table
        $update = User::where(['id'=>$user_id])->update(['status' => '1']);

        // Approve in user details table
        $details = DB::table('user_details')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

        // Approve in user_location table
        $locations = DB::table('user_location')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

        // If logged in user is admin then create 25 feedback rating for this client 
        if(Auth::user()->id == 1){

            $default_feedbacks = array();

            $rating = array('4.1', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.8', '4.9', '5.0', '4.6', '4.7', '4.8', '4.9', '5.0');

            $feedback = array('Nice','Good','Perfect','I would like to thank you for the excellent coordination..','I would like to take this service again and again from you only.','Thank you for all your help. Your service was excellent and very FAST.','Many thanks for you kind and efficient service. I have already and will definitely continue to recommend your services to others in the future. Wishing you all a lovely day and weekend','I was very impressed with your service and shall recommend it to others.......','Best Service provider','Perfect One','Very good service','I personally tried his service and it was perfect.'
            );

            $names = array("Aadhya", "Gaurav", "Ananya", "Ankita", "Diya", "Riya", "Aarohi", "Kyra", "Aarav", "Vivaan", "Ananya", "Advik", "Kabir", "Anaya", "Aarav", "Aditya", "Arjun", "Ramesh", "Reyansh", "Mohammed", "Suresh", "Arnav", "Aayan", "Krishna", "Ishaan", "Shaurya", "Atharva", "Sanjay", "Pranav", "vijay", "Aaryan", "Dhruv", "Amit", "Ritvik", "Aarush", "Prem", "Darsh", "Ravi", "Sunil", "Rishabh", "Mukesh", "Rajesh", "Akshay", "Manish", "Gulshan", "Kunal", "Dipanshu", "Aaradhya", "Pradeep", "Mahendra", "Manoj", "Dharmendra", "Anshul", "Hridya");

            $emails = array("Aadhya@gmail.com", "Gaurav@gmail.com", "Ananya@gmail.com", "Ankita@gmail.com", "Diya@gmail.com", "Riya@gmail.com", "Aarohi@gmail.com", "Kyra@gmail.com", "Aarav@gmail.com", "Vivaan@gmail.com", "Ananya@gmail.com", "Advik@gmail.com", "Kabir@gmail.com", "Anaya@gmail.com", "Aarav@gmail.com", "Aditya@gmail.com", "Arjun@gmail.com", "Ramesh@gmail.com", "Reyansh@gmail.com", "Mohammed@gmail.com", "Suresh@gmail.com", "Arnav@gmail.com", "Aayan@gmail.com", "Krishna@gmail.com", "Ishaan@gmail.com", "Shaurya@gmail.com", "Atharva@gmail.com", "Sanjay@gmail.com", "Pranav@gmail.com", "vijay@gmail.com", "Aaryan@gmail.com", "Dhruv@gmail.com", "Amit@gmail.com", "Ritvik@gmail.com", "Aarush@gmail.com", "Prem@gmail.com", "Darsh@gmail.com", "Ravi@gmail.com", "Sunil@gmail.com", "Rishabh@gmail.com", "Mukesh@gmail.com", "Rajesh@gmail.com", "Akshay@gmail.com", "Manish@gmail.com", "Gulshan@gmail.com", "Kunal@gmail.com", "Dipanshu@gmail.com", "Aaradhya@gmail.com", "Pradeep@gmail.com", "Mahendra@gmail.com", "Manoj@gmail.com", "Dharmendra@gmail.com", "Anshul@gmail.com", "Hridya@gmail.com");

            $numbers = array('25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35');
            $random_numbers = array_rand($numbers, 3);
            $times = $numbers[$random_numbers[0]];
            
            $name_email = array();

            for ($i=0; $i < $times; $i++) { 

                $all_names = array_column($name_email, 'name');
                            
                if(!in_array($names[$i], $all_names)){

                    $name_email[$i]['name'] = $names[$i];
                    $name_email[$i]['email'] = $emails[$i];
                }
            }

            $name_email = array_values($name_email);

            for ($i=0; $i < count($name_email); $i++) { 

                $random_rating = array_rand($rating, 3);
                $random_feedback = array_rand($feedback, 3);
                
                $default_feedbacks[$i]['rating'] = $rating[$random_rating[0]];
                $default_feedbacks[$i]['feedback'] = $feedback[$random_feedback[0]];
                $default_feedbacks[$i]['names'] = $name_email[$i];      
            }

            foreach ($default_feedbacks as $key => $value) {
                
                $create = DB::table('client_reviews')->insert([

                    'client_uid' => $user_id,
                    'name' => $value['names']['name'],
                    'email' => $value['names']['email'],
                    'review' => $value['feedback'],
                    'rating' => $value['rating'],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        if($locations):

            $status = 'User approved successfully.';
        else:
            $status = 'Something went wrong!';
        endif;

        return redirect('un_approved_users')->with(['status' => $status]);
    }

    // Delete User
    public function deleteUser(Request $request){

        $user_id = $request->user_id;

        // Approve user in users table
        $update = User::where(['id'=>$user_id])->update(['status' => '1']);

        // Approve in user details table
        $details = DB::table('user_details')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

        // Approve in user_location table
        $locations = DB::table('user_location')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

        if($locations):

            $status = 'User approved successfully.';
        else:
            $status = 'Something went wrong!';
        endif;

        return redirect('un_approved_users')->with(['status' => $status]);
    }

    // add new User Basic Information view page
    public function addUser_basic_information(Request $request)
    {
        // Create direct links
        $basic_information_link = 'addUser_basic_information';
        $payment_modes_link     = 'addUser_payment_modes';
        $business_timing_link   = 'addUser_business_timing';
        $logo_images_link       = 'addUser_logo_images';

        return view('admin_users.addUser_basic_information', array('basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link));    
    }

    // Edit User Basic Information view page
    public function edit_user_basic_information(Request $request)
    {
        $user_id = $request->user_id;

        // Get basic / location / company information
        $query = DB::table('user_details as ud')
            ->join('user_location as ul', 'ud.user_id', '=', 'ul.user_id')
            ->join('user_company_information as uci', 'ud.user_id', '=', 'uci.user_id')
            ->join('cities', 'cities.id', '=', 'ul.city')
            ->join('areas', 'areas.id', '=', 'ul.area')
            ->select('ud.*', 'ul.business_name', 'ul.building', 'ul.street', 'ul.landmark', 'ul.area', 'ul.city', 'ul.pincode', 'ul.state', 'ul.country', 'uci.payment_mode', 'uci.payment_mode', 'uci.year_establishment', 'uci.annual_turnover', 'uci.no_of_emps', 'uci.professional_associations', 'uci.certifications', 'cities.name as city_name', 'areas.area as area_name')
            ->where('ud.user_id', '=', $user_id);

        $user_details = $query->first();

        // Get user business keywords
        $where = array('user_id' => $user_id, 'status' => 1);
        $keywords = DB::table('user_keywords')->where($where)->get();
        $saved_keywords = '';
        foreach ($keywords as $key => $words)
        {
            if($words->keyword_identity == 1)
            {
                $category = DB::table('category')->where('id', $words->keyword_id)->first();
                $saved_keywords .= '<div class="col-md-6 keywords p0" id="keyword_'.$category->id.'_1">'.$category->category.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" id="delete_'.$category->id.'_1"></i></div>';
            }
            else
            {
                $subcategory = DB::table('subcategory')->where('id', $words->keyword_id)->first();
                $saved_keywords .= '<div class="col-md-6 keywords p0" id="keyword_'.$subcategory->id.'_2">'.$subcategory->subcategory.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" id="delete_'.$subcategory->id.'_2"></i></div>';
            }
        }
        
        // Create direct links
        $basic_information_link = 'edit_user_basic_information';
        $payment_modes_link     = 'edit_user_payment_modes';
        $business_timing_link   = 'edit_user_business_timing';
        $logo_images_link       = 'edit_user_logo_images';

        return view('admin_users.addUser_basic_information', array('user_details' => $user_details, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link, 'saved_keywords' => $saved_keywords));
    }

    // Add new user basic information
    public function add_user(AddUserValidation $request)
    {
        $date                  = date('Y-m-d H:i:s');        
        $current_location      = $request->current_location;        
        /*Basic Detail*/
        $company_name          = $request->company_name;
        $name                  = $request->name;
        $phone                 = $request->phone;
        $email                 = $request->email;
        $password              = $request->password;
        $password_confirmation = $request->password_confirmation;

        /*Location Detail*/
        //$business_name = $request->business_name;
        $building = $request->building;
        $street   = $request->street;
        $landmark = $request->landmark;
        $area     = $request->area;
        $city     = $request->city;
        $pin_code = $request->pin_code;
        $state    = $request->state;
        $country  = $request->country;

        /*Contact Detail*/
        $mobile        = $request->mobile;
        $whatsapp      = $request->whatsapp;
        $landline      = $request->landline;
        $toll_free     = $request->toll_free;
        $website       = $request->website;
        $about_company = $request->about_company;
        $password      = bcrypt($password);

        // Get selected keyword
        $keyword = $request->keyword;

        $suggest_keyword = $request->suggest_keyword;

        // If keyword and suggested keyword both are blank then hit error and redirect to back
        if(empty($keyword) && empty($suggest_keyword)){

            $status = 'You have to select any keyword OR suggest any keyword for this client !';
            return redirect()->route('addUser_basic_information')->with('status', $status);
        }

        // Create User
        $user = DB::table('users')->insert(
            array(
                'name'       => $name,
                'email'      => $email,
                'phone'      => $phone,
                'password'   => $password,
                'created_at' => $date,
                'updated_at' => $date,
                'status'     => (Auth::user()->id == 1)? 1 : 0
            )
        );

        $user_id = DB::getPdo()->lastInsertId();

        // If logged in user is admin then create 25 feedback rating for this client 
        if(Auth::user()->id == 1){

            $default_feedbacks = array();

            $rating = array('4.1', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.8', '4.9', '5.0', '4.6', '4.7', '4.8', '4.9', '5.0');

            $feedback = array('Nice','Good','Perfect','I would like to thank you for the excellent coordination..','I would like to take this service again and again from you only.','Thank you for all your help. Your service was excellent and very FAST.','Many thanks for you kind and efficient service. I have already and will definitely continue to recommend your services to others in the future. Wishing you all a lovely day and weekend','I was very impressed with your service and shall recommend it to others.......','Best Service provider','Perfect One','Very good service','I personally tried his service and it was perfect.'
            );

            $names = array("Aadhya", "Gaurav", "Ananya", "Ankita", "Diya", "Riya", "Aarohi", "Kyra", "Aarav", "Vivaan", "Ananya", "Advik", "Kabir", "Anaya", "Aarav", "Aditya", "Arjun", "Ramesh", "Reyansh", "Mohammed", "Suresh", "Arnav", "Aayan", "Krishna", "Ishaan", "Shaurya", "Atharva", "Sanjay", "Pranav", "vijay", "Aaryan", "Dhruv", "Amit", "Ritvik", "Aarush", "Prem", "Darsh", "Ravi", "Sunil", "Rishabh", "Mukesh", "Rajesh", "Akshay", "Manish", "Gulshan", "Kunal", "Dipanshu", "Aaradhya", "Pradeep", "Mahendra", "Manoj", "Dharmendra", "Anshul", "Hridya");

            $emails = array("Aadhya@gmail.com", "Gaurav@gmail.com", "Ananya@gmail.com", "Ankita@gmail.com", "Diya@gmail.com", "Riya@gmail.com", "Aarohi@gmail.com", "Kyra@gmail.com", "Aarav@gmail.com", "Vivaan@gmail.com", "Ananya@gmail.com", "Advik@gmail.com", "Kabir@gmail.com", "Anaya@gmail.com", "Aarav@gmail.com", "Aditya@gmail.com", "Arjun@gmail.com", "Ramesh@gmail.com", "Reyansh@gmail.com", "Mohammed@gmail.com", "Suresh@gmail.com", "Arnav@gmail.com", "Aayan@gmail.com", "Krishna@gmail.com", "Ishaan@gmail.com", "Shaurya@gmail.com", "Atharva@gmail.com", "Sanjay@gmail.com", "Pranav@gmail.com", "vijay@gmail.com", "Aaryan@gmail.com", "Dhruv@gmail.com", "Amit@gmail.com", "Ritvik@gmail.com", "Aarush@gmail.com", "Prem@gmail.com", "Darsh@gmail.com", "Ravi@gmail.com", "Sunil@gmail.com", "Rishabh@gmail.com", "Mukesh@gmail.com", "Rajesh@gmail.com", "Akshay@gmail.com", "Manish@gmail.com", "Gulshan@gmail.com", "Kunal@gmail.com", "Dipanshu@gmail.com", "Aaradhya@gmail.com", "Pradeep@gmail.com", "Mahendra@gmail.com", "Manoj@gmail.com", "Dharmendra@gmail.com", "Anshul@gmail.com", "Hridya@gmail.com");

            $numbers = array('25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35');
            $random_numbers = array_rand($numbers, 3);
            $times = $numbers[$random_numbers[0]];
            
            $name_email = array();

            for ($i=0; $i < $times; $i++) { 

                $all_names = array_column($name_email, 'name');
                            
                if(!in_array($names[$i], $all_names)){

                    $name_email[$i]['name'] = $names[$i];
                    $name_email[$i]['email'] = $emails[$i];
                }
            }

            $name_email = array_values($name_email);

            for ($i=0; $i < count($name_email); $i++) { 

                $random_rating = array_rand($rating, 3);
                $random_feedback = array_rand($feedback, 3);
                
                $default_feedbacks[$i]['rating'] = $rating[$random_rating[0]];
                $default_feedbacks[$i]['feedback'] = $feedback[$random_feedback[0]];
                $default_feedbacks[$i]['names'] = $name_email[$i];      
            }

            foreach ($default_feedbacks as $key => $value) {
                
                $create = DB::table('client_reviews')->insert([

                    'client_uid' => $user_id,
                    'name' => $value['names']['name'],
                    'email' => $value['names']['email'],
                    'review' => $value['feedback'],
                    'rating' => $value['rating'],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        // insert created by user location
        $user_role = DB::table('created_by_user_location')->insert(
            array(
                'user_id'         => $user_id,
                'created_by_user' => Auth::user()->id,
                'location'        => $current_location,
                'created_at'      => $date
            )
        );

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id'    => 2,
                'user_id'    => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id'       => $user_id,
                'name'          => $name,
                'email'         => $email,
                'phone'         => $phone,
                'mobile'        => $mobile,
                'whatsapp'      => $whatsapp,
                'landline'      => $landline,
                'toll_free1'    => $toll_free,
                'website'       => $website,
                'about_company' => $about_company,
                'created_by'    => Auth::user()->id,
                'created_at'    => $date,
                'updated_at'    => $date,
                'status'        => (Auth::user()->id == 1)? 1 : 0,
                'status'        => (Auth::user()->id == 1)? 1 : 0
            )
        );

        // Create User Location
        $user_details = DB::table('user_location')->insert(
            array(
                'user_id'       => $user_id,
                'business_name' => $company_name,
                'building'      => $building,
                'street'        => $street,
                'landmark'      => $landmark,
                'area'          => $area,
                'city'          => $city,
                'pincode'       => $pin_code,
                'state'         => $state,
                'country'       => $country,
                'created_at'    => $date,
                'updated_at'    => $date,
                'update_status' => (Auth::user()->id == 1)? 1 : 0,
                'status'        => (Auth::user()->id == 1)? 1 : 2
            )
        );

        // Create user keywords if user keyword is assigned
        if(!empty($keyword)){
            foreach ($keyword as $key => $word) {
                $temp = explode("-", $word);
                $keyword_id = $temp[0];
                $key_identity = $temp[1];

                $insert = DB::table('user_keywords')->insert([
                    'user_id' => $user_id,
                    'keyword_id' => $keyword_id,
                    'keyword_identity' => $key_identity,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'update_status' => 1,
                    'status' => 1
                ]);
            }
        }

        // If suggested keyword is not empty then insert suggested keyword with user is
        if(!empty($suggest_keyword)){

            // Loop all suggested keywords
            foreach ($suggest_keyword as $key => $suggested) {
                
                // Save new suggested category
                $save = DB::table('category_suggestions')->insert([

                    'user_id'    => Auth::user()->id,
                    'client_uid' => $user_id,
                    'category'   => $suggested,
                    'status'     => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }

        // Create User Other Information
        for($i = 0; $i <= 13; $i++)
        {
            $operation_timing = 1;
            if($i > 6) { $operation_timing = 2; }

            if($i == 0 || $i == 7){ $day = 'monday'; }
            if($i == 1 || $i == 8){ $day = 'tuesday'; }
            if($i == 2 || $i == 9){ $day = 'wednesday'; }
            if($i == 3 || $i == 10){ $day = 'thursday'; }
            if($i == 4 || $i == 11){ $day = 'friday'; }
            if($i == 5 || $i == 12){ $day = 'saturday'; }
            if($i == 6 || $i == 13){ $day = 'sunday'; }

            $user_details = DB::table('user_other_information')->insert(
                array(
                    'user_id' => $user_id,
                    'operation_timing' => $operation_timing,
                    'day' => $day,
                    'from_time' => '10:00:00',
                    'to_time' => '19:00:00',
                    'working_status' => '1',
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 1
                )
            );
        }

        // Create User Company Information
        $user_details = DB::table('user_company_information')->insert(
            array(
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        // get area name by area id
        $area_info = DB::table('areas')->where('id', $area)->first();
        $area_name = $area_info->area;

        $title = $company_name.' in '.$area_name;
        $keyword = $company_name.' in '.$area_name;
        $description = $company_name.' in '.$area_name;

        $company_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $company_name);
        $area_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $area_name);

        $page_url = $company_name.'-in-'.$area_name;

        // Create parameters
        $params = $user_id.'-3-'.$city.'-'.$area;
        $encrypted = base64_encode($params);

        $basic_info_update = DB::table('websites_page_head_titles')->insert([
            'city' => $city,
            'area' => $area,
            'business_page' => $user_id,
            'page_url' => $page_url,
            'encoded_params' => $encrypted,
            'title' => $title,
            'keyword' => $keyword,
            'description' => $description,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($user_details)
        {
            $status = 'Add User Basic Informations Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect()->route('addUser_payment_modes', ['user_id' => $user_id])->with('status', $status);
    }

    // Edit user basic information
    public function update_admin_user(Request $request)
    {
        $approval = array();
        $date = date('Y-m-d H:i:s');

        // If update client information by autocomplete search then get client uid
        $client_uid = $request->client_uid;

        // If client edit in proper way then get client uid as user uid
        $user_id = $request->user_id;

        // If user id is not  available then create client uid = user id
        if(!$user_id){

            $user_id = $client_uid;
        }
                
        // Basic Detail
        $email                     = $request->email;
        $password                  = $request->password;
        $password_confirmation     = $request->password_confirmation;

        $approval['company_name']  = $company_name  = $request->company_name;
        $approval['name']          = $name          = $request->name;
        $approval['phone']         = $phone         = $request->phone;
        
        // location information
        $approval['building']      = $building      = $request->building;
        $approval['street']        = $street        = $request->street;
        $approval['landmark']      = $landmark      = $request->landmark;
        $approval['area']          = $area          = $request->area;
        $approval['city']          = $city          = $request->city;
        $approval['pin_code']      = $pin_code      = $request->pin_code;
        $approval['state']         = $state         = $request->state;
        $approval['country']       = $country       = $request->country;
        
        // Contact Detail
        $approval['mobile']        = $mobile        = $request->mobile;
        $approval['whatsapp']      = $whatsapp      = $request->whatsapp;
        $approval['landline']      = $landline      = $request->landline;
        $approval['toll_free']     = $toll_free     = $request->toll_free;        
        $approval['website']       = $website       = $request->website;
        $approval['about_company'] = $about_company = $request->about_company;

        $keyword = $request->keyword;
        $suggest_keyword = $request->suggest_keyword;

        // If client information updated from add user page by using autocomplete AND logged in user is not admin
        if(Auth::user()->id != 1){

            // First check if the keyword is already assigned to client then hit error
            if(!empty($keyword)){
                foreach ($keyword as $key => $word) {
                    $temp = explode("-", $word);
                    $keyword_id = $temp[0];
                    $key_identity = $temp[1];

                    // Get old keywords to match current keywords
                    $where = array('user_id' => $user_id, 'status' => 1, 'keyword_id' => $keyword_id, 'keyword_identity' => $key_identity);
                    $exist = DB::table('user_keywords')->where($where)->first();
                    
                    if(!empty($exist))
                    {
                        // Keyword already found
                        $status = 'Selected keywords are already assigned to client! Please select another.';
                        return redirect()->route('edit_user_basic_information', ['user_id' => $user_id])->with('status', $status); 
                    }
                }
            }

            // First check if this keyword is already exist or not
            if(!empty($keyword)){                
                $approval['keyword'] = $keyword;
            }

            $approval = json_encode($approval);

            // Insert all the information in json format for admin approval
            $insert = DB::table('admin_approvals_for_updates')->insert([

                'update_by'           => Auth::user()->id,
                'client_uid'          => $user_id,
                'fields'              => $approval,
                'notification_status' => 1,
                'status'              => 1,
                'created_at'          => $date,
                'updated_at'          => $date,
            ]);

            if($insert)
            {
                $status = 'Request for update information submitted successfully.All will be effective after admin approval';
            }
            else
            {
                $status = 'Something went wrong !';
            }

        }else{
            // If logged user is admin then update client information direct
            // Save updated information in admin approvals for update table

            // Create User
            $user = DB::table('users')->where('id', $user_id)->update(
                array(
                    'name' => $name,
                    'phone' => $phone,
                    'updated_at' => $date,
                    'status' => 1
                )
            );

            // Create User Details
            $user_details = DB::table('user_details')->where('user_id', $user_id)->update(
                array(
                    'name' => $name,
                    'phone' => $phone,
                    'mobile' => $mobile,
                    'whatsapp' => $whatsapp,
                    'landline' => $landline,
                    'toll_free1' => $toll_free,
                    'website' => $website,
                    'about_company' => $about_company,
                    'updated_at' => $date,
                    'status' => 1
                )
            );

            // Create User Location
            $user_details = DB::table('user_location')->where('user_id', $user_id)->update(
                array(
                    'business_name' => $company_name,
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

            // First check if this keyword is already exist or not
            if(!empty($keyword)){
                foreach ($keyword as $key => $word) {
                    $temp = explode("-", $word);
                    $keyword_id = $temp[0];
                    $key_identity = $temp[1];

                    // Get old keywords to match current keywords
                    $where = array('user_id' => $user_id, 'status' => 1, 'keyword_id' => $keyword_id, 'keyword_identity' => $key_identity);
                    $exist = DB::table('user_keywords')->where($where)->first();
                    
                    if(!empty($exist))
                    {
                        // Keyword already found
                        $status = 'User information updated successfully. But selected keywords are already assigned !';
                        return redirect()->route('edit_user_basic_information', ['user_id' => $user_id])->with('status', $status); 
                    }
                }
            
                // Insert keywords in database table If all is well
                foreach ($keyword as $key => $word) {
                    $temp = explode("-", $word);
                    $keyword_id = $temp[0];
                    $key_identity = $temp[1];

                    $insert = DB::table('user_keywords')->insert([
                        'user_id'          => $user_id,
                        'keyword_id'       => $keyword_id,
                        'keyword_identity' => $key_identity,
                        'created_at'       => $date,
                        'updated_at'       => $date,
                        'update_status'    => 0,
                        'status'           => 1
                    ]);
                }
            }

            if($user_details)
            {
                $status = 'Update User Basic Informations Successfully.';
            }
            else
            {
                $status = 'Something went wrong !';
            }
        }

        /* *************************************************************************************************** */
        // Get selected keyword        
        // If suggested keyword is not empty then insert suggested keyword with user is
        if(!empty($suggest_keyword[0]) && !is_null($suggest_keyword[0])){

            // Loop all suggested keywords
            foreach ($suggest_keyword as $key => $suggested) {
                
                // Save new suggested category
                $save = DB::table('category_suggestions')->insert([

                    'user_id'    => Auth::user()->id,
                    'client_uid' => $user_id,
                    'category'   => $suggested,
                    'status'     => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
        // END suggested Keyword section
        /* ********************************************************************************************************** */

        return redirect()->route('edit_user_payment_modes', ['user_id' => $user_id])->with('status', $status);
    }

    // ADD new User Update Payment Modes
    public function addUser_payment_modes(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $second_param = $request->second_param;
        $user_id = $request->user_id;        
        $check_validation = $request->check_validation;
        $establishment_year = $request->establishment_year;
        $annual_turnover = $request->annual_turnover;
        $number_employees = $request->number_employees;
        $professional_association = $request->professional_association;
        $certification = $request->certification;
        $from_time = $request->from_time;
        $to_time = $request->to_time;
        $payment_mode = $request->payment_mode;

        if(!empty($user_id) && !empty($check_validation))
        {
            if(!empty($payment_mode))
            {
                $payment_mode = implode("|", $payment_mode);
            }
            else
            {
                $payment_mode = '';
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
            
            if($other_info_update)
            {
                $status = 'Add Payment Modes Information Successfully.';
            }
            else
            {
                $status = 'Something went wrong !';
            }

            return redirect()->route('addUser_business_timing', ['user_id' => $user_id]);
        }
        else
        {
            // addUser_payment_modes form action
            $user_payment_modes = 'addUser_payment_modes';

            // Skip page url
            $skip_page_url = 'addUser_business_timing';
            
            $where = array('user_id' => $user_id);
            $user_details = DB::table('user_company_information')->where($where)->first();
            
            // Create direct links
            $basic_information_link = 'addUser_payment_modes';
            $payment_modes_link     = 'addUser_payment_modes';
            $business_timing_link   = 'addUser_business_timing';
            $logo_images_link       = 'addUser_logo_images';

            return view('admin_users.addUser_payment_modes', array("user_details" => $user_details, "user_payment_modes" => $user_payment_modes, "skip_page_url" => $skip_page_url, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link)); 
        }
    }

    // EDIT User Update Payment Modes
    public function edit_user_payment_modes(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;        
        $check_validation = $request->check_validation;
        
        if(!empty($user_id) && !empty($check_validation))
        {
            $approval                             = array();
            
            $approval['establishment_year']       = $establishment_year = $request->establishment_year;
            $approval['annual_turnover']          = $annual_turnover = $request->annual_turnover;
            $approval['number_employees']         = $number_employees = $request->number_employees;
            $approval['professional_association'] = $professional_association = $request->professional_association;
            $approval['certification']            = $certification = $request->certification;
            $approval['from_time']                = $from_time = $request->from_time;
            $approval['to_time']                  = $to_time = $request->to_time;
            $payment_mode                         = $request->payment_mode;

            // If payment mode is not null
            if(!empty($payment_mode)){
                $payment_mode = implode("|", $payment_mode);
            }else{
                $payment_mode = '';
            }

            $approval['payment_mode'] = $payment_mode;

            // If the logged in user is admin then update direct else go for admn approval
            if(Auth::user()->id != 1){
                
                $approval = json_encode($approval);

                // Insert all the information in json format for admin approval
                $insert = DB::table('admin_approvals_for_updates')->insert([

                    'update_by'           => Auth::user()->id,
                    'client_uid'          => $user_id,
                    'fields'              => $approval,
                    'notification_status' => 1,
                    'status'              => 2,
                    'created_at'          => $date,
                    'updated_at'          => $date,
                ]);

                $status = 'Request for update information submitted successfully.All will be effective after admin approval';

            }else{

                $other_info_update = DB::table('user_company_information')->where('user_id', $user_id)->update(
                    array(
                        'payment_mode'              => $payment_mode,
                        'year_establishment'        => $establishment_year,
                        'annual_turnover'           => $annual_turnover,
                        'no_of_emps'                => $number_employees,
                        'professional_associations' => $professional_association,
                        'certifications'            => $certification,
                        'created_at'                => $date,
                        'updated_at'                => $date,
                        'status'                    => 1
                    )
                );
                
                $status = 'Add Payment Modes Information Successfully.';

            }

            return redirect()->route('edit_user_business_timing', ['user_id' => $user_id])->with('status', $status);
        }
        else
        {
            // addUser_payment_modes form action
            $user_payment_modes = 'edit_user_payment_modes';

            // Skip page url
            $skip_page_url = 'edit_user_business_timing';

            $where = array('user_id' => $user_id);
            $user_details = DB::table('user_company_information')->where($where)->first();
            
            // Create direct links
            $basic_information_link = 'edit_user_basic_information';
            $payment_modes_link     = 'edit_user_payment_modes';
            $business_timing_link   = 'edit_user_business_timing';
            $logo_images_link       = 'edit_user_logo_images';

            return view('admin_users.addUser_payment_modes', array("user_details" => $user_details, "user_payment_modes" => $user_payment_modes, "skip_page_url" => $skip_page_url, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link)); 
        }
    }

    // ADD User Update Business Timining
    public function addUser_business_timing(Request $request)
    {        
        $date = date('Y-m-d H:i:s');
        $user_id = $request->user_id;
        $check_validation = $request->check_validation;
        $from_time = $request->from_time;
        $to_time = $request->to_time;

        if(!empty($user_id) && !empty($check_validation))
        {
            if(!empty($from_time)){
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

                    DB::table('user_other_information')->where($where)->update(
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
            }
            return redirect()->route('addUser_logo_images', ['user_id' => $user_id]);
        }
        else
        {
            // form action
            $user_business_timing = 'addUser_business_timing';

            // Skip page url
            $skip_page_url = 'addUser_logo_images';

            $user_details = DB::table('user_details')->where('user_id', $user_id)->first();
        
            $other = DB::table('user_other_information')->where('user_id', $user_id)->get();

            // Create direct links
            $basic_information_link = 'addUser_business_timing';
            $payment_modes_link     = 'addUser_payment_modes';
            $business_timing_link   = 'addUser_business_timing';
            $logo_images_link       = 'addUser_logo_images';

            return view('admin_users.addUser_business_timing', array("other" => $other, "user_details" => $user_details, "user_business_timing" => $user_business_timing, "skip_page_url" => $skip_page_url, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link));
        }

    }

    // EDIT User Update Business Timining
    public function edit_user_business_timing(Request $request)
    {        
        $date = date('Y-m-d H:i:s');
        $user_id = $request->user_id;
        $check_validation = $request->check_validation;
        $from_time = $request->from_time;
        $to_time = $request->to_time;

        if(!empty($user_id) && !empty($check_validation))
        {
            // If the logged in user is admin then update direct else go for admn approval
            if(Auth::user()->id != 1){
                
                $approval              = array();            
                $approval['from_time'] = $from_time;
                $approval['to_time']   = $to_time;

                $approval = json_encode($approval);

                // Insert all the information in json format for admin approval
                $insert = DB::table('admin_approvals_for_updates')->insert([

                    'update_by'           => Auth::user()->id,
                    'client_uid'          => $user_id,
                    'fields'              => $approval,
                    'notification_status' => 1,
                    'status'              => 3,
                    'created_at'          => $date,
                    'updated_at'          => $date,
                ]);

                $status = 'Request for update information submitted successfully. All will be effective after admin approval';

            }else{

                if(!empty($from_time)){
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

                        if($from == 'closed') {
                            $from = '00:00';
                            $working_status = 0;
                        } else {
                            $working_status = 1;
                        }

                        if($to_time[$p] == 'closed') {
                            $time = '00:00';
                        } else {
                            $time = $to_time[$p];
                        }

                        $where = ['user_id' => $user_id, 'operation_timing' => $operation_timing, 'day' => $day];

                        DB::table('user_other_information')->where($where)->update(
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
                }

                $status = 'Business timing updated sucessfully.';
            }
            
            return redirect()->route('edit_user_logo_images', ['user_id' => $user_id])->with('status', $status);
        }
        else
        {
            // form action
            $user_business_timing = 'edit_user_business_timing';

            // Skip page url
            $skip_page_url = 'edit_user_logo_images';

            $user_details = DB::table('user_details')->where('user_id', $user_id)->first();
        
            $other = DB::table('user_other_information')->where('user_id', $user_id)->get();

            // Create direct links
            $basic_information_link = 'edit_user_basic_information';
            $payment_modes_link     = 'edit_user_payment_modes';
            $business_timing_link   = 'edit_user_business_timing';
            $logo_images_link       = 'edit_user_logo_images';

            return view('admin_users.addUser_business_timing', array("other" => $other, "user_details" => $user_details, "user_business_timing" => $user_business_timing, "skip_page_url" => $skip_page_url, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link));
        }

    }

    // ADD User Update Logo and Images
    public function addUser_logo_images(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;
        $status = '';
        $check_validation = $request->check_validation;
        $approve_also = $request->approve_also;

        // Get user keyword if exist if not exist then admin can not approve this user else approve this user
        $keywords = DB::table('user_keywords')->where(['user_id' => $user_id, "status" => 1])->first();
        if(!empty($keywords))
        {
            $keyword_exit = 1;
        }
        else{
            $keyword_exit = 0;   
        }
        
        // If user is not approved then approve user also
        if($approve_also == 1){

            // Approve user in users table
            $update = User::where(['id'=>$user_id])->update(['status' => '1']);

            // Approve in user details table
            $details = DB::table('user_details')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

            // Approve in user_location table
            $locations = DB::table('user_location')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

            $status .= 'User approved successfully. ';
        }

        if(!empty($user_id) && !empty($check_validation)){

            if($status == ''){
                $status = 'Please upload image ! ';
            }

            // Upload multiple images
            if($request->hasFile('photos')) {

                foreach ($request->photos as $file) {

                    $filename = $file->getClientOriginalName();
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $filename = substr(md5(microtime()),rand(0,26),6);
                    $filename .= '.'.$ext;
                    $filesize = $file->getClientSize();
                    // First check file extension if file is not image then hit error
                    $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];
                    if(! in_array($ext, $extensions))
                    {
                        $status = 'File type is not allowed you have uploaded. Please upload any image ! ';
                        return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                    }

                    // first check file size if greater than 1mb than hit error
                    if($filesize > 1052030){
                        $status = 'File size is too large. Please upload file less than 1MB ! ';
                        return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                    }

                    $destinationPath = config('app.fileDestinationPath').'/'.$filename;
                    $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                    if($uploaded)
                    {
                        $image_update = DB::table('user_images')->insert(array(
                            'user_id' => $user_id,
                            'image' => $filename,
                            'status' => 1
                        ));
                    }

                    if($uploaded)
                    {
                        $status = 'Profile image updated successfully. ';
                    }
                    else
                    {
                        $status = 'No File Selected ! ';
                    }
                }
            }

            // Upload logo
            if($request->hasFile('logo')) {

                $file = $request->logo;

                $filename = $file->getClientOriginalName();

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $filename = substr(md5(microtime()),rand(0,26),6);

                $filename .= '.'.$ext;

                // First check file extension if file is not image then hit error
                $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

                if(! in_array($ext, $extensions))
                {
                    $status = 'File type is not allowed you have uploaded. Please upload any image ! ';
                    return redirect()->back()->with('status', $status);
                    // return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                }

                $filesize = $file->getClientSize();

                // first check file size if greater than 1mb than hit error
                if($filesize > 1052030){
                    $status = 'File size is too large. Please upload file less than 1MB ! ';
                    return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                }

                $destinationPath = config('app.fileDestinationPath').'/'.$filename;
                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                if($uploaded)
                {
                     $image_update = DB::table('user_details')->where('user_id', $user_id)->update(
                        array(
                            'logo' => $filename
                        )
                    );
                }

                if($uploaded)
                {
                    $status = 'Profile logo updated successfully. ';
                }
                else
                {
                    $status = 'No File Selected ! ';
                }
            }   
        }

        // form action
        $user_logo_images = 'addUser_logo_images';

        $user_details = DB::table('user_other_information')->where('status', 1)->orderBy('user_id', 'desc')->first();

        $user_images = DB::table('user_images')->where('user_id', $user_id)->get();
        
        $user_logo = DB::table('user_details')->where('user_id', $user_id)->first();

        // Create direct links
        $basic_information_link = 'addUser_logo_images';
        $payment_modes_link     = 'addUser_payment_modes';
        $business_timing_link   = 'addUser_business_timing';
        $logo_images_link       = 'addUser_logo_images';

        return view('admin_users.addUser_logo_images', array("user_details" => $user_details, "user_images" => $user_images, "user_logo" => $user_logo, "user_id" => $user_id, "keyword_exit" => $keyword_exit, "user_logo_images" => $user_logo_images, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link))->with('status', $status);
    }

    // EDIT User Update Logo and Images
    public function edit_user_logo_images(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;
        $status = '';
        $check_validation = $request->check_validation;
        $approve_also = $request->approve_also;

        // Get user keyword if not exist then admin can not approve this user else approve this user
        $keywords = DB::table('user_keywords')->where(['user_id' => $user_id, "status" => 1])->first();
        if(!empty($keywords))
        {
            $keyword_exit = 1;
        }
        else{
            $keyword_exit = 0;   
        }
        
        // If user is not approved then approve user also
        if($approve_also == 1){

            // If logged in user is admin then create 25 feedback rating for this client 
            if(Auth::user()->id == 1){

                $default_feedbacks = array();

                $rating = array('4.1', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.8', '4.9', '5.0', '4.6', '4.7', '4.8', '4.9', '5.0');

                $feedback = array('Nice','Good','Perfect','I would like to thank you for the excellent coordination..','I would like to take this service again and again from you only.','Thank you for all your help. Your service was excellent and very FAST.','Many thanks for you kind and efficient service. I have already and will definitely continue to recommend your services to others in the future. Wishing you all a lovely day and weekend','I was very impressed with your service and shall recommend it to others.......','Best Service provider','Perfect One','Very good service','I personally tried his service and it was perfect.'
                );

                $names = array("Aadhya", "Gaurav", "Ananya", "Ankita", "Diya", "Riya", "Aarohi", "Kyra", "Aarav", "Vivaan", "Ananya", "Advik", "Kabir", "Anaya", "Aarav", "Aditya", "Arjun", "Ramesh", "Reyansh", "Mohammed", "Suresh", "Arnav", "Aayan", "Krishna", "Ishaan", "Shaurya", "Atharva", "Sanjay", "Pranav", "vijay", "Aaryan", "Dhruv", "Amit", "Ritvik", "Aarush", "Prem", "Darsh", "Ravi", "Sunil", "Rishabh", "Mukesh", "Rajesh", "Akshay", "Manish", "Gulshan", "Kunal", "Dipanshu", "Aaradhya", "Pradeep", "Mahendra", "Manoj", "Dharmendra", "Anshul", "Hridya");

                $emails = array("Aadhya@gmail.com", "Gaurav@gmail.com", "Ananya@gmail.com", "Ankita@gmail.com", "Diya@gmail.com", "Riya@gmail.com", "Aarohi@gmail.com", "Kyra@gmail.com", "Aarav@gmail.com", "Vivaan@gmail.com", "Ananya@gmail.com", "Advik@gmail.com", "Kabir@gmail.com", "Anaya@gmail.com", "Aarav@gmail.com", "Aditya@gmail.com", "Arjun@gmail.com", "Ramesh@gmail.com", "Reyansh@gmail.com", "Mohammed@gmail.com", "Suresh@gmail.com", "Arnav@gmail.com", "Aayan@gmail.com", "Krishna@gmail.com", "Ishaan@gmail.com", "Shaurya@gmail.com", "Atharva@gmail.com", "Sanjay@gmail.com", "Pranav@gmail.com", "vijay@gmail.com", "Aaryan@gmail.com", "Dhruv@gmail.com", "Amit@gmail.com", "Ritvik@gmail.com", "Aarush@gmail.com", "Prem@gmail.com", "Darsh@gmail.com", "Ravi@gmail.com", "Sunil@gmail.com", "Rishabh@gmail.com", "Mukesh@gmail.com", "Rajesh@gmail.com", "Akshay@gmail.com", "Manish@gmail.com", "Gulshan@gmail.com", "Kunal@gmail.com", "Dipanshu@gmail.com", "Aaradhya@gmail.com", "Pradeep@gmail.com", "Mahendra@gmail.com", "Manoj@gmail.com", "Dharmendra@gmail.com", "Anshul@gmail.com", "Hridya@gmail.com");

                $numbers = array('25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35');
                $random_numbers = array_rand($numbers, 3);
                $times = $numbers[$random_numbers[0]];
                
                $name_email = array();

                for ($i=0; $i < $times; $i++) { 

                    $all_names = array_column($name_email, 'name');
                                
                    if(!in_array($names[$i], $all_names)){

                        $name_email[$i]['name'] = $names[$i];
                        $name_email[$i]['email'] = $emails[$i];
                    }
                }

                $name_email = array_values($name_email);

                for ($i=0; $i < count($name_email); $i++) { 

                    $random_rating = array_rand($rating, 3);
                    $random_feedback = array_rand($feedback, 3);
                    
                    $default_feedbacks[$i]['rating'] = $rating[$random_rating[0]];
                    $default_feedbacks[$i]['feedback'] = $feedback[$random_feedback[0]];
                    $default_feedbacks[$i]['names'] = $name_email[$i];      
                }

                foreach ($default_feedbacks as $key => $value) {
                    
                    $create = DB::table('client_reviews')->insert([

                        'client_uid' => $user_id,
                        'name' => $value['names']['name'],
                        'email' => $value['names']['email'],
                        'review' => $value['feedback'],
                        'rating' => $value['rating'],
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        
            // Approve user in users table
            $update = User::where(['id'=>$user_id])->update(['status' => '1']);

            // Approve in user details table
            $details = DB::table('user_details')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);

            // Approve in user_location table
            $locations = DB::table('user_location')->where(['user_id' => $user_id])->update(['update_status' => '1', 'status' => '1']);



            $status .= 'User approved successfully. ';
        }

        if(!empty($user_id) && !empty($check_validation)){

            if($status == ''){
                $status = 'Please upload image ! ';
            }

            $approval = array(); 

            // Upload multiple images
            if($request->hasFile('photos')) {

                foreach ($request->photos as $p_key => $file) {

                    $filename = $file->getClientOriginalName();
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $filename = substr(md5(microtime()),rand(0,26),6);
                    $filename .= '.'.$ext;
                    $filesize = $file->getClientSize();
                    // First check file extension if file is not image then hit error
                    $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];
                    if(! in_array($ext, $extensions))
                    {
                        $status = 'File type is not allowed you have uploaded. Please upload any image ! ';
                        return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                    }

                    // first check file size if greater than 1mb than hit error
                    if($filesize > 1052030){
                        $status = 'File size is too large. Please upload file less than 1MB ! ';
                        return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                    }

                    $destinationPath = config('app.fileDestinationPath').'/'.$filename;
                    $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                    // If the logged in user is admin then update direct else go for admn approval
                    if(Auth::user()->id != 1){

                        // If user is not admin then set photo in approval array
                        $approval[$p_key]['photos'] = $filename;
                    }else{

                        // If user is admin then update photos and logo direct
                        if($uploaded)
                        {
                            $image_update = DB::table('user_images')->insert(array(
                                'user_id' => $user_id,
                                'image' => $filename,
                                'status' => 1
                            ));
                        }

                        if($uploaded)
                        {
                            $status = 'Profile image updated successfully. ';
                        }
                        else
                        {
                            $status = 'No File Selected ! ';
                        }
                    }
                }
            }

            // Upload logo
            if($request->hasFile('logo')) {

                $file = $request->logo;

                $filename = $file->getClientOriginalName();

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $filename = substr(md5(microtime()),rand(0,26),6);

                $filename .= '.'.$ext;

                // First check file extension if file is not image then hit error
                $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

                if(! in_array($ext, $extensions))
                {
                    $status = 'File type is not allowed you have uploaded. Please upload any image ! ';
                    return redirect()->back()->with('status', $status);
                    // return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                }

                $filesize = $file->getClientSize();

                // first check file size if greater than 1mb than hit error
                if($filesize > 1052030){
                    $status = 'File size is too large. Please upload file less than 1MB ! ';
                    return redirect('addUser_logo_images/'.$user_id)->with('status', $status);
                }

                $destinationPath = config('app.fileDestinationPath').'/'.$filename;
                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                // If the logged in user is admin then update direct else go for admn approval
                if(Auth::user()->id != 1){

                    // If user is not admin then fill logo image in approval array
                    $approval['logo'] = $filename;
                }else{
                    
                    // If user is admin then update direct
                    if($uploaded)
                    {
                         $image_update = DB::table('user_details')->where('user_id', $user_id)->update(
                            array(
                                'logo' => $filename
                            )
                        );
                    }
                    if($uploaded)
                    {
                        $status = 'Profile logo updated successfully. ';
                    }
                    else
                    {
                        $status = 'No File Selected ! ';
                    }
                }
            }   
            

            // If user is not admin then photos and logo go for admin approval
            // If the logged in user is admin then update direct else go for admn approval
            if(Auth::user()->id != 1){

                $approval = json_encode($approval);

                // Insert all the information in json format for admin approval
                $insert = DB::table('admin_approvals_for_updates')->insert([

                    'update_by'           => Auth::user()->id,
                    'client_uid'          => $user_id,
                    'fields'              => $approval,
                    'notification_status' => 1,
                    'status'              => 4,
                    'created_at'          => $date,
                    'updated_at'          => $date,
                ]);

                $status = 'Request for update information submitted successfully. All will be effective after admin approval';
            }

        }

        // form action
        $user_logo_images = 'edit_user_logo_images';

        $user_details = DB::table('user_other_information')->where('status', 1)->orderBy('user_id', 'desc')->first();

        $user_images = DB::table('user_images')->where('user_id', $user_id)->get();
        
        $user_logo = DB::table('user_details')->where('user_id', $user_id)->first();

        // Create direct links
        $basic_information_link = 'edit_user_basic_information';
        $payment_modes_link     = 'edit_user_payment_modes';
        $business_timing_link   = 'edit_user_business_timing';
        $logo_images_link       = 'edit_user_logo_images';

        return view('admin_users.addUser_logo_images', array("user_details" => $user_details, "user_images" => $user_images, "user_logo" => $user_logo, "user_id" => $user_id, "keyword_exit" => $keyword_exit, "user_logo_images" => $user_logo_images, 'basic_information_link' => $basic_information_link, 'payment_modes_link' => $payment_modes_link, 'business_timing_link' => $business_timing_link, 'logo_images_link' => $logo_images_link))->with('status', $status);
    }

    # User Delete Logo
    public function userDeteteLogo(Request $request)
    {
        $user_id = $request->user_id;

        // update user details
        $update = DB::table('user_details')->where('user_id', $user_id)->update(
            array(
                'logo' => Null
            )
        );

        if($update)
        {
            $status = 'Delete Logo successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        return redirect()->back()->with('status', $status);
    }

    # User Delete Logo
    public function userDeteteImage(Request $request)
    {
        $user_id = $request->user_id;
        $image_id = $request->image_id;

        // update user details
        $update = DB::table('user_images')->where('id', $image_id)->delete();

        if($update)
        {
            $status = 'Delete Image successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect()->back()->with('status', $status);
    }

    // View User Detail
    public function View(Request $request)
    {
        $user_id = $request->user_id;

        // Get basic / location / company information
        $query = DB::table('user_details as ud')
            ->join('user_location as ul', 'ud.user_id', '=', 'ul.user_id')
            ->join('user_company_information as uci', 'ud.user_id', '=', 'uci.user_id')
            ->join('cities', 'cities.id', '=', 'ul.city')
            ->join('areas', 'areas.id', '=', 'ul.area')
            ->select('ud.*', 'ul.business_name', 'ul.building', 'ul.street', 'ul.landmark', 'ul.area', 'ul.city', 'ul.pincode', 'ul.state', 'ul.country', 'uci.payment_mode', 'uci.payment_mode', 'uci.year_establishment', 'uci.annual_turnover', 'uci.no_of_emps', 'uci.professional_associations', 'uci.certifications', 'cities.name as city_name', 'areas.area as area_name')
            ->where('ud.user_id', '=', $user_id);

        $user_details = $query->first();

        # Get Other information
        $user_other_information = DB::table('user_other_information')->where('user_id', $user_id)->get();

        # Get Images
        $images = DB::table('user_images')->where('user_id', $user_id)->get();

        return view('admin_users.view', array('user_details' => $user_details, 'other_information' => $user_other_information, 'images' => $images));
    }

    // Active / Inactive user with update location
    public function active_inactive(Request $request)
    {
        $user_id = $request->user_id;

        $status = $request->status;

        if($status == 1)
        {
            $status = 2;
        }
        else
        {
            $status = 1;
        }

        // update user details
        $update = DB::table('user_details')->where('user_id', $user_id)->update(
            array(
                    'status' => $status
            )
        );

        // update user location
        $update_location = DB::table('user_location')->where('user_id', $user_id)->update(
            array(
                    'status' => $status
            )
        );

        if($update)
        {
            $status = 'User successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // All Sliders view
    public function slider()
    {
        $slider_images = DB::table('slider')->get();

        return view('admin.slider', array('slider' => $slider_images));
    }

    # add slider view
    public function addSlider()
    {
        return view('admin.addSlider');
    }

    # add slider
    public function add_slider(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        if($request->hasFile('file')) {

            foreach ($request->file as $file) {

                $filename = $file->getClientOriginalName();

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $filename = substr(md5(microtime()),rand(0,26),6);

                $filename .= '.'.$ext;

                $filesize = $file->getClientSize();

                $destinationPath = config('app.fileDestinationPath').'/'.$filename;
                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                if($uploaded)
                {
                     $image_update = DB::table('slider')->insert(
                        array(
                            'image' => $filename,
                            'created_at' => $date
                        )
                    );
                }

                if($uploaded)
                {
                    $status = 'image upload successfully.';
                }
                else
                {
                    $status = 'No File Selected';
                }
            }
        }
        return redirect('slider')->with('status', $status);
    }

    # delete slider
    public function delete_slider(Request $request)
    {
        $id = $request->user_id;

        $delete_slider = DB::table('slider')->where('id', $id)->delete();

        if($delete_slider)
        {
            $status = "Delete Slider successfully";
        }
        else
        {
            $status = "Someting went wrong";
        }

        return redirect('slider')->with('status', $status);
    }

    // Get and show new suggested categories
    public function new_suggested_categories(){

        $categories = DB::table('category_suggestions')
                    ->join('users', 'users.id', '=', 'category_suggestions.user_id')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->select('category_suggestions.*', 'roles.role', 'users.name')
                    ->get();

        // update status for all new suggested categories
        $update = DB::table('category_suggestions')->where(['status' => 1])->update([

            'status' => 0
        ]);

        // Get all super categories
        $super_cats = DB::table('super_categories')->where('status', 1)->get();

        return view('admin.new_suggested_categories', array('categories' => $categories, 'super_cats' => $super_cats));
    }
}
