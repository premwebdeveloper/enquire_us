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
                        <img alt="image" class="img-circle" src="resources/assets/images/sad.png" style="background: #fff;width: 100px;"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Enquire Us</strong>
                        <b class="caret"></b> </span>  </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('/') }}"> <i class="fa fa-globe" aria-hidden="true"></i> Go to website </a></li>
                        <li><a href="javascript:;"> <i class="fa fa-user" aria-hidden="true"></i> Profile </a></li>
                        <li><a href="javascript:;"> <i class="fa fa-key" aria-hidden="true"></i> Change Password </a></li>
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
                </div>
            </li>
            <li class="active">
                <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

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
		</ul>
	</div>
</nav>