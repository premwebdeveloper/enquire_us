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
                ->join('employees', 'employees.user_id', '=', 'user_details.created_by')
                //->leftjoin('user_keywords', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->where('user_details.status', '=', 0)
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.state', 'user_location.country', 'user_location.pincode', 'areas.area as area_name', 'cities.name as city_name', 'employees.name as created_by_name', 'employees.phone as created_by_phone')
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
        $user_id = $request->user_id;

        if(!empty($user_id))
        {
            // Get basic / location / company information
            $query = DB::table('user_details as ud')
                ->join('user_location as ul', 'ud.user_id', '=', 'ul.user_id')
                ->join('user_company_information as uci', 'ud.user_id', '=', 'uci.user_id')
                ->join('cities', 'cities.id', '=', 'ul.city')
                ->join('areas', 'areas.id', '=', 'ul.area')
                ->select('ud.*', 'ul.business_name', 'ul.building', 'ul.street', 'ul.landmark', 'ul.area', 'ul.city', 'ul.pincode', 'ul.state', 'ul.country', 'uci.payment_mode', 'uci.payment_mode', 'uci.year_establishment', 'uci.annual_turnover', 'uci.no_of_emps', 'uci.professional_associations', 'uci.certifications', 'cities.name as city_name', 'areas.area as area_name')
                ->where('ud.user_id', '=', $user_id);

            $user_details = $query->first();

            return view('admin_users.addUser_basic_information', array('user_details' => $user_details));
        }
        else
        {
            //Admin Add New user Basic information
            return view('admin_users.addUser_basic_information');
        }
    }

    // add new User
    public function update_admin_user(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $user_id = $request->user_id;

        /*Basic Detail*/
        $company_name = $request->company_name;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        $building = $request->building;
        $street = $request->street;
        $landmark = $request->landmark;
        $area = $request->area;
        $city = $request->city;
        $pin_code = $request->pin_code;
        $state = $request->state;
        $country = $request->country;

        /*Contact Detail*/
        $landline = $request->landline;
        $fax = $request->fax;
        $fax2 = $request->fax2;
        $toll_free = $request->toll_free;
        $toll_free2 = $request->toll_free2;
        //$email = $request->email;
        $website = $request->website;
        $about_company = $request->about_company;

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
                'landline' => $landline,
                'fax1' => $fax,
                'fax2' => $fax2,
                'toll_free1' => $toll_free,
                'toll_free2' => $toll_free2,
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

        if($user_details)
        {
            $status = 'Update User Basic Informations Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        return redirect()->route('addUser_payment_modes', ['user_id' => $user_id]);
    }

    // add new User
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
        $landline      = $request->landline;
        $fax           = $request->fax;
        $fax2          = $request->fax2;
        $toll_free     = $request->toll_free;
        $toll_free2    = $request->toll_free2;
        $website       = $request->website;
        $about_company = $request->about_company;
        $password = bcrypt($password);

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
                'landline'      => $landline,
                'fax1'          => $fax,
                'fax2'          => $fax2,
                'toll_free1'    => $toll_free,
                'toll_free2'    => $toll_free2,
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
        //dd($user_id);
        //return redirect('addUser_payment_modes')->with('status', $status)->with('user_id', $user_id);
        return redirect()->route('addUser_payment_modes', ['user_id' => $user_id]);
    }

    // new User Update Payment Modes
    public function addUser_payment_modes(Request $request)
    {
        $date = date('Y-m-d H:i:s');

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
            $where = array('user_id' => $user_id);
            $user_details = DB::table('user_company_information')->where($where)->first();
            return view('admin_users.addUser_payment_modes', array("user_details" => $user_details)); 
        }
    }

    // new User Update Business Timining
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
            return redirect()->route('addUser_business_keywords', ['user_id' => $user_id]);
        }
        else
        {
            $user_details = DB::table('user_details')->where('user_id', $user_id)->first();
        
            $other = DB::table('user_other_information')->where('user_id', $user_id)->get();

            return view('admin_users.addUser_business_timing', array("other" => $other, "user_details" => $user_details));
        }

    }

    // new User Update Business Keywords
    public function addUser_business_keywords(Request $request)
    {
        $user_id = $request->user_id;
        
        $user_details = DB::table('user_details')->where('user_id', $user_id)->first();
        
        $where = array('user_id' => $user_id, 'status' => 1);

        $keywords = DB::table('user_keywords')->where($where)->get();

        $saved_keywords = '';

        foreach ($keywords as $key => $words)
        {
            if($words->keyword_identity == 1)
            {
                $category = DB::table('category')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$category->id.'_1">'.$category->category.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" id="delete_'.$category->id.'_1"></i></div>';
            }
            else
            {
                $subcategory = DB::table('subcategory')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$subcategory->id.'_2">'.$subcategory->subcategory.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" id="delete_'.$subcategory->id.'_2"></i></div>';
            }
        }
        
        return view('admin_users.addUser_business_keywords', array("user_details" => $user_details, "keywords" => $saved_keywords));
    }

    // new User Update Logo and Images
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
        
        // If user is not approved then approce user also
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

        $user_details = DB::table('user_other_information')->where('status', 1)->orderBy('user_id', 'desc')->first();

        $user_images = DB::table('user_images')->where('user_id', $user_id)->get();
        
        $user_logo = DB::table('user_details')->where('user_id', $user_id)->first();

        return view('admin_users.addUser_logo_images', array("user_details" => $user_details, "user_images" => $user_images, "user_logo" => $user_logo, "user_id" => $user_id, "keyword_exit" => $keyword_exit))->with('status', $status);
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
