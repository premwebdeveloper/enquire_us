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

        $basic_info_update = DB::table('user_location')->where('user_id', $user_id)->update(

            array(
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
            )
        );

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

        $pincodes = DB::table('areas')->where('area', $area)->get();

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
        $categories = DB::table('category');
        $categories->where('category','LIKE','%'.$term.'%');
        $categories = $categories->get();

        foreach ($categories as $cat) {

            $data[] = array('cat_id'=>$cat->id,'category'=>$cat->category,'status'=>'1'); //,'sub_cat_id'=>'','sub_category'=>''

            // Get sub categories of this category
            $sub_categories = DB::table('subcategory')->where('cat_id', $cat->id)->get();
            foreach ($sub_categories as $key => $sub_cat) {
                //$data[] = array('cat_id'=>$cat->id.'-'.$sub_cat->id,'category'=>$cat->category.'-'.$sub_cat->subcategory);
                $data[] = array('cat_id'=>$sub_cat->id,'category'=>$sub_cat->subcategory,'status'=>'2');
            }
        }

        // Get all matched sub categories and their category and show
        $subcategories = DB::table('subcategory');
        $subcategories->where('subcategory','LIKE','%'.$term.'%');
        $subcategories = $subcategories->get();

        foreach ($subcategories as $subcat) {
            $data[] = array('cat_id'=>$subcat->id,'category'=>$subcat->subcategory,'status'=>'2');

            // Get main category of this sub category
            $cate = DB::table('category')->where('id', $subcat->cat_id)->first();

            $avail = 0;
            foreach ($data as $key => $d) {
                if($d['cat_id'] == $cate->id && $d['status'] == 1)
                {
                    $avail++;
                }
            }

            if($avail == 0)
            {
                $data[] = array('cat_id'=>$cate->id,'category'=>$cate->category,'status'=>'1');
            }
        }

        // Get all Comopany names according to search keyword
        $business = DB::table('user_location');
        $business->where('business_name','LIKE','%'.$term.'%');
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

    // Check keyword is exist or not in db
    public function checkKeywordExistOrNot(Request $request)
    {
        $filter_title_attr = $request->filter_title_attr;
        $filter_title = $request->filter_title;

        $temp = explode('-', $filter_title_attr);

        $title_status = $temp[1];

        if($title_status == 1){     // // if selected keyword is category

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

}
