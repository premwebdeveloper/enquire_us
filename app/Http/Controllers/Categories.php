<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
class Categories extends Controller
{
    # construct function
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

	//add category page
	public function add_category()
	{
		return view('admin.addCategory');
	}

	//view category page
	public function Category()
	{
		$category = DB::table('category')->where('status', 1)->get();

		return view('admin.Category', array('category' => $category));
	}

    //Add Category
    public function addCategory(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $category = $request->category;

        $create_cat = DB::table('category')->insert(
            array('category' => $category, 'created_at' => $date, 'updated_at' => $date)
        );

        if($create_cat)
        {
            $status = 'Category Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('add_category')->with('status', $status);
    }

    //edit Category
    public function editCat(Request $request)
    {
    	$date = date('Y-m-d H:i:s');

        $cat_id = $request->cat_id;
    	$category = $request->category;

    	$create_cat = DB::table('category')->where('id', $cat_id)->update(
    		array('category' => $category, 'created_at' => $date, 'updated_at' => $date)
    	);

        if($create_cat)
        {
            $status = 'Category Update successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('Category')->with('status', $status);
    }

    //add subCatgory page
    public function add_subCategory()
    {
        $category = DB::table('category')->where('status', 1)->get();

        return view('admin.addsubCategory', array('category' => $category));
    }

    //subCatgory page
    public function subCategory()
    {
        $category = DB::table('category')->where('status', 1)->get();

    	$subcategory = DB::table('subcategory')
        ->join('category', 'category.id', '=', 'subcategory.cat_id')
        ->select('subcategory.*', 'category.category')
        ->where('subcategory.status', 1)->get();

    	return view('admin.subCategory', array('subcategory' => $subcategory, 'category' => $category));
    }

    //view add subCatgory page
    public function addSubCategory(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $category = $request->category;
        $subCategory = $request->subcategory;

        $create_cat = DB::table('subcategory')->insert(
            array('cat_id' => $category, 'subcategory' => $subCategory, 'created_at' => $date, 'updated_at' => $date)
        );

        if($create_cat)
        {
            $status = 'subCategory Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('add_subCategory')->with('status', $status);
    }

    //edit subCatgory page
    public function editsubCat(Request $request)
    {
    	$date = date('Y-m-d H:i:s');

        $subcat_id = $request->subcat_id;

    	$category = $request->category;
    	$subCategory = $request->subcategory;

    	$create_cat = DB::table('subcategory')->where('id', $subcat_id)->update(
    		array('cat_id' => $category, 'subcategory' => $subCategory, 'created_at' => $date, 'updated_at' => $date)
    	);

        if($create_cat)
        {
            $status = 'subCategory Update successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('subCategory')->with('status', $status);
    }
}
