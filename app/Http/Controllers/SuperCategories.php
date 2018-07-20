<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use Auth;
use Session;
use File;
use Illuminate\Support\Facades\Validator;

class SuperCategories extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    # Show all super categories
    public function index()
    {
    	# Gel all super categories
    	$super_categories = DB::table('super_categories')->where('status', 1)->get();

    	return view('Super_categories.index', array('super_categories' => $super_categories));
    }

    # Create super category
    public function create(Request $request)
    {
    	$super_cat_name = $request->name;
    	$super_cat_image = $request->super_cat_image;

    	if($request->has('add_category'))
    	{
	    	# Set validation for
	        $this->validate($request, [
	            'name' => 'required|unique:super_categories',
	        ]);
    	}

    	if(!empty($super_cat_name)){

    		$date = date('Y-m-d H:i:s');
    		$filename = 'default.png';

    		# insert super category in table
    		if($request->hasFile('super_cat_image')) {

	            $file = $request->super_cat_image;

	            $filename = $file->getClientOriginalName();

	            $ext = pathinfo($filename, PATHINFO_EXTENSION);

	            $filename = substr(md5(microtime()),rand(0,26),6);

	            $filename .= '.'.$ext;

	            // First check file extension if file is not image then hit error
	            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

	            if(! in_array($ext, $extensions))
	            {
	                $status = 'File type is not allowed you have uploaded. Please upload any image !';
	                return redirect('create')->with('status', $status);
	            }

	            $filesize = $file->getClientSize();

	            // first check file size if greater than 1mb than hit error
	            if($filesize > 1052030){
	                $status = 'File size is too large. Please upload file less than 1MB !';
	                return redirect('create')->with('status', $status);
	            }

	            $destinationPath = config('app.fileDestinationPath').'/super_category/'.$filename;
	            $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));	            
	        }

	        # Insert entry
	        $insert = DB::table('super_categories')->insert([
	        	'name' => $super_cat_name,
	        	'image' => $filename,
	        	'created_at' => $date,
	        	'updated_at' => $date,
	        ]);

	        if($insert){
	        	$status = 'Create super category successfully.';
	        }else{
	        	$status = 'Something went wrong !';
	        }

	        return redirect('superCategories')->with('status', $status);
    	}

    	return view('Super_categories.create');
    }

    # Edit super category
    public function edit(Request $request)
    {
    	$id = $request->id;

    	$super_category = DB::table('super_categories')->where('id', $id)->first();
    	
    	return view('Super_categories.edit', array('super_category' => $super_category));
    }

    # Edit super category
    public function update(Request $request)
    {
    	$super_cat_id = $request->super_cat_id;
    	$super_cat_name = $request->super_cat_name;
    	$super_cat_image = $request->super_cat_image;

    	# Get details of this super category
    	$super_category = DB::table('super_categories')->where('id', $super_cat_id)->first();

        # If super category not found
        if(empty($super_cat_id)){
        	return redirect('superCategories')->with('status', 'Something went wrong !');
        }

		$date = date('Y-m-d H:i:s');
		$filename = $super_category->image;

		# insert super category in table
		if($request->hasFile('super_cat_image')) {

            $file = $request->super_cat_image;

            $filename = $file->getClientOriginalName();

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $filename = substr(md5(microtime()),rand(0,26),6);

            $filename .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('create')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 1MB !';
                return redirect('create')->with('status', $status);
            }

            $destinationPath = config('app.fileDestinationPath').'/super_category/'.$filename;
            $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));	            
        }

        # Update entry
        $update = DB::table('super_categories')->where('id', $super_cat_id)->update([
        	'name' => $super_cat_name,
        	'image' => $filename,
        	'updated_at' => $date,
        ]);

        if($update){
        	$status = 'Edit super category successfully.';
        }else{
        	$status = 'Something went wrong !';
        }

        return redirect('superCategories')->with('status', $status);
    }
}
