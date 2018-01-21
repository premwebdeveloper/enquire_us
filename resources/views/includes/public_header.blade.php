<div id="page">
  <header >
    <div class="header-top">
      <div class="container-fluid top-header-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12 pull-right res-header">
            <div class="languageBox" >
                           
                <h2 style="display:none">Language:</h2>
                <p>Need Help? Call us at <strong class="tel-numbel"><a href="tel:+8801984994433">01984-994433</a></strong></p>
            </div>
            <div class="top-link pull-right">
              <ul>
              <li><a href="javascript:;"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Contact</a></li>
              @guest
                <li><a href="{{route('register')}}"><span class="glyphicon glyphicon-edit"></span> Sign Up</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Log In</a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    Login to Enquire Us
                                    <form action="{{ route('login') }}" method="post" accept-charset="utf-8" class="" id="login-nav">      
                                        {{ csrf_field() }}                 
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
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
                                            <button type="submit" class="btn success btn-block">Sign in</button>
                                        </div>
                                        <div class="checkbox">
                                            <div class="help-block text-right"><a href="{{ route('password.request') }}">Forget the password ?</a></div>
                                        </div>
     
                                    </form>

                                </div>
                                <div class="bottom text-center">
                                    New here ? <a style="color:#006a4e;text-decoration:underline;" href="{{route('register')}}">Sign Up</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @else
                    <li><a href="javascript:;""><span class="glyphicon glyphicon-user"></span> My Account</a></li>
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
                        <img  alt="Discount Deals, Offers at savetaka" src="resources/frontend_assets/images/logo.png"/>
                    </a>
                </div>
            </div>
          
          
          
          <div class="col-sm-9">

            <div id="top_search" class="form-group form-group-cus" role="form">
                <div class="form-group  col-sm-1 col-xcus-1">
                  <button id="search-filter" type="button" class="btn success  btn-custom-search">Search</button>
                </div>
                <div class="form-group col-sm-3 col-cus-3 input-width">
                    <select name="top_filter_location" id="top_filter_location" class="form-control selectWidth form-cus input-border">
                        <option value="*">Location</option>
                    </select>
                </div>
                <div class="form-group col-sm-3 col-cus-3 input-width">
                  <select name="top_filter_category_id" id="top_filter_category_id" class="form-control selectWidth form-cus">
                  <option value="*">Category</option><option value="42">E-Commerce</option><option value="1">Food & Drinks</option><option value="47">Telecom Operator</option><option value="36">Hotels & Resorts</option><option value="24">Tours & Travels</option><option value="25">Electronics</option><option value="37">Mobile & Laptop</option><option value="39">Fashion</option><option value="40">Home & Decors</option><option value="41">Books</option><option value="31">Utilities</option><option value="48">Banking</option><option value="43">Cosmetics</option><option value="18">Entertainment</option><option value="34">Beauty</option><option value="30">Gift & Jewellery</option><option value="35">Health & Fitness</option><option value="38">Grocery</option>                      </select>
                </div>
                <div class="form-group col-sm-3 col-cus-3 search-input-key">
                <input type="text" name="top_filter_title" class="form-control form-cus"  placeholder="Type keywords e.g. Burger, Salon, Beauty…">
                </div>
            </div>
                    
          </div>
        </div>
      </div>
    </div>
    <div class="navigation">
      <div class="container">
        <div class="row">
          <nav role="navigation" class="navbar navbar-default"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse row">
              <ul class="nav navbar-nav">
                <!--<li class="active"><a href="http://savetk.com/home">Home</a></li>-->
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="javascript:;">Offline deals</a></li>
                <li><a href="javascript:;">Online deals</a></li>
                <li><a href="javascript:;">Promotions</a></li>
                <li><a href="javascript:;">Stores</a></li>
                <li><a href="javascript:;">Store map</a></li>
                <li><a href="javascript:;">Categories</a></li>
                
                <li><a style="color:#D23D2B;" href="javascript:;">Book food with discount <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>