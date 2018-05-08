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
        $this->middleware('admin');
    }

    // View All User
    public function index()
    {
        # Get All Users
        $users = DB::table('user_details')->where('status','!=', 0)->get();

        return view('admin_users.index', array('users' => $users));
    }

    // add new User Basic Information view page
    public function addUser_basic_information()
    {
        $currentuserid = Auth::user()->id;
        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        return view('admin_users.addUser_basic_information', array("other" => $other));
    }

    // new User Update Payment Modes
    public function addUser_payment_modes()
    {
        $currentuserid = Auth::user()->id;
        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        return view('admin_users.addUser_payment_modes', array("other" => $other));
    }

    // new User Update Business Timining
    public function addUser_business_timing()
    {
        $currentuserid = Auth::user()->id;
        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        return view('admin_users.addUser_business_timing', array("other" => $other));
    }

    // new User Update Business Keywords
    public function addUser_business_keywords()
    {
        $currentuserid = Auth::user()->id;
        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        return view('admin_users.addUser_business_keywords', array("other" => $other));
    }

    // new User Update Logo and Images
    public function addUser_logo_images()
    {
        $currentuserid = Auth::user()->id;
        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        return view('admin_users.addUser_logo_images', array("other" => $other));
    }

    // add new User
    public function add_user(AddUserValidation $request)
    {
        $date = date('Y-m-d H:i:s');

        /*Basic Detail*/
        $company_name = $request->company_name;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        /*Location Detail*/
        //$business_name = $request->business_name;
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

        $password = bcrypt($password);

        // Create User
        $user = DB::table('users')->insert(
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $user_id = DB::getPdo()->lastInsertId();

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => 2,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'landline' => $landline,
                'fax1' => $fax,
                'fax2' => $fax2,
                'toll_free1' => $toll_free,
                'toll_free2' => $toll_free2,
                'website' => $website,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        // Create User Location
        $user_details = DB::table('user_location')->insert(
            array(
                'user_id' => $user_id,
                'business_name' => $company_name,
                'building' => $building,
                'street' => $street,
                'landmark' => $landmark,
                'area' => $area,
                'city' => $city,
                'pincode' => $pin_code,
                'state' => $state,
                'country' => $country,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
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
                    'working_status' => '0',
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

        if($user_details)
        {
            $status = 'Add User successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('index')->with('status', $status);
    }

    // View User Detail
    public function View(Request $request)
    {
        $user_id = $request->user_id;

        // Get basic / location / company information
        $query = DB::table('user_details as ud')
            ->join('user_location as ul', 'ud.user_id', '=', 'ul.user_id')
            ->join('user_company_information as uci', 'ud.user_id', '=', 'uci.user_id')
            ->select('ud.*', 'ul.business_name', 'ul.building', 'ul.street', 'ul.landmark', 'ul.area', 'ul.city', 'ul.pincode', 'ul.state', 'ul.country', 'uci.payment_mode', 'uci.payment_mode', 'uci.year_establishment', 'uci.annual_turnover', 'uci.no_of_emps', 'uci.professional_associations', 'uci.certifications')
            ->where('ud.user_id', '=', $user_id);

        $user_details = $query->first();

        # Get Other information
        $user_other_information = DB::table('user_other_information')->where('user_id', $user_id)->get();

        # Get Images
        $images = DB::table('user_images')->where('user_id', $user_id)->get();

        return view('admin_users.view', array('user_details' => $user_details, 'other_information' => $user_other_information, 'images' => $images));
    }

    // Active / Inactive user
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
}
