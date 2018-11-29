@include('includes.auth_head')


<!-- Get notifications for sales user -->
@php
	$currentuserid = Auth::user()->id; 

	$user = DB::table('user_roles')->where('user_id', $currentuserid)->first();

	$role_id = $user->role_id;

	$sales_notifications = 0;
	
	// If logged in user is sales executive
	if($role_id == 6){

		$assigned_meeting = DB::table('client_assigned_to_sales')->where(['assigned_to' => $currentuserid, 'notification_status' => 1])->get();
		
		// if there is any assigned meeting available
		if(!empty($assigned_meeting[0])){

			$sales_notifications ++;
		}
	}		
		
@endphp


@include('includes.auth_admin_sidebar')

@include('includes.auth_header')

	@yield('content')

@include('includes.auth_footer')

@include('includes.auth_footer_scripts')
