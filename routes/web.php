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

// Home page after login
Route::get('/', 'HomeController@index')->name('/');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('profile', 'Profile@profile')->name('profile');
Route::get('aboutus', 'WebsitePages@aboutus')->name('aboutus');
Route::post('/update_location_info', 'AjaxController@update_location_info')->name('update_location_info');
Route::post('/update_other_info', 'AjaxController@update_other_info')->name('update_other_info');
Route::post('/update_contact_info', 'AjaxController@update_contact_info')->name('update_contact_info');
Route::post('getPincodeByCityForUser', 'AjaxController@getPincodeByCityForUser')->name('getPincodeByCityForUser');

// Search keywords category / sub category
Route::get('searchajax', ['as'=>'searchajax','uses'=>'AjaxController@searchResponse']);

// Get related keywords category / sub category
Route::post('getRelatedCategoryAndSubCatregories', 'AjaxController@getRelatedCategoryAndSubCatregories')->name('getRelatedCategoryAndSubCatregories');

// Save keywords
Route::post('save_keywords', 'AjaxController@save_keywords')->name('save_keywords');

// Get selected keywords
Route::get('getSavedKeywords', 'AjaxController@getSavedKeywords')->name('getSavedKeywords');

// Delete keywords
Route::post('delete_keywords', 'AjaxController@delete_keywords')->name('delete_keywords');

// Upload logo and photos
Route::post('uploadLogoAndPhotos', 'Profile@uploadLogoAndPhotos')->name('uploadLogoAndPhotos');

////////////////////////////////////////////////////////
// Admin Permissions Only Admin can access these urls //
////////////////////////////////////////////////////////
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
	Route::get('dashboard', 'Dashboard@dashboard')->name('dashboard');
	Route::get('users', 'AdminUsers@index')->name('users');
    Route::post('active_inactive', 'AdminUsers@active_inactive')->name('active_inactive');
    Route::get('view', 'AdminUsers@view')->name('view');

    // Category
    Route::get('add_category', 'Categories@add_category')->name('add_category');
    Route::post('addCategory', 'Categories@addCategory')->name('addCategory');
    Route::get('Category', 'Categories@Category')->name('Category');
    Route::post('editCat', 'Categories@editCat')->name('editCat');

    // subCategory
    Route::get('add_subCategory', 'Categories@add_subCategory')->name('add_subCategory');
    Route::post('addSubCategory', 'Categories@addSubCategory')->name('addSubCategory');
    Route::get('subCategory', 'Categories@subCategory')->name('subCategory');
    Route::post('editsubCat', 'Categories@editsubCat')->name('editsubCat');

    // area
    Route::get('add_area', 'Areas@add_area')->name('add_area');
    Route::post('addarea', 'Areas@addarea')->name('addarea');
    Route::get('area', 'Areas@area')->name('area');
    Route::post('update_area', 'Areas@update_area')->name('update_area');

    // Slider As Add / Delete
    Route::get('slider', 'HomeController@slider')->name('slider');
    Route::get('addSlider', 'HomeController@addSlider')->name('addSlider');
    Route::post('add_slider', 'HomeController@add_slider')->name('add_slider');
    Route::post('delete_slider', 'HomeController@delete_slider')->name('delete_slider');

    // Website Pages
    Route::get('website_pages', 'WebsitePages@website_pages')->name('website_pages');
    Route::post('update_page', 'WebsitePages@update_page')->name('update_page');

});