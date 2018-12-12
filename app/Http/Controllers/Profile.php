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

class Profile extends Controller
{
    // Authenticate users
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersmiddleware');
    }

    // User Profile View
    public function profile()
    {
    	$currentuserid = Auth::user()->id;

        // Get user location details
        $location = DB::table('user_location')->where('user_id', $currentuserid)->first();

        // Get user contact details
        $contact = DB::table('user_details')->where('user_id', $currentuserid)->first();

        // Get user other information
        $other = DB::table('user_other_information')->where('user_id', $currentuserid)->get();

        // Get user other information
        $company = DB::table('user_company_information')->where('user_id', $currentuserid)->first();

        // Get countries
        $cities = DB::table('cities')->where('state_id', 33)->get();

        // Get selected keywords
        $where = array('user_id' => $currentuserid, 'status' => 1);

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

        return view('profile.profile', array('location' => $location, 'contact' => $contact, 'other' => $other, 'company' => $company, 'cities' => $cities, 'keywords' => $saved_keywords));
    }

    // Upload logo and photos
    public function uploadLogoAndPhotos(Request $request)
    {
        $user_id = Auth::user()->id;

        $status = 'Please Select Image';

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
                    $status = 'File type is not allowed you have uploaded. Please upload any image !';
                    return redirect('profile')->with('status', $status);
                }

                // first check file size if greater than 1mb than hit error
                if($filesize > 1052030){
                    $status = 'File size is too large. Please upload file less than 1MB !';
                    return redirect('profile')->with('status', $status);
                }

                $destinationPath = config('app.fileDestinationPath').'/'.$filename;

                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                if($uploaded)
                {
                     $image_update = DB::table('user_images')->insert(
                        array(
                            'user_id' => $user_id,
                            'image' => $filename,
                            'status' => 1
                        )
                    );
                }

                if($uploaded)
                {
                    $status = 'Profile updated successfully.';
                }
                else
                {
                    $status = 'No File Selected';
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
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('profile')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 1MB !';
                return redirect('profile')->with('status', $status);
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
                $status = 'Profile updated successfully.';
            }
            else
            {
                $status = 'No File Selected';
            }
        }


        return redirect('profile')->with('status', $status);

    }

    // Get enquiries related to this user / client
    public function enquiry(){

        // Get current user id
        $currentuserid = Auth::user()->id;

        // Get related keyword for this user
        $keywords = DB::table('user_keywords')->where(['status' => 1, 'update_status' => 1, 'user_id' => $currentuserid])->get();

        $enquiries = array();
        $i = 0;
        foreach ($keywords as $key => $keyword) {
            
            # Get all enquiries of this keyword and identity
            $enquiry =  DB::table('category_enquiries')                        
                        ->where(['category_enquiries.category_id' => $keyword->keyword_id, 'category_enquiries.identity' => $keyword->keyword_identity, 'category_enquiries.status' => 1])
                        ->leftjoin("category", function($join) {
                            $join->on("category.id", "=", "category_enquiries.category_id")
                                 ->where("category_enquiries.identity", "1");
                        })
                        ->leftjoin("subcategory",function($sjoin) {
                            $sjoin->on("subcategory.id", "=", "category_enquiries.category_id")
                                  ->where("category_enquiries.identity", "2");
                        })
                        ->select('category_enquiries.*', 'category.category', 'subcategory.subcategory')
                        ->get();

            foreach ($enquiry as $e_key => $enq) {
                
                $enquiries[$i] = $enq;
                $i++;
            }
        }

        // Get self enquiries / enquiries which are submitted for this perticular client
        $my_enquiries = DB::table('client_enquiries')->where('client_uid', $currentuserid)->get();

        return view('profile.enquiry', array('enquiries' => $enquiries, 'my_enquiries' => $my_enquiries));
    }
}
