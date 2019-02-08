@include('includes.auth_head')

<?php	
	// Get current logged in user and user role
	$currentuserid = Auth::user()->id; 
	$user = DB::table('user_roles')->where('user_id', $currentuserid)->first();
	$role_id = $user->role_id;

	// Set notification count is 0 for all users
	$admin_notifications = 0;
	$sales_notifications = 0;
	$support_notifications = 0;

	/* ******************************************************************************** */
	/* ******************************************************************************** */
	// If logged in user is admin
	if($role_id == 1){
		
		// Get unapproved users
		$unapproved_users = DB::table('user_details')->where(['status' => 0])->get();
		if(!empty($unapproved_users[0])){
			$admin_notifications++;
		}

		// Get new suggested categories
		$new_categories = DB::table('category_suggestions')->where(['status' => 1])->get();
		if(!empty($new_categories[0])){
			$admin_notifications++;
		}

		// Get approval notificatin / if there is any entry for update basic information of users by employees
		$basic_information_notifications = DB::table('admin_approvals_for_updates')->where(['notification_status' => 1, 'status' => 1])->get();
		if(!empty($basic_information_notifications[0])){
			$admin_notifications++;
		}

		// Get approval notificatin / if there is any entry for update payment mode information of users by employees
		$payment_mode_notifications = DB::table('admin_approvals_for_updates')->where(['notification_status' => 1, 'status' => 2])->get();
		if(!empty($payment_mode_notifications[0])){
			$admin_notifications++;
		}

		// Get approval notificatin / if there is any entry for update business timing information of users by employees
		$business_timing_notifications = DB::table('admin_approvals_for_updates')->where(['notification_status' => 1, 'status' => 3])->get();
		if(!empty($business_timing_notifications[0])){
			$admin_notifications++;
		}

		// Get approval notificatin / if there is any entry for update Images and logos information of users by employees
		$images_logo_notifications = DB::table('admin_approvals_for_updates')->where(['notification_status' => 1, 'status' => 4])->get();
		if(!empty($images_logo_notifications[0])){
			$admin_notifications++;
		}

	}

	/* ******************************************************************************** */
	/* ******************************************************************************** */
	// If logged in user is sales executive
	if($role_id == 6){

		$assigned_meeting = DB::table('client_assigned_to_sales')->where(['assigned_to' => $currentuserid, 'notification_status' => 1])->get();
		
		// if there is any assigned meeting available
		if(!empty($assigned_meeting[0])){
			$sales_notifications ++;
		}
	}

	/* ******************************************************************************** */
	/* ******************************************************************************** */
	// If the logged in user support executive
	if($role_id == 3){

		/* **************************************************** */
		// get my created client meetings
		$my_meetings = DB::table('client_assigned_to_sales')
		->where(['assigned_by' => $currentuserid, 'status' => 1])
		->get();	
		
		$seprate_responses = array();
		
		// Get meeting response for perticular meeting submitted by sales
		foreach($my_meetings as $key => $my_meet){

			$meeting_response = DB::table('client_meeting_response as cmr')
			->join('client_assigned_to_sales as cats', 'cats.id', '=', 'cmr.cats_id')
			->join('user_location as ul', 'ul.user_id', '=', 'cats.user_id')
			->where(['cmr.cats_id' => $my_meet->id, 'cmr.notification_status' => 1])
			->select('cmr.cats_id', 'ul.business_name')
			->get();

			// If meeting response is not empty
			if(!empty($meeting_response[0])){			
				foreach($meeting_response as $r_key => $res){
		
					$seprate_responses[$key]['meeting_id'] = $res->cats_id;
					$seprate_responses[$key]['business_name'] = $res->business_name;
					$seprate_responses[$key]['response_count'] = $r_key+1;
				}
				$support_notifications ++;
			}	
		}


		/* **************************************************** */
		// Create notification for today's followups  / any support submitted fullowup date for my created clients
		$todays_followup = DB::table('client_assigned_to_sales as cats')
		->join('client_meeting_response as cmr', 'cmr.cats_id', '=', 'cats.id')
		->join('employees as emp', 'emp.user_id', '=', 'cmr.sales_uid')
		->join('user_location as ul', 'ul.user_id', '=', 'cats.user_id')
		->where(['cats.assigned_by' => $currentuserid, 'cmr.possibility' => 3])
		->whereDate('cmr.follow_up_date', '=', date('Y-m-d'))
		->select('cmr.*', 'emp.name', 'ul.business_name')
		->get();

		if(!empty($todays_followup[0])){

			$support_notifications += count($todays_followup);
		}
	}
?>

@include('includes.auth_admin_sidebar')

@include('includes.auth_header')

	@yield('content')

@include('includes.auth_footer')

@include('includes.auth_footer_scripts')
