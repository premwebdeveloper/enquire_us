<div id="page">
    <header>
        <div class="header-top">
            <div class="container-fluid top-header-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 pull-right res-header">

                            <div class="top-link pull-right">
                                <ul>

                                    @guest
                                    <li>
                                        <a href="{{route('register')}}">
                                            <span class="glyphicon glyphicon-edit"></span> Sign Up
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="glyphicon glyphicon-log-in"></span> Log In
                                        </a>
                                        <ul id="login-dp" class="dropdown-menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Login to Enquire Us
                                                        <form action="{{ route('login') }}" method="post" accept-charset="utf-8" class="" id="login-nav">

                                                            {{ csrf_field() }}

                                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                                <label class="sr-only" for="exampleInputEmail2">
                                                                    Email address
                                                                </label>
                                                                <input id="email" type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required autofocus>
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                                <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                                                                @if ($errors->has('password'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('password') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <input type="hidden" name="redirect" value="index.html">
                                                                <button type="submit" class="btn success btn-block">
                                                                    Sign in
                                                                </button>
                                                            </div>

                                                            <div class="checkbox">
                                                                <div class="help-block text-right">
                                                                    <a href="{{ route('password.request') }}">Forget the password ?</a>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                    <div class="bottom text-center">
                                                        New here ? <a class="href_green" href="{{route('register')}}">Sign Up</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    @else
                                        <!-- Get user role by user id -->
                                        @php
                                            $currentuserid = Auth::user()->id;            
                                            $user = DB::table('user_roles')->where('user_id', $currentuserid)->first();
                                            $role_id = $user->role_id;
                                        @endphp
                                        
                                        <!-- If user role is User/client -->
                                        @if($role_id == 2)
                                            <li><a href="{{route('profile')}}""><span class="glyphicon glyphicon-user"></span> My Account</a></li>
                                        @else
                                            
                                            <!-- If user role is not user / client -->
                                            @php
                                                $dashboard = 'dashboard';
                                                
                                                if($role_id == 3):
                                                    $dashboard = 'support';
                                                
                                                elseif($role_id == 6):
                                                    $dashboard = 'sales';
                                                endif;

                                            @endphp

                                            <li><a href="{{route($dashboard)}}""><i class="fa fa-tachometer" aria-hidden="true"></i> Go to dashboard</a></li>
                                        @endif
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                <span class="glyphicon glyphicon-log-out"></span> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-xs-4 res-logo">
                        <div class="logo">
                            <a href="{{url('/')}}">
                                <img alt="Enquire Us" src="{{url('/')}}/resources/frontend_assets/images/enquireus.png"/>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-9">

                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

                        <style type="text/css">
                            .ui-autocomplete {
                                position:absolute;
                                cursor:default;
                                z-index:1001 !important
                            }
                        </style>

                        <div id="top_search" class="form-group form-group-cus" role="form">

                            <!-- Search keyword -->
                            <div class="form-group col-sm-3 col-cus-3 search-input-key">
                                <input type="text" name="filter_title" id="filter_title" class="form-control form-cus"  placeholder="Type keywords e.g. Burger, Salon, Beauty…" required>
                            </div>

                            <!-- Select city -->
                            <div class="form-group col-sm-3 col-cus-3 input-width">
                                <select name="location" id="location" class="form-control selectWidth form-cus input-border">
                                    <option value="3378">Jaipur</option>
                                </select>
                            </div>

                            @php
                                $city = '3378';
                                // Get all cities of rajasthan state
                                $areas = DB::table('areas')->where('city', $city)->get();
                            @endphp
                            
                            <!-- Select area -->
                            <div class="form-group col-sm-3 col-cus-3 input-width">
                                <select name="sub_location" id="sub_location" class="form-control selectWidth form-cus input-border">
                                    <option value="">Select Area</option>
                                    @php $selected = ''; @endphp
                                    @foreach($areas as $area)

                                        @if(isset($selected_area) && !empty($selected_area))
                                            @if($selected_area == $area->id)
                                                @php $selected = 'selected'; @endphp
                                            @else
                                                @php $selected = ''; @endphp
                                            @endif                                            
                                        @endif
                                        <option value="{{ $area->id }}" {{ $selected }}>{{ $area->area }}</option>
                                    @endforeach
                                    <option value="">Select Area</option>
                                </select>
                            </div>

                            <!-- Search button -->
                            <div class="form-group  col-sm-1 col-xcus-1">
                                <button id="search-filter" type="button" class="btn success btn-custom-search" disabled="disabled">Search</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navigation hidden-xs">
          <div class="container">
            <div class="row">
              <nav role="navigation" class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <!-- Collection of nav links, forms, and other content for toggling -->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <!--<li class="active"><a href="http://savetk.com/home">Home</a></li>-->
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="javascript:;">Doctors</a></li>
                    <li><a href="javascript:;">Professional Services</a></li>
                    <li><a href="javascript:;">On Demand Services</a></li>
                    <li><a href="javascript:;">Personal Care</a></li>
                    <li><a href="javascript:;">Real Estate</a></li>
                    <li><a href="javascript:;">Wedding</a></li>                    
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>

    </header>