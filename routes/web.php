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

Route::post('/update_location_info', 'AjaxController@update_location_info')->name('update_location_info');

Route::post('/update_other_info', 'AjaxController@update_other_info')->name('update_other_info');

Route::post('/update_contact_info', 'AjaxController@update_contact_info')->name('update_contact_info');

Route::post('getStateByCountryForUser', 'AjaxController@getStateByCountryForUser')->name('getStateByCountryForUser');

Route::post('getStateByStateForUser', 'AjaxController@getStateByStateForUser')->name('getStateByStateForUser');

////////////////////////////////////////////////////////
// Admin Permissions Only Admin can access these urls //
////////////////////////////////////////////////////////
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
	Route::get('dashboard', 'Dashboard@dashboard')->name('dashboard');
	Route::get('users', 'AdminUsers@index')->name('users');
    Route::post('active_inactive', 'AdminUsers@active_inactive')->name('active_inactive');
    Route::get('view', 'AdminUsers@view')->name('view');
    // category
    Route::get('add_category', 'Categories@add_category')->name('add_category');
    Route::post('addCategory', 'Categories@addCategory')->name('addCategory');
    Route::get('Category', 'Categories@Category')->name('Category');
    Route::post('editCat', 'Categories@editCat')->name('editCat');
    // subcategory
    Route::get('add_subCategory', 'Categories@add_subCategory')->name('add_subCategory');
    Route::post('addSubCategory', 'Categories@addSubCategory')->name('addSubCategory');
    Route::get('subCategory', 'Categories@subCategory')->name('subCategory');
    Route::post('editsubCat', 'Categories@editsubCat')->name('editsubCat');
    
});