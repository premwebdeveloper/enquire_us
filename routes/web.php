<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
    Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

    # Home page after login
    Route::any('/', 'HomeController@index')->name('/');
    Route::any('/home', 'HomeController@index')->name('home');
    # Filter data according to location and any keyword
    Route::any('filter/{location}/{page_url}/{encoded}', [
        "uses" => 'HomeController@filter',
        "as" => 'filter'
    ]);
    # Get all clients for perticular category
    Route::any('category/{category}/{id}', 'HomeController@category');
    Route::any('webpage/{webpage}', 'HomeController@webpage');
    Route::any('view/{business_url}/{id}', 'HomeController@view')->name('view');

    # Subcribers route
    Route::post('subscribers', 'HomeController@subscribers')->name('subscribers');

/* ******************************************************************************************************** */
/* ************************************** User routes after login **************************************** */
/* ****************************************************************************************************** */

    Route::get('profile', 'Profile@profile')->name('profile');


/* ******************************************************************************************************** */
/* ************************************** Ajax controller routes ***************************************** */
/* ****************************************************************************************************** */

    Route::get('searchCategoriesAndCompanies', ['as'=>'searchCategoriesAndCompanies','uses'=>'AjaxController@searchCategoriesAndCompanies']);
    # Get sub categories according to cstegory
    Route::post('getSubcategoriesAccordingToCategory', 'AjaxController@getSubcategoriesAccordingToCategory')->name('getSubcategoriesAccordingToCategory');
    # Get company area
    Route::post('getCompanyArea', 'AjaxController@getCompanyArea')->name('getCompanyArea');
    # Save keywords
    Route::post('getAreasAccordingToCity', 'AjaxController@getAreasAccordingToCity')->name('getAreasAccordingToCity');
    Route::post('/update_location_info', 'AjaxController@update_location_info')->name('update_location_info');
    Route::post('/update_other_info', 'AjaxController@update_other_info')->name('update_other_info');
    Route::post('/update_contact_info', 'AjaxController@update_contact_info')->name('update_contact_info');
    Route::post('getAreaByCityForUser', 'AjaxController@getAreaByCityForUser')->name('getAreaByCityForUser');
    Route::post('getPincodeByAreaForUser', 'AjaxController@getPincodeByAreaForUser')->name('getPincodeByAreaForUser');
    # Check keyword is exist or not in db
    Route::post('checkKeywordExistOrNot', 'AjaxController@checkKeywordExistOrNot')->name('checkKeywordExistOrNot');
    # Search keywords category / sub category
    Route::get('searchajax', ['as'=>'searchajax','uses'=>'AjaxController@searchResponse']);
    # Get related keywords category / sub category
    Route::post('getRelatedCategoryAndSubCatregories', 'AjaxController@getRelatedCategoryAndSubCatregories')->name('getRelatedCategoryAndSubCatregories');
    # Save keywords
    Route::post('save_keywords', 'AjaxController@save_keywords')->name('save_keywords');
    # Get selected keywords
    Route::get('getSavedKeywords', 'AjaxController@getSavedKeywords')->name('getSavedKeywords');
    # Delete keywords
    Route::post('delete_keywords', 'AjaxController@delete_keywords')->name('delete_keywords');
    # Get category details according to category id
    Route::post('getCategoryDetails', 'AjaxController@getCategoryDetails')->name('getCategoryDetails');
    # Get subcategory details according to subcategory id
    Route::post('getSubCategoryDetails', 'AjaxController@getSubCategoryDetails')->name('getSubCategoryDetails');

	# Get page url
	Route::post('getPageUrl', 'AjaxController@getPageUrl')->name('getPageUrl');

    # Get page titles data
    Route::post('getPageUrlTitles', 'AjaxController@getPageUrlTitles')->name('getPageUrlTitles');


    # Upload logo and photos
    Route::post('uploadLogoAndPhotos', 'Profile@uploadLogoAndPhotos')->name('uploadLogoAndPhotos');


/* ******************************************************************************************************** */
/* ********************* Admin Permissions Only Admin can access these routes **************************** */
/* ****************************************************************************************************** */

// Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
// {
	Route::get('dashboard', 'Dashboard@dashboard')->name('dashboard');
    Route::get('addUser_basic_information', 'AdminUsers@addUser_basic_information')->name('addUser_basic_information');
    Route::any('addUser_payment_modes/{user_id}', 'AdminUsers@addUser_payment_modes')->name('addUser_payment_modes');
    Route::any('addUser_business_timing/{user_id}', 'AdminUsers@addUser_business_timing')->name('addUser_business_timing');
    Route::any('addUser_business_keywords/{user_id}', 'AdminUsers@addUser_business_keywords')->name('addUser_business_keywords');
    Route::get('addUser_logo_images', 'AdminUsers@addUser_logo_images')->name('addUser_logo_images');
    Route::post('add_user', 'AdminUsers@add_user')->name('add_user');
	Route::get('users', 'AdminUsers@index')->name('users');
    Route::post('active_inactive', 'AdminUsers@active_inactive')->name('active_inactive');
    Route::get('view', 'AdminUsers@view')->name('view');

    # Category
    Route::get('add_category', 'Categories@add_category')->name('add_category');
    Route::post('addCategory', 'Categories@addCategory')->name('addCategory');
    Route::get('Category', 'Categories@Category')->name('Category');
    Route::post('editCat', 'Categories@editCat')->name('editCat');
    # Add category club
    Route::get('categoryClubs', 'Categories@categoryClubs')->name('categoryClubs');
    Route::post('create_category_club', 'Categories@create_category_club')->name('create_category_club');
    Route::any('edit_club', 'Categories@edit_club')->name('edit_club.show');
    Route::post('edit_category_club', 'Categories@edit_category_club')->name('edit_category_club');

    # subCategory
    Route::get('add_subCategory', 'Categories@add_subCategory')->name('add_subCategory');
    Route::post('addSubCategory', 'Categories@addSubCategory')->name('addSubCategory');
    Route::get('subCategory', 'Categories@subCategory')->name('subCategory');
    Route::post('editsubCat', 'Categories@editsubCat')->name('editsubCat');

    # area
    Route::get('add_area', 'Areas@add_area')->name('add_area');
    Route::post('addarea', 'Areas@addarea')->name('addarea');
    Route::get('area', 'Areas@area')->name('area');
    Route::post('update_area', 'Areas@update_area')->name('update_area');
	
	# Client area visibility view page
	Route::get('client_area_visibility', 'Areas@client_area_visibility')->name('client_area_visibility');
	# Edit client area visibility page
	Route::any('edit_client_area_visibility', 'Areas@edit_client_area_visibility')->name('edit_client_area_visibility');
	# Edit client area visibility
	Route::post('edit_area_visibility', 'Areas@edit_area_visibility')->name('edit_area_visibility');

    # Slider As Add / Delete
    Route::get('slider', 'AdminUsers@slider')->name('slider');
    Route::get('addSlider', 'AdminUsers@addSlider')->name('addSlider');
    Route::post('add_slider', 'AdminUsers@add_slider')->name('add_slider');
    Route::post('delete_slider', 'AdminUsers@delete_slider')->name('delete_slider');

    # Website Pages
    Route::get('website_pages', 'WebsitePages@website_pages')->name('website_pages');
    Route::post('update_page', 'WebsitePages@update_page')->name('update_page');

    # Website page head titles like Title, Meta title, Keyword, Description etc
    Route::any('page_titles', 'WebsitePages@page_titles')->name('page_titles');

    # Update page titles data
    Route::post('editPageUrlTitle', 'WebsitePages@editPageUrlTitle')->name('editPageUrlTitle');

// });