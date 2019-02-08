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

        // Update location information
        $basic_info_update = DB::table('user_location')->where('user_id', $user_id)->update([
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
        ]);

        // Create page url, title, keyword and description for this business If not created before this time
        $is_exist = DB::table('websites_page_head_titles')->where('business_page', $user_id)->first();

        // If not exist then insert entry page url, title, keyword and description
        if(empty($is_exist))
        {
            // get area name by area id
            $area_info = DB::table('areas')->where('id', $area)->first();
            $area_name = $area_info->area;

            $title = $business_name.' in '.$area_name;
            $keyword = $business_name.' in '.$area_name;
            $description = $business_name.' in '.$area_name;

            $business_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $business_name);
            $area_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $area_name);

            $page_url = $business_name.'-in-'.$area_name;

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
        }

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
        //$email = $request->email;
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

    // Get areas according yo city
    public function getAreaByCityForUser(Request $request)
    {
        $city = $request->city;

        $areas = DB::table('areas')->where('city', $city)->get();

        return response()->json($areas);
    }

    // Get pincodes according yo city
    public function getPincodeByAreaForUser(Request $request)
    {
        $area = $request->area;

        $pincodes = DB::table('areas')->where('id', $area)->first();

        return response()->json($pincodes);
    }

    // search keywords and related words
    public function searchResponse(Request $request){
        $term = $request->term;
        $data = array();

        // Get all matched category and their sub categories and show
        $categories = DB::table('category');
        $categories->where('category','LIKE','%'.$term.'%');
        $categories->orderBy('category', 'asc');
        $categories = $categories->get();

        // Add all category in data array as keyword
        foreach ($categories as $cat) {

            $data[] = array('cat_id'=>$cat->id,'category'=>$cat->category,'status'=>'1'); //,'sub_cat_id'=>'','sub_category'=>''
        }

        // Add related sub category in data array as key word
        /*foreach ($categories as $cat) {

            // Get sub categories of this category
            $sub_categories = DB::table('subcategory')->where('cat_id', $cat->id)->get();
            foreach ($sub_categories as $key => $sub_cat) {
                $data[] = array('cat_id'=>$sub_cat->id,'category'=>$sub_cat->subcategory,'status'=>'2');
            }
        }*/

        // If searched keyword is not category then check in sub category

        // Get all matched sub categories and their category and show
        $subcategories = DB::table('subcategory');
        $subcategories->where('subcategory','LIKE','%'.$term.'%');
        $subcategories = $subcategories->get();

        foreach ($subcategories as $subcat) {
            $data[] = array('cat_id'=>$subcat->id,'category'=>$subcat->subcategory,'status'=>'2');

            // Get main category of this sub category
            /*$cate = DB::table('category')->where('id', $subcat->cat_id)->first();

            $avail = 0;
            foreach ($data as $key => $d) {
                if($d['cat_id'] == $cate->id && $d['status'] == 1)
                {
                    $avail++;
                }
            }*/

            /*if($avail == 0)
            {
                $data[] = array('cat_id'=>$cate->id,'category'=>$cate->category,'status'=>'1');
            }*/
        }


        if(count($data))
             return $data;
        else
            return ['id'=>'','category'=>''];
    }

    // get related keywords / category / sub category
    public function getRelatedCategoryAndSubCatregories(Request $request)
    {
        $cat_id = $request->cat_id;
        $category = $request->category;
        $status = $request->status;

        $relatedData = array();

        if($status == 1)
        {
            // Get related subcategories of this category
            $sub_categories = DB::table('subcategory')->where('cat_id', $cat_id)->get();

            foreach ($sub_categories as $key => $data) {
                $relatedData[] = array('id'=>$data->id,'category'=>$data->subcategory,'status'=>'2');
            }
        }
        else
        {
            // First Get related category id of this subcategory
            $subcategory = DB::table('subcategory')->where('id', $cat_id)->first();

            // Get category detail of this category
            $category = DB::table('category')->where('id', $subcategory->cat_id)->first();

            // Fill this category detail in array
            $relatedData[] = array('id'=>$category->id, 'category'=>$category->category, 'status'=>'1');

            // Get related sub categories of this category
            $sub_categories = DB::table('subcategory')->where('cat_id', $category->id)->get();

            foreach ($sub_categories as $key => $data) {

                // If this subcaregory is not selected subcategory then fill in array
                if($cat_id != $data->id)
                {
                    $relatedData[] = array('id'=>$data->id, 'category'=>$data->subcategory, 'status'=>'2');
                }
            }
        }

        return $relatedData;
    }

    // Save keywords in db
    public function save_keywords(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $currentuserid = Auth::user()->id;
        $checked_keywords = $request->checked_keywords;

        // First check if this keyword is already exist or not
        foreach ($checked_keywords as $key => $word) {
            $temp = explode("-", $word);
            $key_word = $temp[0];
            $key_identity = $temp[1];

            // Get old keywords to match current keywords
            $where = array('user_id' => $currentuserid, 'status' => 1, 'keyword_id' => $key_word, 'keyword_identity' => $key_identity);
            $exist = DB::table('user_keywords')->where($where)->first();

            if(!empty($exist))
            {
                echo 0;
                exit;
            }
        }

        // Check if the user want to add another category
        $where = array('user_id' => $currentuserid, 'status' => 1);
        $already_exist = DB::table('user_keywords')->where($where)->get();

        $avail_in_club = 0;

        foreach ($checked_keywords as $key => $word) {      // this array contains current selected keyword

            $temp = explode("-", $word);
            $key_word = $temp[0];
            $key_identity = $temp[1];

            if(!empty($already_exist{0}))
            {
                foreach ($already_exist as $key => $exist) {    // this array contains exist keywords

                    // If the keyword is category
                    if($key_identity == 1)
                    {
                        // If the selected keyword is another category then contact to Administrator
                        if($exist->keyword_id != $key_word && $exist->keyword_identity == $key_identity)
                        {
                            // Now check this selected category is in category club or not with existing category
                            $exist_kwyword = $exist->keyword_id;

                            // Get category club of this exist category
                            $clubs = DB::table('category_clubs')
                            ->whereIn('category_club', function($query) use ($exist_kwyword)
                            {
                                $query->select(DB::raw('category_club'))
                                      ->from('category_clubs')
                                      ->where('category_id', $exist_kwyword);
                            });
                            $club = $clubs->get();

                            // check this selected category if available in this category club
                            foreach ($club as $key => $c) {
                                // If YES then out from this loop
                                if ($key_word == $c->category_id) {
                                    $avail_in_club++;
                                }
                            }
                        }

                        // If exist keyword is subcat then first get their category / if this is another cat then contact to Admin
                        if($exist->keyword_identity != $key_identity)
                        {
                            $existSubCatRow = DB::table('subcategory')->where('id', $exist->keyword_id)->first();

                            $existCatID = $existSubCatRow->cat_id;

                            // If the selected keyword is not same as exist keyword
                            // if($key_word != $existCatID)
                            // {
                                // Now check this selected category is in category club or not with existing category

                                // Get category club of this exist category
                                $clubs = DB::table('category_clubs')
                                ->whereIn('category_club', function($query) use ($existCatID)
                                {
                                    $query->select(DB::raw('category_club'))
                                          ->from('category_clubs')
                                          ->where('category_id', $existCatID);
                                });
                                $club = $clubs->get();

                                // check this selected category if available in this category club
                                foreach ($club as $key => $c) {
                                    // If YES then out from this loop
                                    if ($key_word == $c->category_id) {
                                        $avail_in_club++;
                                    }
                                }
                            //}
                        }
                    }

                    // If the keyword is subcategory
                    if($key_identity == 2)
                    {
                        if($exist->keyword_identity == $key_identity)
                        {
                            // Get the selected keyword's category id
                            $currentSubCatRow = DB::table('subcategory')->where('id', $key_word)->first();
                            $currentCatID = $currentSubCatRow->cat_id;

                            // Get the exiting keyword's category id
                            $existSubCatRow = DB::table('subcategory')->where('id', $exist->keyword_id)->first();
                            $existCatID = $existSubCatRow->cat_id;

                            // If current keyword and exit keyword 's category id is not same then contact to Admin
                            // if($currentCatID != $existCatID)
                            // {
                                // Now check this selected category is in category club or not with existing category

                                // Get category club of this exist category
                                $clubs = DB::table('category_clubs')
                                ->whereIn('category_club', function($query) use ($existCatID)
                                {
                                    $query->select(DB::raw('category_club'))
                                          ->from('category_clubs')
                                          ->where('category_id', $existCatID);
                                });
                                $club = $clubs->get();

                                // check this selected category if available in this category club
                                foreach ($club as $key => $c) {
                                    // If YES then out from this loop
                                    if ($currentCatID == $c->category_id) {
                                        $avail_in_club++;
                                    }
                                }
                            //}
                        }
                        else
                        {
                            // Get the selected keyword's category id
                            $currentSubCatRow = DB::table('subcategory')->where('id', $key_word)->first();
                            $currentCatID = $currentSubCatRow->cat_id;

                            // If the selected sub category's category is available in exist categories
                            if($exist->keyword_identity != $key_identity)
                            {
                                if($currentCatID == $exist->keyword_id)
                                {
                                    $avail_in_club++;
                                }
                            }

                        }
                    }
                }
            }
            else
            {
               $avail_in_club++;
            }
        }

        // If any of the selected keyword is not in any category club of exist keyword
        if($avail_in_club == 0)
        {
            echo 2; exit;
        }

        // Insert keywords in database table If all is well
        foreach ($checked_keywords as $key => $keyword) {
            $temp = explode("-", $keyword);
            $key_word = $temp[0];
            $key_identity = $temp[1];

            $insert = DB::table('user_keywords')->insert([
                'user_id' => $currentuserid,
                'keyword_id' => $key_word,
                'keyword_identity' => $key_identity,
                'created_at' => $date,
                'updated_at' => $date,
                'update_status' => 0,
                'status' => 1
            ]);
        }

        echo 1;
    }

    // Get saved keywords
    public function getSavedKeywords()
    {
        $currentuserid = Auth::user()->id;

        $saved_keywords = '';

        $where = array('user_id' => $currentuserid, 'status' => 1);

        $keywords = DB::table('user_keywords')->where($where)->get();

        foreach ($keywords as $key => $words) {

            if($words->keyword_identity == 1)
            {
                $category = DB::table('category')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$category->id.'_1">'.$category->category.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" title="Delete" id="delete_'.$category->id.'_1"></i></div>';
            }
            else
            {
                $subcategory = DB::table('subcategory')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$subcategory->id.'_2">'.$subcategory->subcategory.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" title="Delete" id="delete_'.$subcategory->id.'_2"></i></div>';
            }
        }

        echo $saved_keywords;
        exit;
    }

    public function delete_keywords(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $user_id = Auth::user()->id;

        $keyword_id = $request->keyword_id;
        $keyword_identity = $request->keyword_identity;

        $where = array('user_id' => $user_id, 'keyword_id' => $keyword_id, 'keyword_identity' => $keyword_identity);

        $delete = DB::table('user_keywords')->where($where)->update(
            array(
                'updated_at' => $date,
                'status' => 0
            )
        );

        echo 1; exit;
    }

    // Search categories and compaies
    public function searchCategoriesAndCompanies(Request $request)
    {
        $term = $request->term;
        $data = array();

        // Get all matched category and their sub categories and show
        $categories = DB::table('category')
                    ->join('websites_page_head_titles', 'websites_page_head_titles.category', '=', 'category.id')
                    ->where('category.category','LIKE','%'.$term.'%')
                    ->where('category.status', '=', 1)
                    ->where('websites_page_head_titles.subcategory', '=', null)
                    ->where('websites_page_head_titles.area', '=', null)
                    ->select('category.*');

        $categories = $categories->get();

        foreach ($categories as $cat) {

            $data[] = array('cat_id'=>$cat->id,'category'=>$cat->category,'status'=>'1');

            // Get sub categories of this category
            /*$sub_categories = DB::table('subcategory')->where('cat_id', $cat->id)->get();
            foreach ($sub_categories as $key => $sub_cat) {
                $data[] = array('cat_id'=>$sub_cat->id,'category'=>$sub_cat->subcategory,'status'=>'2');
            }*/
        }

        // Get all matched sub categories and their category and show
        $subcategories = DB::table('subcategory')
                        ->join('websites_page_head_titles', 'websites_page_head_titles.subcategory', '=', 'subcategory.id')
                        ->where('subcategory.subcategory','LIKE','%'.$term.'%')
                        ->where('subcategory.status', '=', 1)
                        ->select('subcategory.*')
                        ->limit(1);

        $subcategories = $subcategories->get();

        foreach ($subcategories as $subcat) {

            $data[] = array('cat_id'=>$subcat->id,'category'=>$subcat->subcategory,'status'=>'2');

            // First check this subcategory is in data array or not
            /*$avail_subcat = 0;
            foreach ($data as $key => $row) {
                if($row['cat_id'] == $subcat->id && $row['status'] == 2)
                {
                    $avail_subcat++;
                }
            }

            // If not then add this subcategory in data array
            if($avail_subcat == 0)
            {
                $data[] = array('cat_id'=>$subcat->id,'category'=>$subcat->subcategory,'status'=>'2');
            }*/

            // Get main category of this sub category
            /*$cate = DB::table('category')->where('id', $subcat->cat_id)->first();

            // First check this category is in data array or not
            $avail_cat = 0;
            foreach ($data as $key => $d) {
                if($d['cat_id'] == $cate->id && $d['status'] == 1)
                {
                    $avail_cat++;
                }
            }

            // If not then add this in data array
            if($avail_cat == 0)
            {
                $data[] = array('cat_id'=>$cate->id,'category'=>$cate->category,'status'=>'1');
            }*/
        }

        // Get all Comopany names according to search keyword if company is approved by admin
        $business = DB::table('user_location');
        $business->where('business_name','LIKE','%'.$term.'%');
        $business->where('status','=', 1);
        $business = $business->get();

        foreach ($business as $busi) {

            $data[] = array('cat_id'=>$busi->user_id,'category'=>$busi->business_name,'status'=>'3');
        }

        if(count($data))
             return $data;
        else
            return ['id'=>'','category'=>''];
    }

    // Get areas according to cities
    public function getAreasAccordingToCity(Request $request)
    {
        $city = $request->city;

        // Get all cities of rajasthan state
        $areas = DB::table('areas')->where('city', $city)->get();

        $data = '<option value="">Select Area</option>';

        foreach ($areas as $key => $area) {
            $data .= '<option value="'.$area->area.'">'.$area->area.'</option>';
        }

        echo $data;
        exit;

        //return response()->json($states);
    }

    // Get Sub Categories according to Category
    public function getSubcategoriesAccordingToCategory(Request $request)
    {
        $cat_id = $request->cat_id;

        // Get all cities of rajasthan state
        $subcategories = DB::table('subcategory')->where('cat_id', $cat_id)->get();

        $data = '<option value="">Select Sub Category</option>';

        foreach ($subcategories as $key => $subcat) {
            $data .= '<option value="'.$subcat->id.'">'.$subcat->subcategory.'</option>';
        }

        echo $data;
        exit;
    }
    
    // Get Categories according to Super Category
    public function getCatsAccordingToSuperCat(Request $request)
    {
        $super_cat_id = $request->super_cat;

        // Get all categories according to super category
        $categories = DB::table('category')->where('super_category', $super_cat_id)->get();

        $data = '<option value="">Select Category</option>';

        foreach ($categories as $key => $cat) {
            $data .= '<option value="'.$cat->id.'">'.$cat->category.'</option>';
        }

        echo $data;
        exit;
    }

    // Check keyword is exist or not in db
    public function checkKeywordExistOrNot(Request $request)
    {
        $filter_title_attr = $request->filter_title_attr;
        $filter_title = $request->filter_title;

        $temp = explode('-', $filter_title_attr);

        $title_status = $temp[1];

        if($title_status == 1){     // if selected keyword is category

            $where = array('category' => $filter_title, 'status' => 1);
            $category = DB::table('category')->where($where)->first();

            if(!empty($category)){
                echo 1;
            }
            else{
                echo 0;
            }

        }
        if($title_status == 2){   // If selected keyword is subcategory

            $where = array('subcategory' => $filter_title, 'status' => 1);

            $subcategory = DB::table('subcategory')->where($where)->first();

            if(!empty($subcategory)){
                echo 1;
            }
            else{
                echo 0;
            }

        }
        if($title_status == 3){   // If selected keyword is company name

            $where = array('business_name' => $filter_title, 'status' => 1);
            $business_name = DB::table('user_location')->where($where)->first();

            if(!empty($business_name)){
                echo 1;
            }
            else{
                echo 0;
            }

        }
    }

	# Get Page URL
	public function getPageUrl(Request $request)
	{
		$filter_title_attr = $request->filter_title_attr;
        $location = $request->location;
        $sub_location = $request->sub_location;

		# explode id and identity and seprate values
        $temp = explode('-', $filter_title_attr);
        $keyword_id = $temp[0];
        $keyword_identity = $temp[1];

		# If keyword is category
		if($keyword_identity == 1)
		{
			$category = DB::table('websites_page_head_titles')->where('status', 1);
			$category->where('category', $keyword_id);
			$category->where('subcategory', null);

			# Check if area is blank or not
			if(!empty($sub_location))
			{
				$category->where('area', $sub_location);
			}
			else
			{
				$category->where('city', $location);
			}
			$category->select('page_url', 'encoded_params');

			//echo ($category->tosql()); exit;

			$row = $category->first();
		}

		# If keyword is subcategory
		if($keyword_identity == 2)
		{
			$subcategory = DB::table('websites_page_head_titles')->where('status', 1);
			$subcategory->where('subcategory', $keyword_id);

			# Check if area is blank or not
			if(!empty($sub_location))
			{
				$subcategory->where('area', $sub_location);
			}
			else
			{
				$subcategory->where('city', $location);
                $subcategory->where('area', null);
			}
			$subcategory->select('page_url', 'encoded_params');

			//echo ($subcategory->tosql()); exit;

			$row = $subcategory->first();
		}

		# If keyword is business name
		if($keyword_identity == 3)
		{
			$business = DB::table('websites_page_head_titles')->where('status', 1);
			$business->where('business_page', $keyword_id);

			# Check if area is blank or not If not then get exact company url with area If area is not correct then result not found
			if(!empty($sub_location))
			{
				$business->where('area', $sub_location);
			}
			else	// If area not selected then auto create page url with exact location
			{
				$business->where('city', $location);
			}

			$business->select('page_url', 'encoded_params');

			//echo ($business->tosql()); exit;

			$row = $business->first();
		}

		if(!empty($row->page_url))
		{
			echo $row->page_url.'||'.$row->encoded_params;
		}
		else
		{
			echo 0;
		}
		exit;
	}

    // Get campany area
    public function getCompanyArea(Request $request)
    {
        $filter_title = $request->filter_title;

        // Get all cities of rajasthan state
        $company = DB::table('user_location')->where('business_name', $filter_title)->first();

        echo $company->area;
        exit;
    }

    # Get category details
    public function getCategoryDetails(Request $request)
    {
        $cat_id = $request->id;

        // Get category details according to category id
        $category = DB::table('category')->where('id', $cat_id)->first();

        echo json_encode($category);
        exit;
    }

    # Get subcategory details according to subcategory id
    public function getSubCategoryDetails(Request $request)
    {
        $subcat_id = $request->id;

        // Get subcategory details according to subcategory id
        $subcategory = DB::table('subcategory')->where('id', $subcat_id)->first();

        echo json_encode($subcategory);
        exit;
    }

    # Get page titles data
    public function getPageUrlTitles(Request $request)
    {
        $row_id = $request->id;

        // Get page titles data according to row id
        $data = DB::table('websites_page_head_titles')->where('id', $row_id)->first();

        echo json_encode($data);
        exit;
    }

    #save keywords by admin
    public function save_keywords_by_admin(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $currentuserid = $request->user_id;
        $checked_keywords = $request->checked_keywords;

        // First check if this keyword is already exist or not
        foreach ($checked_keywords as $key => $word) {
            $temp = explode("-", $word);
            $key_word = $temp[0];
            $key_identity = $temp[1];

            // Get old keywords to match current keywords
            $where = array('user_id' => $currentuserid, 'status' => 1, 'keyword_id' => $key_word, 'keyword_identity' => $key_identity);
            $exist = DB::table('user_keywords')->where($where)->first();
            
            if(!empty($exist))
            {
                echo 1;
                exit;
            }
        }

        // Insert keywords in database table If all is well
        foreach ($checked_keywords as $key => $keyword) {
            $temp = explode("-", $keyword);
            $key_word = $temp[0];
            $key_identity = $temp[1];

            $insert = DB::table('user_keywords')->insert([
                'user_id' => $currentuserid,
                'keyword_id' => $key_word,
                'keyword_identity' => $key_identity,
                'created_at' => $date,
                'updated_at' => $date,
                'update_status' => 1,
                'status' => 1
            ]);
        }
        echo 0;

    }

    // Get saved keywords
    public function getSavedKeywords_By_Admin(Request $request)
    {
        $currentuserid = $request->user_id;

        $saved_keywords = '';

        $where = array('user_id' => $currentuserid, 'status' => 1);

        $keywords = DB::table('user_keywords')->where($where)->get();

        foreach ($keywords as $key => $words) {

            if($words->keyword_identity == 1)
            {
                $category = DB::table('category')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$category->id.'_1">'.$category->category.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" title="Delete" id="delete_'.$category->id.'_1"></i></div>';
            }
            else
            {
                $subcategory = DB::table('subcategory')->where('id', $words->keyword_id)->first();

                $saved_keywords .= '<div class="col-md-4 keywords p0" id="keyword_'.$subcategory->id.'_2">'.$subcategory->subcategory.' &nbsp;&nbsp;<i class="fa fa-times deleteKeyword red text-right" title="Delete" id="delete_'.$subcategory->id.'_2"></i></div>';
            }
        }

        echo $saved_keywords;
        exit;
    }

    #delete keywords by admin
    public function delete_keywords_by_admin(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $user_id = $request->user_id;
       
        $keyword_id = $request->keyword_id;
        $keyword_identity = $request->keyword_identity;

        $where = array('user_id' => $user_id, 'keyword_id' => $keyword_id, 'keyword_identity' => $keyword_identity);

        $delete = DB::table('user_keywords')->where($where)->update(
            array(
                'updated_at' => $date,
                'status' => 0
            )
        );

        echo 1; exit;

    }

    # Get visible areas according to keyword
    public function getVisibleAreasAccordingToKeyword(Request $request)
    {
        $keyword = $request->keyword;
        $user_id = $request->user_id;

        $temp = explode('_', $keyword);
        $keyword_id = $temp[0];
        $keyword_identity = $temp[1];

        $data = DB::table('user_area_visibility')->where(['user_id' => $user_id, 'keyword_id' => $keyword_id, 'keyword_identity' => $keyword_identity])->get();

        echo json_encode($data);
        exit;
    }

    # Get assignes clients to this keyword
    public function getAssignedClientsToThisKeyword(Request $request)
    {
        $keyword = $request->keyword;
        $keyword_identity = $request->keyword_identity;
        $city = $request->city;

        $data = DB::table('keyword_city_client_visibility')->where(['keyword' => $keyword, 'keyword_identity' => $keyword_identity, 'city' => $city])->get();

        echo json_encode($data);
        exit;
    }

    // Get similar companies during add new company / client
    public function getSimilarCompany(Request $request)
    {
        $term = $request->term;
        $data = array();
       
        // Get all Comopany names according to search keyword if company is approved by admin
        $business = DB::table('user_location');
        $business->join('user_details', 'user_details.user_id', '=', 'user_location.user_id');
        $business->where('business_name','LIKE','%'.$term.'%');
        $business->select('user_location.*', 'user_details.name', 'user_details.email', 'user_details.phone', 'user_details.mobile', 'user_details.whatsapp', 'user_details.toll_free1', 'user_details.website', 'user_details.phone', 'user_details.landline', 'user_details.about_company');
        $business = $business->get();

        foreach ($business as $busi) {

            //$data[] = array('client_uid'=>$busi->user_id,'client_company'=>$busi->business_name);
            $data[] = $busi;
        }

        if(count($data)){
            return $data;            
        }
    }

    // Suggest new category by sales / support / client user
    public function suggestForNewKeyword(Request $request){

        $category = $request->category;
        $date = date('Y-m-d H:i:s');
        
        // Save new suggested category
        $save = DB::table('category_suggestions')->insert([

            'user_id'    => Auth::user()->id,
            'category'   => $category,
            'status'     => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if($save):

            echo 1;
        else:
            echo 0;
        endif;
    }

    // Compare client old and new updated data for approval by admin
    public function compareClientInformation(Request $request){

        $row_id = $request->id;
        $temp = explode('_', $row_id);

        // Get new updated data for this row
        $new_data = DB::table('admin_approvals_for_updates')->where('id', $temp[1])->first();

        $fields_for_updation = json_decode($new_data->fields);
        
        $table = '<input type="hidden" name="row_id" value="'.$new_data->id.'"><input type="hidden" name="client_uid" value="'.$new_data->client_uid.'"><input type="hidden" name="status" value="'.$new_data->status.'"><table class="table table-bordered"><thead><tr><th scope="col">Title</th><th scope="col">Old Information</th><th scope="col">New Information</th></tr></thead><tbody>';

            // Get old data for this client to compare
            // If status is 1 then get basic information
            if($new_data->status == 1):

                $user_details = DB::table('user_details')->where('user_id', $new_data->client_uid)->first();
                $user_location = DB::table('user_location')->where('user_location.user_id', $new_data->client_uid)->join('areas', 'areas.id', '=', 'user_location.area')->join('cities', 'cities.id', '=', 'user_location.city')->select('user_location.*', 'areas.area as area_name', 'cities.name as city_name')->first();
                $user_keywords = DB::table('user_keywords')->where('user_id', $new_data->client_uid)->get();
                
                // Get area name
                $new_area = DB::table('areas')->where('id', $fields_for_updation->area)->first();
                // Get city name
                $new_city = DB::table('cities')->where('id', $fields_for_updation->city)->first();

                if($user_location->business_name != $fields_for_updation->company_name){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Company Name </th> <td>'.$user_location->business_name.'</td> <td>'.$fields_for_updation->company_name.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Company Name </th> <td>'.$user_location->business_name.'</td> <td>'.$fields_for_updation->company_name.'</td> </tr>';
                }

                if($user_details->name != $fields_for_updation->name){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Name </th> <td>'.$user_details->name.'</td> <td>'.$fields_for_updation->name.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Name </th> <td>'.$user_details->name.'</td> <td>'.$fields_for_updation->name.'</td> </tr>';
                }

                if($user_details->phone != $fields_for_updation->phone){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Phone </th> <td>'.$user_details->phone.'</td> <td>'.$fields_for_updation->phone.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Phone </th> <td>'.$user_details->phone.'</td> <td>'.$fields_for_updation->phone.'</td> </tr>';
                }

                if($user_location->building != $fields_for_updation->building){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Building </th> <td>'.$user_location->building.'</td> <td>'.$fields_for_updation->building.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Building </th> <td>'.$user_location->building.'</td> <td>'.$fields_for_updation->building.'</td> </tr>';
                }

                if($user_location->street != $fields_for_updation->street){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Street </th> <td>'.$user_location->street.'</td> <td>'.$fields_for_updation->street.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Street </th> <td>'.$user_location->street.'</td> <td>'.$fields_for_updation->street.'</td> </tr>';
                }

                if($user_location->landmark != $fields_for_updation->landmark){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Landmark </th> <td>'.$user_location->landmark.'</td> <td>'.$fields_for_updation->landmark.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Landmark </th> <td>'.$user_location->landmark.'</td> <td>'.$fields_for_updation->landmark.'</td> </tr>';
                }

                if($user_location->country != $fields_for_updation->country){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Country </th> <td>'.$user_location->country.'</td> <td>'.$fields_for_updation->country.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Country </th> <td>'.$user_location->country.'</td> <td>'.$fields_for_updation->country.'</td> </tr>';
                }

                if($user_location->state != $fields_for_updation->state){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> State </th> <td>'.$user_location->state.'</td> <td>'.$fields_for_updation->state.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> State </th> <td>'.$user_location->state.'</td> <td>'.$fields_for_updation->state.'</td> </tr>';
                }

                if($user_location->city != $fields_for_updation->city){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> City </th> <td>'.$user_location->city.'</td> <td>'.$fields_for_updation->city.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> City </th> <td>'.$user_location->city_name.'</td> <td>'.$new_city->name.'</td> </tr>';
                }

                if($user_location->area != $fields_for_updation->area){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Area </th> <td>'.$user_location->area.'</td> <td>'.$fields_for_updation->area.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Area </th> <td>'.$user_location->area_name.'</td> <td>'.$new_area->area.'</td> </tr>';
                }

                if($user_location->pincode != $fields_for_updation->pin_code){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Pincode </th> <td>'.$user_location->pincode.'</td> <td>'.$fields_for_updation->pin_code.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Pincode </th> <td>'.$user_location->pincode.'</td> <td>'.$fields_for_updation->pin_code.'</td> </tr>';
                }

                if($user_details->mobile != $fields_for_updation->mobile){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Mobile Number </th> <td>'.$user_details->mobile.'</td> <td>'.$fields_for_updation->mobile.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Mobile Number </th> <td>'.$user_details->mobile.'</td> <td>'.$fields_for_updation->mobile.'</td> </tr>';
                }

                if($user_details->whatsapp != $fields_for_updation->whatsapp){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Whatsapp Number </th> <td>'.$user_details->whatsapp.'</td> <td>'.$fields_for_updation->whatsapp.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Whatsapp Number </th> <td>'.$user_details->whatsapp.'</td> <td>'.$fields_for_updation->whatsapp.'</td> </tr>';
                }

                if($user_details->landline != $fields_for_updation->landline){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Landline Number </th> <td>'.$user_details->landline.'</td> <td>'.$fields_for_updation->landline.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Landline Number </th> <td>'.$user_details->landline.'</td> <td>'.$fields_for_updation->landline.'</td> </tr>';
                }

                if($user_details->toll_free1 != $fields_for_updation->toll_free){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Toll Free Number </th> <td>'.$user_details->toll_free1.'</td> <td>'.$fields_for_updation->toll_free.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Toll Free Number </th> <td>'.$user_details->toll_free1.'</td> <td>'.$fields_for_updation->toll_free.'</td> </tr>';
                }

                if($user_details->about_company != $fields_for_updation->about_company){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> About Company </th> <td>'.$user_details->about_company.'</td> <td>'.$fields_for_updation->about_company.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> About Company </th> <td>'.$user_details->about_company.'</td> <td>'.$fields_for_updation->about_company.'</td> </tr>';
                }

                if($user_details->website != $fields_for_updation->website){
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Website </th> <td>'.$user_details->website.'</td> <td>'.$fields_for_updation->website.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Website </th> <td>'.$user_details->website.'</td> <td>'.$fields_for_updation->website.'</td> </tr>';
                }

                // If new keywords submitted for update then get keyword names
                if(isset($fields_for_updation->keyword)):

                    $new_key_words = '';

                    foreach ($fields_for_updation->keyword as $key => $key_word) {
                        
                        $temp = explode('-', $key_word);

                        // If keyword is category
                        if($temp[1] == 1){

                            $category = DB::table('category')->where('id', $temp[0])->first();
                            $new_key_words .= $category->category;
                        }else{

                            // If keyword is subcategory
                            $subcategory = DB::table('subcategory')->where('id', $temp[0])->first();
                            $new_key_words .= $subcategory->subcategory;
                        }
                    }

                    $user_old_keyword = '';
                    // Gel old keywords name to companre
                    foreach ($user_keywords as $key => $user_keyword) {
                        
                        // If keyword is category
                        if($user_keyword->keyword_identity == 1){

                            $category = DB::table('category')->where('id', $user_keyword->keyword_id)->first();
                            $user_old_keyword .= $category->category;
                        }else{

                            // If keyword is subcategory
                            $subcategory = DB::table('subcategory')->where('id', $user_keyword->keyword_id)->first();
                            $user_old_keyword .= $subcategory->subcategory;
                        }
                    }
                    
                    $table .= '<tr class="alert alert-danger"><th scope="row"> Keywords </th> <td>'.$user_old_keyword.'</td> <td>'.$new_key_words.'</td> </tr>';
                endif;

            // If status is 2 then get Payment mode information
            elseif($new_data->status == 2):

                $user_company_information = DB::table('user_company_information')->where('user_id', $new_data->client_uid)->first();

                if($fields_for_updation->establishment_year != $user_company_information->year_establishment){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Establishment Year </th> <td>'.$user_company_information->year_establishment.'</td> <td>'.$fields_for_updation->establishment_year.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Establishment Year </th> <td>'.$user_company_information->year_establishment.'</td> <td>'.$fields_for_updation->establishment_year.'</td> </tr>';
                }

                if($fields_for_updation->annual_turnover != $user_company_information->annual_turnover){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Annual Turnover </th> <td>'.$user_company_information->annual_turnover.'</td> <td>'.$fields_for_updation->annual_turnover.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Annual Turnover </th> <td>'.$user_company_information->annual_turnover.'</td> <td>'.$fields_for_updation->annual_turnover.'</td> </tr>';
                }

                if($fields_for_updation->number_employees != $user_company_information->no_of_emps){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Number Of Employees </th> <td>'.$user_company_information->no_of_emps.'</td> <td>'.$fields_for_updation->number_employees.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Number Of Employees </th> <td>'.$user_company_information->no_of_emps.'</td> <td>'.$fields_for_updation->number_employees.'</td> </tr>';
                }

                if($fields_for_updation->professional_association != $user_company_information->professional_associations){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Professional Associations </th> <td>'.$user_company_information->professional_associations.'</td> <td>'.$fields_for_updation->professional_association.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Professional Associations </th> <td>'.$user_company_information->professional_associations.'</td> <td>'.$fields_for_updation->professional_association.'</td> </tr>';
                }

                if($fields_for_updation->certification != $user_company_information->certifications){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Certifications </th> <td>'.$user_company_information->certifications.'</td> <td>'.$fields_for_updation->certification.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Certifications </th> <td>'.$user_company_information->certifications.'</td> <td>'.$fields_for_updation->certification.'</td> </tr>';
                }

                // Get all old payment modes
                $new_payment_mode = $fields_for_updation->payment_mode;
                $new_payment_mode = explode("|", $new_payment_mode);

                $new_payment_modes = '';

                for($i=0; $i<count($new_payment_mode); $i++)
                {
                    if(isset($new_payment_mode[0])){ $new_payment_mode[0] = "Cash"; }
                    if(isset($new_payment_mode[1])){ $new_payment_mode[1] = "Master"; }                            
                    if(isset($new_payment_mode[2])){ $new_payment_mode[2] = "Visa"; }   
                    if(isset($new_payment_mode[3])){ $new_payment_mode[3] = "Debit"; }  
                    if(isset($new_payment_mode[4])){ $new_payment_mode[4] = "Money"; }  
                    if(isset($new_payment_mode[5])){ $new_payment_mode[5] = "Cheques"; }
                    if(isset($new_payment_mode[6])){ $new_payment_mode[6] = "Credit Card"; } 
                    if(isset($new_payment_mode[7])){ $new_payment_mode[7] = "Travelers Cheque"; }                            
                    if(isset($new_payment_mode[8])){ $new_payment_mode[8] = "Financing Available"; }  
                    if(isset($new_payment_mode[9])){ $new_payment_mode[9] = "American Express Card"; }
                    if(isset($new_payment_mode[10])){ $new_payment_mode[10] = "Diners Club Card"; }

                    $new_payment_modes .= $new_payment_mode[$i] .', ';
            
                }

                // Get all new payment modes
                $payment_mode = $user_company_information->payment_mode;
                $payment_mode = explode("|", $payment_mode);

                $old_payment_modes = '';

                for($i=0; $i<count($payment_mode); $i++)
                {
                    if(isset($payment_mode[0])){ $payment_mode[0] = "Cash"; }
                    if(isset($payment_mode[1])){ $payment_mode[1] = "Master"; }                            
                    if(isset($payment_mode[2])){ $payment_mode[2] = "Visa"; }   
                    if(isset($payment_mode[3])){ $payment_mode[3] = "Debit"; }  
                    if(isset($payment_mode[4])){ $payment_mode[4] = "Money"; }  
                    if(isset($payment_mode[5])){ $payment_mode[5] = "Cheques"; }
                    if(isset($payment_mode[6])){ $payment_mode[6] = "Credit Card"; } 
                    if(isset($payment_mode[7])){ $payment_mode[7] = "Travelers Cheque"; }                            
                    if(isset($payment_mode[8])){ $payment_mode[8] = "Financing Available"; }  
                    if(isset($payment_mode[9])){ $payment_mode[9] = "American Express Card"; }
                    if(isset($payment_mode[10])){ $payment_mode[10] = "Diners Club Card"; }

                    $old_payment_modes .= $payment_mode[$i] .', ';
            
                }

                $new_payment_modes = rtrim($new_payment_modes, ", ");
                $old_payment_modes = rtrim($old_payment_modes, ", ");

                if($fields_for_updation->payment_mode != $user_company_information->payment_mode){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Payment Mode </th> <td>'.$old_payment_modes.'</td> <td>'.$new_payment_modes.'</td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Payment Mode </th> <td>'.$old_payment_modes.'</td> <td>'.$new_payment_modes.'</td> </tr>';
                }

            // If status is 3 then get Business timing information
            elseif($new_data->status == 3):

                $user_other_information = DB::table('user_other_information')->where('user_id', $new_data->client_uid)->get();

                $user_other_information = json_decode(json_encode($user_other_information), True);
                //print_r($user_other_information);

                $old_from_time = array_column($user_other_information, 'from_time');
                $old_to_time = array_column($user_other_information, 'to_time');
                
                $changes_exist = 0;
                $new_from_times = '';
                // Match from time 
                $days_shift = '';
                for ($i=0; $i < count($fields_for_updation->from_time); $i++) { 
                    
                    $temp = explode(':', $old_from_time[$i]);
                    if(count($temp) == 3){

                        $old_from_time[$i] = $temp[0].':'.$temp[1];
                    }

                    if($fields_for_updation->from_time[$i] == 'closed'){
                        $fields_for_updation->from_time[$i] = '00:00';
                    }

                    if($fields_for_updation->from_time[$i] != $old_from_time[$i]):

                        $changes_exist = 1;
                    endif;

                    $new_from_times .= $fields_for_updation->from_time[$i].'<br />';

                    if($i < 7):
                        if($i == 0) : $days_shift .= 'Monday ( Shift 1 )<br />';endif;
                        if($i == 1) : $days_shift .= 'Tuesday ( Shift 1 )<br />';endif;
                        if($i == 2) : $days_shift .= 'Wednesda y( Shift 1 )<br />';endif;
                        if($i == 3) : $days_shift .= 'Thursday ( Shift 1 )<br />';endif;
                        if($i == 4) : $days_shift .= 'Friday ( Shift 1 )<br />';endif;
                        if($i == 5) : $days_shift .= 'Saturday ( Shift 1 )<br />';endif;
                        if($i == 6) : $days_shift .= 'Sunday ( Shift 1 )<br />';endif;
                    else:

                        if($i == 7) : $days_shift .= 'Monday ( Shift 2 )<br />';endif;
                        if($i == 8) : $days_shift .= 'Tuesday ( Shift 2 )<br />';endif;
                        if($i == 9) : $days_shift .= 'Wednesday ( Shift 2 )<br />';endif;
                        if($i == 10) : $days_shift .= 'Thursday ( Shift 2 )<br />';endif;
                        if($i == 11) : $days_shift .= 'Friday ( Shift 2 )<br />';endif;
                        if($i == 12) : $days_shift .= 'Saturday ( Shift 2 )<br />';endif;
                        if($i == 13) : $days_shift .= 'Sunday ( Shift 2 )<br />';endif;
                    endif;
                }

                // Match to time 
                $new_to_times = '';
                for ($i=0; $i < count($fields_for_updation->to_time); $i++) { 
                        
                    $temp = explode(':', $old_to_time[$i]);
                    if(count($temp) == 3){

                        $old_to_time[$i] = $temp[0].':'.$temp[1];
                    }

                    if($fields_for_updation->to_time[$i] == 'closed'){
                        $fields_for_updation->to_time[$i] = '00:00';
                    }

                    if($fields_for_updation->to_time[$i] != $old_to_time[$i]){

                        $changes_exist = 1;
                    }
                    $new_to_times .= $fields_for_updation->to_time[$i].'<br />';
                }

                // Old from times get in a string
                $old_from_times = '';
                foreach ($old_from_time as $key => $o_f_t) {
                    
                    $old_from_times .= $o_f_t.'<br />';
                }

                // Old to times get in a string
                $old_to_times = '';
                foreach ($old_to_time as $key => $o_t_t) {

                    $old_to_times .= $o_t_t.'<br />';
                }

                $changes_class = '';
                if($changes_exist == 1):

                    $changes_class = 'alert alert-danger';
                endif;

                $table .= '<tr class="'.$changes_class.'"><th scope="row"> From Time </th><td>'.$old_from_times.'</td> <td>'.$new_from_times.'</td> </tr>';
                $table .= '<tr class="'.$changes_class.'"><th scope="row"> To Time </th>  <td>'.$old_to_times.'</td> <td>'.$new_to_times.'</td> </tr>';

            // If status is 4 then get Logo and images information
            elseif($new_data->status == 4):

                $user_images = DB::table('user_images')->where('user_id', $new_data->client_uid)->get();
                $user_details = DB::table('user_details')->where('user_id', $new_data->client_uid)->first();

                // Get client old profile images
                $old_p_images = '';
                foreach ($user_images as $key => $old_image) {
                    
                    $old_p_images .= $old_image->image.',';
                }

                // Get client new profile images
                $new_p_images = '';
                foreach ($fields_for_updation as $f_key => $new_image) {
                    
                    if(isset($new_image->photos)){

                        $new_p_images .= $new_image->photos.',';
                    }
                }

                $new_p_images = rtrim($new_p_images, ",");
                $old_p_images = rtrim($old_p_images, ",");
                
                // Create host name to show image link
                $host = $_SERVER['HTTP_HOST'];
                if($host == 'localhost'){

                    $host = 'http://'.$host.'/enquire_us/trunk';
                }else{
                    $host = 'https://'.$host;
                }

                // Break profile images and show
                $old_p_images = explode(',', $old_p_images);

                $show_all_old_images = '';
                foreach ($old_p_images as $key => $o_p_i) {
                    $show_all_old_images .= '<img src="'.$host.'/storage/app/uploads/'.$o_p_i.'" style="width:100px;height: 100px;">';
                }

                $new_p_images = explode(',', $new_p_images);

                $show_all_new_images = '';
                foreach ($new_p_images as $key => $n_p_i) {
                    $show_all_new_images .= '<img src="'.$host.'/storage/app/uploads/'.$n_p_i.'" style="width:100px;height: 100px;">';
                }

                if($new_p_images != $old_p_images){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Profile Images </th> <td> '.$show_all_old_images.' </td> <td>'.$show_all_new_images.'</td> </tr>';
                }else{
                        $table .= '<tr><th scope="row"> Profile Images </th> <td>'.$show_all_old_images.'</td> <td>'.$show_all_new_images.'</td> </tr>';
                }

                if($fields_for_updation->logo != $user_details->logo){

                    $table .= '<tr class="alert alert-danger"><th scope="row"> Logo </th> <td><img src="'.$host.'/storage/app/uploads/'.$user_details->logo.'" style="width:100px;height: 100px;"></td> <td><img src="'.$host.'/storage/app/uploads/'.$fields_for_updation->logo.'" style="width:100px;height: 100px;"></td> </tr>';
                }else{
                    $table .= '<tr><th scope="row"> Payment Mode </th> <td><img src="'.$host.'/storage/app/uploads/'.$user_details->logo.'" style="width:100px;height: 100px;"></td> <td><img src="'.$host.'/storage/app/uploads/'.$fields_for_updation->logo.'" style="width:100px;height: 100px;"></td> </tr>';
                }

            endif;

        $table .= '</tbody></table>';

        echo $table;

    }
}
