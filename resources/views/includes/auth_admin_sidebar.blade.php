 <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="../images/logo.png" style="background: #fff;width: 100px;"/>
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Enquire Us</strong>
                     <b class="caret"></b> </span>  </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
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
                <div class="logo-element">
                    EU
                </div>
            </li>
            <li class="active">
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li><a href=""><i class="fa fa-users"></i> <span class="nav-label">Users</span></a></li>  
		</ul>
	</div>
</nav>