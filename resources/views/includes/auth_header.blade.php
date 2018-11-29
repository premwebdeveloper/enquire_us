<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <!-- <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="javascript:;" class="pull-left">
                                    <img alt="image" class="img-circle" src="resources/assets/images/sad.png">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="javascript:;">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->
    
                <!-- If there is any notification available -->
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

                            <!-- <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="javascript:;">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li> -->
                        </ul>
                    </li>

                @endif

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