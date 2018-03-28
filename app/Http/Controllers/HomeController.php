<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
use Session;
use Crypt;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('category')->where('status', 1)->get();

        $sliders = DB::table('slider')->get();

        $title = 'Home';
        $meta_description = 'Home keywords';
        $meta_keywords = 'Home keywords';

        return view('welcome', array('category' => $category, 'sliders' => $sliders, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
    }

    // Filter data according to location and any keyword
    public function filter(Request $request)
    {
        $location = $request->location;
        $cat = $request->cat;
        $encoded = $request->encoded;

        $encoded = explode('-', $encoded);
        $title_id = $encoded[1];
        $title_status = $encoded[2];
       

        if($title_status == 1) {        // If title is category

            $categories = DB::table('category')->where('status', 1)->get();

            $clients = DB::table('user_keywords')
                ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
                ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where(array('user_keywords.keyword_identity' => 1, 'category.id' => $title_id))
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country')
                //->groupBy('user_id')
                ->get();

            return view('frontend.clients', array('clients' => $clients, 'categories' => $categories));
        }
        elseif ($title_status == 2) {   // If title is sub category

            $categories = DB::table('category')->where('status', 1)->get();

            $clients = DB::table('user_keywords')
                ->join('subcategory', 'subcategory.id', '=', 'user_keywords.keyword_id')
                ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where(array('user_keywords.keyword_identity' => 2, 'subcategory.id' => $title_id))
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country')
                //->groupBy('user_id')
                ->get();

            return view('frontend.clients', array('clients' => $clients, 'categories' => $categories));
        }
        else {                          // If title is company

            // Get client all details
            $client = DB::table('user_details')
                ->join('user_company_information', 'user_company_information.user_id', '=', 'user_details.user_id')
                ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
                ->where(array('user_details.user_id' => $title_id))
                ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'user_company_information.payment_mode', 'user_company_information.year_establishment', 'user_company_information.annual_turnover', 'user_company_information.no_of_emps', 'user_company_information.professional_associations', 'user_company_information.certifications')
                ->first();

            // Get client other information
            $other_info = DB::table('user_other_information')->where('user_id', $title_id)->get();

            // Get client images
            $images = DB::table('user_images')->where('user_id', $title_id)->get();

            return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images));

        }

        exit;
    }

    // Sliders
    public function slider()
    {
        $slider_images = DB::table('slider')->get();

        return view('admin.slider', array('slider' => $slider_images));
    }

    public function addSlider()
    {
        return view('admin.addSlider');
    }

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

    // Get all clients for perticular category
    public function category(Request $request)
    {
        $title = 'Categories';
        $meta_description = 'Category description';
        $meta_keywords = 'Category keywords';

        $category = $request->category;

        $category = str_replace("-", " ", $category);

        $categories = DB::table('category')->where('status', 1)->get();

        $clients = DB::table('user_keywords')
            ->join('category', 'category.id', '=', 'user_keywords.keyword_id')
            ->join('user_details', 'user_keywords.user_id', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_keywords.keyword_identity' => 1, 'category.category' => $category))
            ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country')
            //->groupBy('user_id')
            ->get();

        return view('frontend.clients', array('clients' => $clients, 'categories' => $categories, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));
    }

    public function view(Request $request)
    {
        $title = 'Category View';
        $meta_description = 'Category View description';
        $meta_keywords = 'Category View keywords';

        $business = $request->business;
        $id = $request->id;
        $user_id = Crypt::decrypt($id);

        // Get client all details
        $client = DB::table('user_details')
            ->join('user_company_information', 'user_company_information.user_id', '=', 'user_details.user_id')
            ->join('user_location', 'user_location.user_id', '=', 'user_details.user_id')
            ->where(array('user_details.user_id' => $user_id))
            ->select('user_details.*', 'user_location.business_name', 'user_location.building', 'user_location.street', 'user_location.landmark', 'user_location.area', 'user_location.city', 'user_location.pincode', 'user_location.state', 'user_location.country', 'user_company_information.payment_mode', 'user_company_information.year_establishment', 'user_company_information.annual_turnover', 'user_company_information.no_of_emps', 'user_company_information.professional_associations', 'user_company_information.certifications')
            ->first();

        // Get client other information
        $other_info = DB::table('user_other_information')->where('user_id', $user_id)->get();

        // Get client images
        $images = DB::table('user_images')->where('user_id', $user_id)->get();

        return view('frontend.client_view', array('client' => $client, 'other_info' => $other_info, 'images' => $images, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords));

        exit;
    }
}
