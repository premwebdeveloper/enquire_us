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
        # get all super categoriees
        $super_categories = DB::table('super_categories')->get();

		return view('admin.addCategory', array('super_categories' => $super_categories));
	}

	//view category page
	public function Category()
	{
        # get all super categoriees
        $super_categories = DB::table('super_categories')->get();

		$category = DB::table('category')->where('status', 1)->get();

		return view('admin.Category', array('category' => $category, 'super_categories' => $super_categories));
	}

    //Add Category
    public function addCategory(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $super_category = $request->super_category;
        $category = $request->category;
        $description = $request->description;

        $create_cat = DB::table('category')->insert([
            'super_category' => $super_category,
            'category' => $category,
            'description' => $description,
            'created_at' => $date,
            'updated_at' => $date
        ]);

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

        $super_category = $request->super_category;
        $cat_id = $request->cat_id;
        $category = $request->category;
    	$description = $request->category_description;

    	$create_cat = DB::table('category')->where('id', $cat_id)->update([
            'super_category' => $super_category,
            'category' => $category,
            'description' => $description,
            'updated_at' => $date
    	]);

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
        $description = $request->description;

        $create_cat = DB::table('subcategory')->insert([
            'cat_id' => $category,
            'subcategory' => $subCategory,
            'description' => $description,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($create_cat)
        {
            $status = 'Sub Category Added successfully.';
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
    	$description = $request->description;

    	$create_cat = DB::table('subcategory')->where('id', $subcat_id)->update([
            'cat_id' => $category,
            'subcategory' => $subCategory,
            'description' => $description,
            'updated_at' => $date
    	]);

        if($create_cat)
        {
            $status = 'Sub Category Update successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('subCategory')->with('status', $status);
    }

    // View category clubs page
    public function categoryClubs()
    {
        # Get all category
        $category = DB::table('category')->where('status', 1)->get();

        # Get all category clubs
        $category_clubs = DB::table('category_clubs')
        ->where('category_clubs.status', 1)
        ->join('category', 'category.id', '=',  'category_clubs.category_id')
        ->select('category_clubs.*', 'category.category')
        ->get();

        # Convert category std class into array
        $category = json_decode(json_encode($category), True);

        # Convert category clubs std class into array
        $clubs = json_decode(json_encode($category_clubs), True);

        $club_ids = array();
        $i = 0;
        # First compare both and filter unclubed categories
        foreach ($clubs as $key => $club) {

            # Get all unique club ids in array
            if(! in_array($club['category_club'], $club_ids))
            {
                $club_ids[$i] = $club['category_club'];
            }

            # If the category is in club then remove that category from categories array
            foreach ($category as $cat_key => $cat) {
                if($club['category_id'] == $cat['id']){
                    unset($category[$cat_key]);
                }
            }

            $i++;
        }

        $all_clubs = array();
        $p = 0;

        # Now get categories according to clubs
        foreach ($club_ids as $key => $c_id) {
            $category_name = '';
            foreach ($category_clubs as $key => $club) {
                if($c_id == $club->category_club)
                {
                    $category_name .= $club->category .', ';

                    $all_clubs[$p]['category_club'] = $c_id;
                    $all_clubs[$p]['category_club_name'] = $club->category_club_name;
                    $all_clubs[$p]['category_name'] = $category_name;
                }
            }
            $p++;
        }

        # Convert array into std class object
        $category = (object)$category;

        return view('admin.category_clubs', array('category' => $category, 'category_clubs' => $all_clubs));
    }

    # Create category club
    public function create_category_club(Request $request)
    {
        $club_name = $request->club_name;
        $selected_category = $request->select_category;
        $category_club = time();
        $date = date('Y-m-d H:i:s');

        foreach ($selected_category as $key => $category) {

            # Create category club
            DB::table('category_clubs')->insert([
                'category_club' => $category_club,
                'category_club_name' => $club_name,
                'category_id' => $category,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        return redirect()->back()->with('success', 'Category club created successfully.');
    }

    # Edit category club form page
    public function edit_club(Request $request)
    {
        $club_id = $request->category_club;

        # Get club details for this club id
        $category_club = DB::table('category_clubs')
        ->where('category_club', $club_id)
        ->join('category', 'category.id', '=',  'category_clubs.category_id')
        ->select('category_clubs.*', 'category.category')
        ->get();

        # If anyone change category club id OR url then return back to category clubs page with error message
        if(empty($category_club{0}))
        {
            $status = 'Something went wrong ! Please try again.';
            return redirect('categoryClubs')->with('success', $status);
        }

        # Convert category clubs std class into array
        $category_club = json_decode(json_encode($category_club), True);

        # Get all category clubs
        $all_clubs = DB::table('category_clubs')->where('status', 1)->get();

        # Get all category
        $category = DB::table('category')->where('status', 1)->get();

        # Convert category std class into array
        $category = json_decode(json_encode($category), True);

        # First compare both and filter unclubed categories
        foreach ($all_clubs as $key => $club) {
            # If the category is in club then remove that category from categories array
            foreach ($category as $cat_key => $cat) {
                if($club->category_id == $cat['id']){
                    unset($category[$cat_key]);
                }
            }
        }

        return view('admin.edit_category_club', array('category' => $category, 'category_club' => $category_club));
    }

    # Edit category club
    public function edit_category_club(Request $request)
    {
        $category_club = $request->category_club;
        $club_name = $request->club_name;
        $select_category = $request->select_category;

        $date = date('Y-m-d H:i:s');

        # First delete all rows / categories of this club
        $delete = DB::table('category_clubs')->where('category_club', $category_club)->delete();

        # After deletion all rows creare new rows with the same club unique id
        if(!empty($select_category))
        {
            foreach ($select_category as $key => $cat) {
                $create = DB::table('category_clubs')->insert([
                    'category_club' => $category_club,
                    'category_club_name' => $club_name,
                    'category_id' => $cat,
                    'status' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }

        $status = 'Category club updated successfully';

        return redirect('categoryClubs')->with('success', $status);
    }
}
