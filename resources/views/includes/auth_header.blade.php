<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <!-- If there is any notification available sales user-->
                @if($sales_notifications > 0)
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  
                            <span class="label label-primary">{{ $sales_notifications }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            
                            <!-- If there is any meeting assigned to sales executice -->
                            @if(count($assigned_meeting) > 0)
                            <li>
                                <a href="{{ route('meeting_schedules') }}">
                                    <div>
                                        <i class="fa fa-handshake-o text-info" style="font-size: 16px;"></i>
                                        Assigned Meeting
                                        <span class="pull-right text-muted small badge badge-primary text-white">
                                            {{ count($assigned_meeting) }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                @endif
    
                <!-- If there is any notification available  for support user-->
                @if($support_notifications > 0)
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  
                            <span class="label label-primary">{{ $support_notifications }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            
                            <!-- If there is any meeting assigned to sales executice -->
                            @if(count($seprate_responses) > 0)

                                @foreach($seprate_responses as $key => $response)
                                <li>
                                    <a href="{{ route('client_meeting_response_view', ['meeting_id' => $response['meeting_id'] ]) }}">
                                        <div>
                                            <i class="fa fa-handshake-o text-info" style="font-size: 16px;"></i>
                                            {{ $response['business_name'] }} Meeting Response
                                            <span class="pull-right text-muted small badge badge-primary text-white">
                                                {{ $response['response_count'] }}
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            @endif


                            @if(!empty($todays_followup[0]))

                                @foreach($todays_followup as $key => $followup)
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('client_meeting_response_view', ['meeting_id' => $followup->cats_id]) }}">
                                        <div>
                                            <i class="fa fa-meetup text-info" style="font-size: 16px;"></i>
                                            {{ $followup->business_name }} meeting fixed with {{ $followup->name }} today at {{ $followup->follow_up_date }}
                                        </div>
                                    </a>
                                </li>
                                @endforeach

                            @endif
                        </ul>
                    </li>

                @endif
    
                <!-- If there is any notification available  for support user-->            
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  
                        <span class="label label-primary">{{ $admin_notifications }}</span>
                    </a>
                    @if($admin_notifications > 0)
                        <ul class="dropdown-menu dropdown-alerts">                      
                            <!-- Show umapproved users notification -->
                            <!-- If there is any meeting assigned to sales executice -->
                            @if(count($unapproved_users) > 0)
                                <li>
                                    <a href="{{ route('un_approved_users') }}" style="padding: 0px;">
                                        <div>
                                            <i class="fa fa-ban text-info" style="font-size: 16px;"></i> UnApproved Users
                                            <span class="pull-right text-muted small badge badge-primary text-white">
                                                {{ count($unapproved_users) }}
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            @endif
        
                            <!-- Show new suggested categories -->
                            @if(!empty($new_categories[0]))
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('new_suggested_categories') }}" style="padding: 0px;">
                                    <div>
                                        <i class="fa fa-list-alt text-info" style="font-size: 16px;"></i> New Suggested Categories
                                        <span class="pull-right text-muted small badge badge-primary text-white">
                                            {{ count($new_categories) }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
        
                            <!-- Show notification of user basic information updates -->
                            @if(!empty($basic_information_notifications[0]))

                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('information_update_notifications', ['type' => '1']) }}" style="padding: 0px;">
                                    <div>
                                        <i class="fa fa-list-alt text-info" style="font-size: 16px;"></i> Basic Information Updates
                                        <span class="pull-right text-muted small badge badge-primary text-white">
                                            {{ count($basic_information_notifications) }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
        
                            <!-- Show notification of user payment mode information updates -->
                            @if(!empty($payment_mode_notifications[0]))

                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('information_update_notifications', ['type' => '2']) }}" style="padding: 0px;">
                                    <div>
                                        <i class="fa fa-list-alt text-info" style="font-size: 16px;"></i> Payment Mode Information Updates
                                        <span class="pull-right text-muted small badge badge-primary text-white">
                                            {{ count($payment_mode_notifications) }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
        
                            <!-- Show notification of user business timing information updates -->
                            @if(!empty($business_timing_notifications[0]))

                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('information_update_notifications', ['type' => '3']) }}" style="padding: 0px;">
                                    <div>
                                        <i class="fa fa-list-alt text-info" style="font-size: 16px;"></i> Business Timing Information Updates
                                        <span class="pull-right text-muted small badge badge-primary text-white">
                                            {{ count($business_timing_notifications) }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
        
                            <!-- Show notification of user business timing information updates -->
                            @if(!empty($images_logo_notifications[0]))

                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('information_update_notifications', ['type' => '4']) }}" style="padding: 0px;">
                                    <div>
                                        <i class="fa fa-list-alt text-info" style="font-size: 16px;"></i> Images And Logo Information Updates
                                        <span class="pull-right text-muted small badge badge-primary text-white">
                                            {{ count($images_logo_notifications) }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif

                        </ul>
                    @endif
                </li>
               
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       {{ csrf_field() }}
                    </form>
                </li>

            </ul>
        </nav>
    </div>