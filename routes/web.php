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

////////////////////////////////////////////////////////
// Admin Permissions Only Admin can access these urls //
////////////////////////////////////////////////////////
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
	Route::get('dashboard', 'Dashboard@dashboard')->name('dashboard');
	Route::get('users', 'AdminUsers@index')->name('users');
    Route::post('delete', 'AdminUsers@delete')->name('delete');
    Route::get('view', 'AdminUsers@view')->name('view');
});