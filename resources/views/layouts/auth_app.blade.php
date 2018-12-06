@include('includes.auth_head')

<!-- Get notifications for sales user -->
@php
	$currentuserid = Auth::user()->id; 
	$user = DB::table('user_roles')->where('user_id', $currentuserid)->first();
	$role_id = $user->role_id;

	$admin_notifications = 0;
	$sales_notifications = 0;
	$support_notifications = 0;

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
	}

	// If logged in user is sales executive
	if($role_id == 6){

		$assigned_meeting = DB::table('client_assigned_to_sales')->where(['assigned_to' => $currentuserid, 'notification_status' => 1])->get();
		
		// if there is any assigned meeting available
		if(!empty($assigned_meeting[0])){
			$sales_notifications ++;
		}
	}

	// If the logged in user support executive
	if($role_id == 3){

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

			if(!empty($meeting_response[0])){			
				foreach($meeting_response as $r_key => $res){
		
					$seprate_responses[$key]['meeting_id'] = $res->cats_id;
					$seprate_responses[$key]['business_name'] = $res->business_name;
					$seprate_responses[$key]['response_count'] = $r_key+1;
				}
				$support_notifications ++;
			}	
		}		
	}

@endphp


@include('includes.auth_admin_sidebar')

@include('includes.auth_header')

	@yield('content')

@include('includes.auth_footer')

@include('includes.auth_footer_scripts')
