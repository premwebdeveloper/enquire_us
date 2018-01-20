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
              <li><a href="contact.html"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Contact</a></li>
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
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" required>

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
                                    New here ? <a style="color:#006a4e;text-decoration:underline;" href="cregister.html">Sign Up</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @else
                    <li><a href="http://savetk.com/caccount"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
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
                    <a href="/">
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
                         <option value="*">Location</option><option value="state_id|322">Dhaka</option><option value="city_id|72">&nbsp;&nbsp;-&nbsp;&nbsp;Agargaon</option><option value="city_id|7">&nbsp;&nbsp;-&nbsp;&nbsp;Badda</option><option value="city_id|35">&nbsp;&nbsp;-&nbsp;&nbsp;Baily Road</option><option value="city_id|40">&nbsp;&nbsp;-&nbsp;&nbsp;Banani </option><option value="city_id|8">&nbsp;&nbsp;-&nbsp;&nbsp;Bandar(Kadamrasul)</option><option value="city_id|9">&nbsp;&nbsp;-&nbsp;&nbsp;Bangshal</option><option value="city_id|34">&nbsp;&nbsp;-&nbsp;&nbsp;Bashundhara City</option><option value="city_id|33">&nbsp;&nbsp;-&nbsp;&nbsp;Bashundhara R/A </option><option value="city_id|2">&nbsp;&nbsp;-&nbsp;&nbsp;Dhanmondi</option><option value="city_id|12">&nbsp;&nbsp;-&nbsp;&nbsp;Gazipur</option><option value="city_id|14">&nbsp;&nbsp;-&nbsp;&nbsp;Gulshan 1</option><option value="city_id|13">&nbsp;&nbsp;-&nbsp;&nbsp;Gulshan-2</option><option value="city_id|39">&nbsp;&nbsp;-&nbsp;&nbsp;Jamuna Future Park</option><option value="city_id|16">&nbsp;&nbsp;-&nbsp;&nbsp;Jatrabari</option><option value="city_id|19">&nbsp;&nbsp;-&nbsp;&nbsp;Kalabagan</option><option value="city_id|74">&nbsp;&nbsp;-&nbsp;&nbsp;Karwan Bazar</option><option value="city_id|21">&nbsp;&nbsp;-&nbsp;&nbsp;Keraniganj</option><option value="city_id|22">&nbsp;&nbsp;-&nbsp;&nbsp;Khilgaon</option><option value="city_id|23">&nbsp;&nbsp;-&nbsp;&nbsp;Khilkhet</option><option value="city_id|24">&nbsp;&nbsp;-&nbsp;&nbsp;Lalbagh</option><option value="city_id|36">&nbsp;&nbsp;-&nbsp;&nbsp;Lalmatia</option><option value="city_id|4">&nbsp;&nbsp;-&nbsp;&nbsp;Mirpur</option><option value="city_id|75">&nbsp;&nbsp;-&nbsp;&nbsp;Mohakhali</option><option value="city_id|6">&nbsp;&nbsp;-&nbsp;&nbsp;Mohammadpur</option><option value="city_id|25">&nbsp;&nbsp;-&nbsp;&nbsp;Motijheel</option><option value="city_id|68">&nbsp;&nbsp;-&nbsp;&nbsp;Narayanganj</option><option value="city_id|26">&nbsp;&nbsp;-&nbsp;&nbsp;New Market</option><option value="city_id|28">&nbsp;&nbsp;-&nbsp;&nbsp;Ramna</option><option value="city_id|30">&nbsp;&nbsp;-&nbsp;&nbsp;Savar</option><option value="city_id|31">&nbsp;&nbsp;-&nbsp;&nbsp;Tejgaon</option><option value="city_id|32">&nbsp;&nbsp;-&nbsp;&nbsp;Uttara</option><option value="state_id|320">Barisal</option><option value="state_id|321">Chittagong</option><option value="city_id|5">&nbsp;&nbsp;-&nbsp;&nbsp;2 no gate</option><option value="city_id|41">&nbsp;&nbsp;-&nbsp;&nbsp;Agrabad</option><option value="city_id|42">&nbsp;&nbsp;-&nbsp;&nbsp;Agrabad access road</option><option value="city_id|43">&nbsp;&nbsp;-&nbsp;&nbsp;Bohoddar hut</option><option value="city_id|44">&nbsp;&nbsp;-&nbsp;&nbsp;CDA avenue</option><option value="city_id|45">&nbsp;&nbsp;-&nbsp;&nbsp;Chandgaon</option><option value="city_id|46">&nbsp;&nbsp;-&nbsp;&nbsp;Chawk bazar</option><option value="city_id|73">&nbsp;&nbsp;-&nbsp;&nbsp;Coxs Bazar</option><option value="city_id|47">&nbsp;&nbsp;-&nbsp;&nbsp;Dampara wasa moor</option><option value="city_id|48">&nbsp;&nbsp;-&nbsp;&nbsp;Double mouring</option><option value="city_id|49">&nbsp;&nbsp;-&nbsp;&nbsp;Foys lake</option><option value="city_id|50">&nbsp;&nbsp;-&nbsp;&nbsp;GEC circle </option><option value="city_id|51">&nbsp;&nbsp;-&nbsp;&nbsp;Gol pahar moor</option><option value="city_id|52">&nbsp;&nbsp;-&nbsp;&nbsp;Halishohor</option><option value="city_id|53">&nbsp;&nbsp;-&nbsp;&nbsp;Jamal khan</option><option value="city_id|54">&nbsp;&nbsp;-&nbsp;&nbsp;Kazir dewri bazar</option><option value="city_id|55">&nbsp;&nbsp;-&nbsp;&nbsp;Khatungonj</option><option value="city_id|56">&nbsp;&nbsp;-&nbsp;&nbsp;Khulshi</option><option value="city_id|57">&nbsp;&nbsp;-&nbsp;&nbsp;Kotoali</option><option value="city_id|58">&nbsp;&nbsp;-&nbsp;&nbsp;Lalkhan bazar</option><option value="city_id|59">&nbsp;&nbsp;-&nbsp;&nbsp;Mehedibag</option><option value="city_id|60">&nbsp;&nbsp;-&nbsp;&nbsp;Muradpur</option><option value="city_id|61">&nbsp;&nbsp;-&nbsp;&nbsp;Nasirabad housing</option><option value="city_id|62">&nbsp;&nbsp;-&nbsp;&nbsp;New station road</option><option value="city_id|63">&nbsp;&nbsp;-&nbsp;&nbsp;O R Nizam road</option><option value="city_id|64">&nbsp;&nbsp;-&nbsp;&nbsp;Pahartoli</option><option value="city_id|65">&nbsp;&nbsp;-&nbsp;&nbsp;Panchlaish</option><option value="city_id|66">&nbsp;&nbsp;-&nbsp;&nbsp;Probortak circle</option><option value="city_id|67">&nbsp;&nbsp;-&nbsp;&nbsp;Tiger pass</option><option value="state_id|323">Khulna</option><option value="state_id|324">Rajshahi</option><option value="state_id|325">Sylhet</option><option value="city_id|70">&nbsp;&nbsp;-&nbsp;&nbsp;Metropolitan Area</option><option value="city_id|71">&nbsp;&nbsp;-&nbsp;&nbsp;Moulvibazar</option><option value="city_id|69">&nbsp;&nbsp;-&nbsp;&nbsp;Sreemongal</option>                     </select>

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
                <li><a href="index.html">Home</a></li>
                <li><a href="latest-offers.html">Offline deals</a></li>
                <li><a href="online.html">Online deals</a></li>
                <li><a href="promotion.html">Promotions</a></li>
                <li><a href="store.html">Stores</a></li>
                <li><a href="location.html">Store map</a></li>
                <li><a href="category/categories.html">Categories</a></li>
                
                <li><a style="color:#D23D2B;" href="food-booking.html">Book food with discount <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>