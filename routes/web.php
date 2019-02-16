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

    Route::get('/sitemap.xml', 'HomeController@sitemap')->name('sitemap.xml');

    Auth::routes();

    // send enquiry route
    Route::post('send_enquiry', 'HomeController@send_enquiry')->name('send_enquiry');

    Route::post('send_multiple_enquiries', 'HomeController@send_multiple_enquiries')->name('send_multiple_enquiries');

    Route::post('review', 'HomeController@review')->name('review');

    Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
    Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

    # Get all clients for perticular category
    Route::any('category/{category}/{id}', 'HomeController@category');
    Route::any('view/{business_url}/{id}', 'HomeController@view')->name('view');

    Route::any('about-us', 'HomeController@aboutus')->name('about-us');

    Route::any('contact-us', 'HomeController@contactus')->name('contact-us');

    # search function / search client by keywords
    Route::get('/{location}/{page_url}/{encoded}', [
        "uses" => 'HomeController@filter',
        "as" => 'filter'
    ]);

    // Show all categories on click super category
    Route::get('categories/{super_cat_id}', 'HomeController@categories')->name('categories');

    # Home page after login
    Route::any('/', 'HomeController@index')->name('/');
    Route::any('/home', 'HomeController@index')->name('home');
    # Filter data according to location and any keyword
    
    # Subcribers route
    Route::post('subscribers', 'HomeController@subscribers')->name('subscribers');

/* ******************************************************************************************************** */
/* ************************************** User routes after login **************************************** */
/* ****************************************************************************************************** */

    Route::get('profile', 'Profile@profile')->name('profile');

    Route::get('enquiry', 'Profile@enquiry')->name('enquiry');


/* ******************************************************************************************************** */
/* ************************************** Ajax controller routes ***************************************** */
/* ****************************************************************************************************** */

    Route::get('searchCategoriesAndCompanies', ['as'=>'searchCategoriesAndCompanies','uses'=>'AjaxController@searchCategoriesAndCompanies']);
    # Get sub categories according to cstegory
    Route::post('getSubcategoriesAccordingToCategory', 'AjaxController@getSubcategoriesAccordingToCategory')->name('getSubcategoriesAccordingToCategory');
    
    # Get categories according to super category
    Route::post('getCatsAccordingToSuperCat', 'AjaxController@getCatsAccordingToSuperCat')->name('getCatsAccordingToSuperCat');

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

    # Get visible areas according to keyword
    Route::post('getVisibleAreasAccordingToKeyword', 'AjaxController@getVisibleAreasAccordingToKeyword')->name('getVisibleAreasAccordingToKeyword');
    
    # Get assignes clients to this keyword
    Route::post('getAssignedClientsToThisKeyword', 'AjaxController@getAssignedClientsToThisKeyword')->name('getAssignedClientsToThisKeyword');
    // Suggest for new keyword
    Route::post('suggestForNewKeyword', 'AjaxController@suggestForNewKeyword')->name('suggestForNewKeyword');

    # Upload logo and photos
    Route::post('uploadLogoAndPhotos', 'Profile@uploadLogoAndPhotos')->name('uploadLogoAndPhotos');


/* ******************************************************************************************************** */
/* ********************* Admin Permissions Only Admin can access these routes **************************** */
/* ****************************************************************************************************** */

// Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
// {

    // ////////////////////////////////// Sales routed ////////////////////////////////////// //
    ///////////////////////////////////////////////////////////////////////////////////////////
    // Client meetings route
    Route::get('meetings', 'Sales@meetings')->name('meetings');    
    Route::get('createMeetingview', 'Sales@createMeetingview')->name('createMeetingview');    
    Route::post('createMeeting', 'Sales@create')->name('createMeeting');


    // ////////////////////////////////// Sales routed ////////////////////////////////////// //
    ///////////////////////////////////////////////////////////////////////////////////////////
    Route::get('clientMeetings', 'Support@clientMeetings')->name('clientMeetings');   

    // Meeting schedules / meeting assigned to sales by support sales person will see there schedules
    Route::get('meeting_schedules', 'Sales@meeting_schedules')->name('meeting_schedules'); 

    // client response view
    Route::get('client_response/{meeting_id}', 'Sales@client_response')->name('client_response'); 

    // Client meeting response
    Route::post('client_meeting_response', 'Sales@client_meeting_response')->name('client_meeting_response');
    
    // client assing to sales person by support user
    Route::post('client_assign_to_sales', 'Support@client_assign_to_sales')->name('client_assign_to_sales');   

    // Assigned meeting view
    Route::get('assigned_meetings/{id}', 'Support@assigned_meetings')->name('assigned_meetings');
    Route::get('client_meeting_response_view/{meeting_id}', 'Support@client_meeting_response_view')->name('client_meeting_response_view');

    // Admin dashboard
	Route::get('dashboard', 'Dashboard@dashboard')->name('dashboard');
    // Support dashboard
    Route::get('support', 'Support@dashboard')->name('support');
    // Sales dashboard
    Route::get('sales', 'Sales@dashboard')->name('sales');

    // Get similar companies during add new company / client
    Route::get('getSimilarCompany', ['as'=>'getSimilarCompany','uses'=>'AjaxController@getSimilarCompany']);

    Route::get('addUser_basic_information', 'AdminUsers@addUser_basic_information')->name('addUser_basic_information');
    Route::any('addUser_payment_modes/{user_id}', 'AdminUsers@addUser_payment_modes')->name('addUser_payment_modes');
    Route::any('addUser_business_timing/{user_id}', 'AdminUsers@addUser_business_timing')->name('addUser_business_timing');
    Route::any('addUser_business_keywords/{user_id}', 'AdminUsers@addUser_business_keywords')->name('addUser_business_keywords');
    Route::any('addUser_logo_images/{user_id}', 'AdminUsers@addUser_logo_images')->name('addUser_logo_images');


    /* ********************************************************************************************************* */
    /* Edit User Routes */
    Route::get('edit_user_basic_information/{user_id}', 'AdminUsers@edit_user_basic_information')->name('edit_user_basic_information');
    // Edit user payment modes
    Route::any('edit_user_payment_modes/{user_id}', 'AdminUsers@edit_user_payment_modes')->name('edit_user_payment_modes');
    // Edit user business information
    Route::any('edit_user_business_timing/{user_id}', 'AdminUsers@edit_user_business_timing')->name('edit_user_business_timing');
    
    // Edit user logo and profile imaged
    Route::any('edit_user_logo_images/{user_id}', 'AdminUsers@edit_user_logo_images')->name('edit_user_logo_images');

    # Get unapproved users show in admin console
    Route::get('un_approved_users', 'AdminUsers@un_approved_users')->name('un_approved_users');

    # Update user status / approve and unapproce user with status
    Route::get('updateUserStatus/{user_id}', 'AdminUsers@updateUserStatus')->name('updateUserStatus');

    # Delete User
    Route::get('deleteUser/{user_id}', 'AdminUsers@deleteUser')->name('deleteUser');
    
    # employees page route
    Route::get('employees', 'Employees@index')->name('employees');
    # add employees form view page
    Route::get('empCreateView', 'Employees@empCreateView')->name('empCreateView');
    # create employee 
    Route::post('createEmployee', 'Employees@create')->name('createEmployee');    
    # edit employee view page
    Route::get('editEmployee/{user_id}', 'Employees@editView')->name('editEmployee');
    # edit employee
    Route::post('employeeEdit', 'Employees@edit')->name('employeeEdit');
    # delete employee
    Route::get('deleteEmployee/{user_id}', 'Employees@delete')->name('deleteEmployee');    


    # User Delete Logo
    Route::get('userDeteteLogo/{user_id}', 'AdminUsers@userDeteteLogo')->name('userDeteteLogo');    

    # User Delete Image
    Route::get('userDeteteImage/{user_id}/image/{image_id}', 'AdminUsers@userDeteteImage')->name('userDeteteImage');

    Route::post('add_user', 'AdminUsers@add_user')->name('add_user');
    Route::post('update_admin_user', 'AdminUsers@update_admin_user')->name('update_admin_user');
	Route::get('users', 'AdminUsers@index')->name('users');
    Route::post('active_inactive', 'AdminUsers@active_inactive')->name('active_inactive');
    Route::get('view', 'AdminUsers@view')->name('view');

    # Category
    Route::get('add_category', 'Categories@add_category')->name('add_category');
    Route::post('addCategory', 'Categories@addCategory')->name('addCategory');
    Route::get('Category', 'Categories@Category')->name('Category');
    Route::get('editCategory/{cat_id}', 'Categories@editCategory')->name('editCategory');
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
    Route::get('editSubCategory/{subcat_id}', 'Categories@editSubCategory')->name('editSubCategory');
    Route::post('editsubCat', 'Categories@editsubCat')->name('editsubCat');

    # area
    Route::get('add_area', 'Areas@add_area')->name('add_area');
    Route::post('addarea', 'Areas@addarea')->name('addarea');
    Route::get('area', 'Areas@area')->name('area');
    Route::post('update_area', 'Areas@update_area')->name('update_area');

    # Client area visibility view page
    Route::get('keyword_city_visibility', 'Areas@keyword_city_visibility')->name('keyword_city_visibility');
    # Edit keyword city visibility page
    Route::any('edit_keyword_city_visibility', 'Areas@edit_keyword_city_visibility')->name('edit_keyword_city_visibility');
    # Edit keyword city visibility
    Route::post('edit_city_visibility', 'Areas@edit_city_visibility')->name('edit_city_visibility');
	
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

    Route::get('getPageTitles', 'WebsitePages@getPageTitles')->name('getPageTitles');

    # Update page head titles like Title, Meta title, Keyword, Description etc
    Route::any('update_page_titles', 'WebsitePages@update_page_titles')->name('update_page_titles');

    # Update page titles data
    Route::post('editPageUrlTitle', 'WebsitePages@editPageUrlTitle')->name('editPageUrlTitle');

    # Save Keywords By Admin
    Route::post('save_keywords_by_admin', 'AjaxController@save_keywords_by_admin')->name('save_keywords_by_admin');

    # get Save Keywords By Admin
    Route::post('getSavedKeywords_By_Admin', 'AjaxController@getSavedKeywords_By_Admin')->name('getSavedKeywords_By_Admin');
    
    # Delete Keywords By Admin
    Route::post('delete_keywords_by_admin', 'AjaxController@delete_keywords_by_admin')->name('delete_keywords_by_admin');

    # Compare client old and new updated data for approval by admin
    Route::post('compareClientInformation', 'AjaxController@compareClientInformation')->name('compareClientInformation');

    # Show super categories
    Route::get('superCategories', 'SuperCategories@index')->name('superCategories');

    # Show super categories
    Route::any('createSuperCategory', 'SuperCategories@create')->name('createSuperCategory');
    
    # Show super categories
    Route::any('editSuperCategory/{id}', 'SuperCategories@edit')->name('editSuperCategory');

    Route::any('updateSuperCategory', 'SuperCategories@update')->name('updateSuperCategory');

    Route::get('enquiries', 'Enquiries@enquiries')->name('enquiries');
    
    Route::get('category_enquiries', 'Enquiries@category_enquiries')->name('category_enquiries');

    Route::get('reviews', 'Enquiries@reviews')->name('reviews');
    
    Route::get('review_remove/{id}', 'Enquiries@review_remove')->name('review_remove');

    // Suggest new category
    Route::post('suggest_new_category', 'Categories@suggest_new_category')->name('suggest_new_category');

    # Get new suggested categories
    Route::get('new_suggested_categories', 'AdminUsers@new_suggested_categories')->name('new_suggested_categories');
    
    # Edit suggested category
    Route::post('editSuggestedCategory', 'Categories@editSuggestedCategory')->name('editSuggestedCategory');

    # Approve suggested category
    Route::post('approveSuggestedCategory', 'Categories@approveSuggestedCategory')->name('approveSuggestedCategory');


    // Show all blogs
    Route::get('blogs', 'Blogs@index')->name('blogs');

    // Add blog page view
    Route::get('addBlog', 'Blogs@addBlog')->name('addBlog');

    // Add new blog
    Route::post('createBlog', 'Blogs@create')->name('createBlog');

    // Edit blog page view
    Route::get('editBlog/{blog_id}', 'Blogs@editBlog')->name('editBlog');


    // Show User information update notification
    Route::get('information_update_notifications/{type}', 'Notifications@information_update_notifications')->name('information_update_notifications');

    // Admin approve client updates
    Route::post('admin_approval_for_updates', 'Notifications@admin_approval_for_updates')->name('admin_approval_for_updates');   

    // Show reports page
    Route::get('reports', 'Reports@index')->name('reports');
    Route::get('employees_client_meeting', 'Reports@employees_client_meeting')->name('employees_client_meeting');
    Route::post('generate_employee_client_meeting_report', 'Reports@generate_employee_client_meeting_report')->name('generate_employee_client_meeting_report');

// });