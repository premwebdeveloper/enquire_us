<div id="page">
    <header>
        <div class="header-top">
            <div class="container-fluid top-header-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 pull-right res-header">
                            <div class="languageBox" >
                                <p>Need Help? Call us at <strong class="tel-numbel"><a href="tel:+8426833930">8426833930</a></strong></p>
                            </div>
                            <div class="top-link pull-right">
                                <ul>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Contact</a>
                                    </li>
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
                                                        New here ? <a style="color:#006a4e;text-decoration:underline;" href="{{route('register')}}">Sign Up</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    @else

                                        @if(Auth::user()->id != 1)
                                            <li><a href="{{route('profile')}}""><span class="glyphicon glyphicon-user"></span> My Account</a></li>
                                        @else
                                            <li><a href="{{route('dashboard')}}""><i class="fa fa-tachometer" aria-hidden="true"></i> Go to dashboard</a></li>
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
                                <img  alt="Dexus Media" src="{{url('/')}}/resources/frontend_assets/images/logo.png"/>
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

                        <form method="post">
                            {{ csrf_field() }}
                            <div id="top_search" class="form-group form-group-cus" role="form">

                                <div class="form-group  col-sm-1 col-xcus-1">
                                  <button id="search-filter" type="button" class="btn success btn-custom-search" disabled="disabled">Search</button>
                                </div>

                                <div class="form-group col-sm-3 col-cus-3 input-width">
                                    <select name="sub_location" id="sub_location" class="form-control selectWidth form-cus input-border">
                                    </select>
                                </div>

                                <div class="form-group col-sm-3 col-cus-3 input-width">
                                    <select name="location" id="location" class="form-control selectWidth form-cus input-border">
                                        <option value="jaipur">Jaipur</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3 col-cus-3 search-input-key">
                                    <input type="text" name="filter_title" id="filter_title" class="form-control form-cus"  placeholder="Type keywords e.g. Burger, Salon, Beauty…">
                                </div>

                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){

                                var city = '3378';

                                // Get cities according to state
                                $.ajax({
                                    method : 'post',
                                    url: "{{ route('getAreasAccordingToCity') }}",
                                    async : true,
                                        data : {"_token": "{{ csrf_token() }}", 'city': city},
                                          success:function(response){

                                            $('#sub_location').html(response);

                                          },
                                        error: function(data){
                                        console.log(data);
                                    },
                                });

                                // Autocomplete on search category and firm name
                                $("#filter_title").autocomplete({

                                    source: function( request, response ) {
                                        $.ajax({
                                            url: "{{ route('searchCategoriesAndCompanies') }}",
                                            dataType: "json",
                                            data: {
                                                term : request.term,
                                            },
                                            success: function(data) {

                                                if (data.category !== '' && data.category !== null)
                                                {
                                                    var array = $.map(data, function (item) {
                                                    return {
                                                            label: item.category,
                                                            value: item.cat_id,
                                                            data : item
                                                        }
                                                    });
                                                    response(array)
                                                }
                                            }
                                        });
                                    },
                                    select: function( event, ui ) {
                                        $('#filter_title').val(ui.item.data.category);
                                        var category = ui.item.data.category;
                                        var cat_id = ui.item.data.cat_id;
                                        var status = ui.item.data.status;
                                        $('#filter_title').attr('alt', cat_id+'-'+status);

                                        $('#search-filter').removeAttr('disabled', 'disabled');

                                        return false;
                                    }
                                });

                                // Onclick search button
                                $(document).on('click', '#search-filter', function(){

                                    var location = $('#location').val();
                                    var sub_location = $('#sub_location').val();
                                    var filter_title = $('#filter_title').val();

                                    var original_title = filter_title;

                                    // space reolace by dash
                                    location = location.replace(/\s+/g, '-');
                                    filter_title = filter_title.replace(/\s+/g, '-');

                                    if(filter_title == '')
                                    {
                                        alert('Please select any Category or Company name');
                                    }
                                    else
                                    {
                                        var filter_title_alt = $('#filter_title').attr('alt');

                                        // first check filter title keyword is valid or not
                                        $.ajax({
                                            method : 'post',
                                            url: "{{ route('checkKeywordExistOrNot') }}",
                                            async : true,
                                            data : {"_token": "{{ csrf_token() }}", 'filter_title_attr' : filter_title_alt, 'filter_title' : original_title},
                                            success:function(response){

                                                if(response == 1)
                                                {

                                                    // all is well
                                                    var encoded = makeid()+'-'+filter_title_alt;

                                                    if(sub_location != '')
                                                    {
                                                        // space reolace by dash
                                                        sub_location = sub_location.replace(/\s+/g, '-');

                                                        window.location.href = "{{url('filter')}}"+"/"+location+"/" +filter_title+"-in-"+sub_location+"/" +encoded;
                                                    }
                                                    else
                                                    {
                                                        // check selected title is company then
                                                        var what_is_title = filter_title_alt.split('-');
                                                        var title_company = what_is_title[1];
                                                        if(title_company == 3)
                                                        {
                                                            // If sublocation / area not selected then get real area of company
                                                            $.ajax({
                                                                method : 'post',
                                                                url: "{{ route('getCompanyArea') }}",
                                                                async : true,
                                                                data : {"_token": "{{ csrf_token() }}", 'filter_title' : original_title},
                                                                success:function(response){

                                                                    // if area is not blank
                                                                    if(response != '' && response != null)
                                                                    {
                                                                        response = response.replace(/\s+/g, '-');

                                                                        sub_location = sub_location.replace(/\s+/g, '-');

                                                                        window.location.href = "{{url('filter')}}"+"/"+location+"/" +filter_title+"-in-" +response+"/" +encoded;
                                                                    }
                                                                    else
                                                                    {
                                                                        alert('something went wrong!');
                                                                    }
                                                                },
                                                                error: function(data){
                                                                    console.log(data);
                                                                },

                                                            });
                                                        }
                                                        else    // selected title is not company
                                                        {
                                                            sub_location = sub_location.replace(/\s+/g, '-');
                                                            window.location.href = "{{url('filter')}}"+"/"+location+"/" +filter_title+"/" +encoded;
                                                        }

                                                        // window.location.href = "{{url('filter')}}"+"/"+location+"/" +filter_title+"/" +encoded;

                                                    }
                                                }
                                                else
                                                {
                                                    // something went wrong
                                                    alert('Please select any keyword!');
                                                }

                                            },
                                            error: function(data){
                                                console.log(data);
                                            },
                                        });

                                    }
                                });


                            });

                            function makeid() {
                                var text = "";
                                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                                for (var i = 0; i < 8; i++)
                                text += possible.charAt(Math.floor(Math.random() * possible.length));

                                return text;
                            }

                        </script>

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
                  <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
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
                    <li><a style="color:#000;" href="javascript:;">Book food with discount <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>

    </header>