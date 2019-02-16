<style type="text/css">
    .nav-header
    {
        padding: 15px 25px;
    }
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('resources/assets/images/sad.png') }}" style="background: #fff;width: 100px;"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Hi {{ Auth::user()->name }}</strong>
                        <b class="caret"></b> </span>  </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('/') }}"> <i class="fa fa-globe" aria-hidden="true"></i> Go to website </a></li>
                        <li><a href="javascript:;"> <i class="fa fa-user" aria-hidden="true"></i> Profile </a></li>
                        <li><a href="javascript:;"> <i class="fa fa-key" aria-hidden="true"></i> Change Password </a></li>
                    </ul>
                </div>
            </li>
            
            <?php
            # Get user id
            $currentuserid = Auth::user()->id;            
            # Get User role
            $user = DB::table('user_roles')->where('user_id', $currentuserid)->first();
            # User Role id
            $role_id = $user->role_id;

            /* *********************************************** */
            // If loggedIn user is Admin then show menu in leftbar
            if($role_id == 1):

                ?>
                <li class="active">
                    <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                <li><a href="{{route('employees')}}"><i class="fa fa-users"></i> <span class="nav-label">Employees</span></a></li>

                <li><a href="{{route('users')}}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a></li>

                <li><a href="{{route('superCategories')}}"><i class="fa fa-users"></i> <span class="nav-label">Super Categories</span></a></li>

                <li><a href="{{route('Category')}}"><i class="fa fa-users"></i> <span class="nav-label">Category</span></a></li>

                <li><a href="{{route('subCategory')}}"><i class="fa fa-users"></i> <span class="nav-label">subCategory</span></a></li>

                <li><a href="{{route('area')}}"><i class="fa fa-users"></i> <span class="nav-label">Areas</span></a></li>
                
                <li><a href="{{route('client_area_visibility')}}"><i class="fa fa-users">
                    </i> <span class="nav-label">Client Area Visibility</span></a>
                </li>

                <li><a href="{{route('keyword_city_visibility')}}"><i class="fa fa-users">
                    </i> <span class="nav-label">Keyword City Visibility</span></a>
                </li>

                <li><a href="{{route('slider')}}"><i class="fa fa-users"></i> <span class="nav-label">Home Slider</span></a></li>

                <li><a href="{{route('website_pages')}}"><i class="fa fa-users"></i> <span class="nav-label">Website Pages</span></a></li>

                <li><a href="{{route('page_titles')}}"><i class="fa fa-users"></i> <span class="nav-label">Page Titles</span></a></li>

                <li><a href="{{route('enquiries')}}"><i class="fa fa-users"></i> <span class="nav-label">User Enquiries</span></a></li>

                <li><a href="{{route('category_enquiries')}}"><i class="fa fa-users"></i> <span class="nav-label">Category Enquiries</span></a></li>

                <li><a href="{{route('reviews')}}"><i class="fa fa-users"></i> <span class="nav-label">User Reviews</span></a></li>

                <li><a href="{{route('blogs')}}"><i class="fa fa-users"></i> <span class="nav-label">Blogs</span></a></li>
                <li><a href="{{route('reports')}}"><i class="fa fa-users"></i> <span class="nav-label">Reports</span></a></li>

                <?php
            /* *********************************************** */
            // If loggedIn user is Support then show menu in leftbar
            elseif($role_id == 3):
                ?>

                <li class="active">
                    <a href="{{route('support')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                <li>
                    <a href="{{route('clientMeetings')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Client Meetings</span></a>
                </li>
                <?php
            /* *********************************************** */
            // If loggedIn user is Sales then show menu in leftbar
            elseif($role_id == 6):
                ?>
                <li class="active">
                    <a href="{{route('sales')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                <li>
                    <a href="{{route('meetings')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Client Meetings</span></a>
                </li>
                <li>
                    <a href="{{route('meeting_schedules')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Meeting Schedules</span></a>
                </li>
                <?php
            endif;
            ?>
            
		</ul>
	</div>
</nav>