@extends('layouts.auth_app')

@section('content')
<script>
    $(document).ready(function(){
        // Select Area
        $(document).on("change", "#area", function(){
            var area = $('#area').val();
              //alert(city);
            if(area == '')
            {
                $("#pin_code").html('');
                $("#pin_code").html('<option value="" selected="selected">Select Pin Code</option>');
                $("#pin_code").attr('disabled', 'disabled');
            }
            else
            {
                $.ajax({
                    method: 'post',
                    url: '{{ route("getPincodeByAreaForUser") }}',
                    data: {"_token": "{{ csrf_token() }}", 'area' : area},
                    async: true,
                    success: function(response){

                        $("#pin_code").val(response.pincode);
                    },
                    error: function(data){
                        //console.log(data);
                    },
                });
            }
        });
    });
</script>

<style type="text/css">
    .form-horizontal .control-label { padding-top: 0px; padding: 0px; text-align: left; font-size: 11px; }
    .form-horizontal .form-group { margin-left: 0px; }
</style>

<!-- Auto complete js and css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style type="text/css"> .ui-autocomplete { position:absolute; cursor:default; z-index:1001 !important } </style>
<!-- Auto complete js and css -->

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>Add User</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add User</h5>
            </div>
                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="tabs-container">

                            @if(session('status'))
                                <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   {{ session('status') }}
                                </div>
                            @endif
                            
                            @if(!empty($user_details->user_id))
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="{{ route($basic_information_link, ['user_id' => $user_details->user_id]) }}">Basic Information</a></li>
                                    <li><a href="{{ route($payment_modes_link, ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                    <li><a href="{{ route($business_timing_link, ['user_id' => $user_details->user_id]) }}">Business Timing</a></li>
                                    <li><a href="{{ route($logo_images_link, ['user_id' => $user_details->user_id]) }}">Images</a></li>
                                </ul>
                            @else
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="javascript:;">Basic Information</a></li>
                                    <li><a href="javascript:;">Payment Modes</a></li>
                                    <li><a href="javascript:;">Business Timing</a></li>
                                    <li><a href="javascript:;">Images</a></li>
                                </ul>
                            @endif
                            <div class="tab-content">
                                <!-- User Basic information -->
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <!-- If usr edit then update user form -->
                                        @if(!empty($user_details->user_id))

                                            <form method="post" id="editUserForm" class="form-horizontal" action="{{ route('update_admin_user') }}">
                                                <div class="row">

                                                    <h5 style="color:blue;">Basic Detail</h5>
                                                    <hr>

                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="user_id" value="{{ $user_details->user_id }}">
    
                                                    <!-- it will be blank here -->
                                                    <input type="hidden" name="client_uid" value="">
                                                    
                                                    <!-- company name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="company_name" class="col-md-2 control-label">Company Name</label>
                                                            <div class="col-md-10">
                                                                <input id="" type="text" class="form-control" name="company_name" value="{{ $user_details->business_name }}" required="required">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- contact person name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name" class="col-md-2 control-label">Name</label>
                                                            <div class="col-md-10">
                                                                <input id="name" type="text" class="form-control" name="name" value="{{ $user_details->name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Email -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="col-md-2 control-label">E-Mail</label>
                                                            <div class="col-md-10">
                                                                <input id="email" type="text" class="form-control" name="email" value="{{ $user_details->email }}" required="required" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- phone number -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone" class="col-md-2 control-label">Phone</label>
                                                            <div class="col-md-10">
                                                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user_details->phone }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <h5 style="color:blue;">Location Detail</h5><hr>
                                                    
                                                    <!-- building name name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="building" class="col-md-2 control-label">Building</label>
                                                            <div class="col-md-10">
                                                                <input id="building" type="text" class="form-control" name="building" value="{{ $user_details->building }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Street name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="street" class="col-md-2 control-label">Street</label>
                                                            <div class="col-md-10">
                                                                <input id="street" type="text" class="form-control" name="street" value="{{ $user_details->street }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- landmark -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="landmark" class="col-md-2 control-label">Landmark</label>
                                                            <div class="col-md-10">
                                                                <input id="landmark" type="text" class="form-control" name="landmark" value="{{ $user_details->landmark }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- country -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country" class="col-md-2 control-label">Country</label>
                                                            <div class="col-md-10">
                                                                <input id="country" type="text" class="form-control" name="country" value="{{$user_details->country}}" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- state / region -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="state" class="col-md-2 control-label">State/Region</label>
                                                            <div class="col-md-10">
                                                                <input id="state" type="text" class="form-control" name="state" value="{{$user_details->state}}" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function(){
                                                            var area_id = "<?= $user_details->area; ?>";
                                                            $('#area').val(area_id).attr('selected', 'selected');
                                                            
                                                            var city_id = "<?= $user_details->city; ?>";
                                                            $('#city').val(city_id).attr('selected', 'selected');
                                                        });
                                                    </script>

                                                    <!-- city -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="city" class="col-md-2 control-label">City</label>
                                                            <div class="col-md-10">
                                                                <select class="form-control" name="city" id="city" required="required" value="{{ old('city') }}">
                                                                    <option value=""> Select City</option>
                                                                    <option value="3378"> Jaipur</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $city = '3378';
                                                        $areas = DB::table('areas')->where('city', $city)->get();
                                                    ?>

                                                    <!-- area name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password" class="col-md-2 control-label">Area</label>
                                                            <div class="col-md-10">
                                                                <select name="area" id="area" class="form-control" required="required">
                                                                    <option value="">Select Area</option>
                                                                    @foreach($areas as $area)
                                                                        <option value="{{$area->id}}">{{$area->area}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                    
                                                    <!-- pincode -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pin_code" class="col-md-2 control-label">Pin Code</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="pin_code" id="pin_code" class="validate[required] form-control" value="{{$user_details->pincode}}" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <h5 style="color:blue;">Contact Detail</h5><hr>

                                                    <!-- mobile number -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mobile" class="col-md-2 control-label">Mobile Number</label>
                                                            <div class="col-md-10">
                                                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $user_details->mobile }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- landline number -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="whatsapp" class="col-md-2 control-label">Whatsapp Number</label>
                                                            <div class="col-md-10">
                                                                <input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ $user_details->whatsapp }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- landline number -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="landline" class="col-md-2 control-label">Landline No</label>
                                                            <div class="col-md-10">
                                                                <input id="landline" type="text" class="form-control" name="landline" value="{{ $user_details->landline }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- toll free number -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="toll_free" class="col-md-2 control-label">Toll Free No</label>
                                                            <div class="col-md-10">
                                                                <input id="toll_free" type="text" class="form-control" name="toll_free" value="{{ $user_details->toll_free1 }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- website -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website" class="col-md-2 control-label">Website</label>
                                                            <div class="col-md-10">
                                                                <input id="website" type="text" class="form-control" name="website" value="{{ $user_details->website }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- about company -->
                                                <div class="row">
                                                    <h5 style="color:blue;">About Company</h5><hr>

                                                    <!-- About company information -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <textarea id="about_company" type="text" class="form-control summernote" name="about_company"><?= $user_details->about_company;?></textarea>
                                                            @if ($errors->has('about_company'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('about_company') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Add business keyword -->
                                                    <div class="col-md-6">
                                                        <div class="panel-body">
                                                            <h4>Business Keywords</h4>

                                                            <!-- Searched result will show here -->
                                                            <div class="col-sm-12 alert alert-warning" style="margin-bottom: 20px;">
                                                                <div id="savedKeywords"> 
                                                                    <!-- Show already exist keywords here -->
                                                                    @if($saved_keywords != '')
                                                                        {!! $saved_keywords !!}
                                                                    @else
                                                                        <b>There is no keyword assigned !</b>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <script>
                                                            $(document).ready(function(){
                                                                // Delete keyword
                                                                $(document).on('click', '.deleteKeyword', function(){
                                                                    var id = $(this).attr('id');
                                                                    var temp = id.split('_');
                                                                    var keyword_id = temp[1];
                                                                    var keyword_identity = temp[2];                                     
                                                                    var user_id = "<?= $user_details->user_id;?>";

                                                                    $.ajax({
                                                                        method : 'post',
                                                                        url : '{{ route("delete_keywords_by_admin") }}',
                                                                        async : true,
                                                                        data : {"_token": "{{ csrf_token() }}", 'keyword_id': keyword_id, 'keyword_identity': keyword_identity, 'user_id': user_id},
                                                                        success:function(response){
                                                                            if(response == 1)
                                                                            {
                                                                                $("#keyword_"+keyword_id+"_"+keyword_identity+"").remove();
                                                                            }
                                                                        },
                                                                        error: function(data){
                                                                            //console.log(data);
                                                                        },
                                                                    });
                                                                });                                                                
                                                            });
                                                        </script>

                                                        <!-- Add keyword section -->
                                                        <div class="panel-body" id="add_keyword">
                                                            <h4>Search Business Keywords <span class="red">*</span> </h4>
                                                            <fieldset>
                                                                <div class="controls">
                                                                    <div class="form-group required">
                                                                        <!-- <div class="col-sm-9"> -->
                                                                        <input class="form-control" name="search_keywords" id="search_keywords" type="text" placeholder="Search Keyword ...">
                                                                    </div>
                                                                </div>
                                                            </fieldset>

                                                            <!-- Show searched keyword here -->
                                                            <div class="col-lg-12" style="margin-bottom: 10px;">
                                                                <div id="keyword_searched_result"> </div>
                                                            </div>

                                                            <!-- Keyword suggestion section / Only Not admin users can suggest -->
                                                            @if(Auth::user()->id != 1)
                                                                <div class="row" id="categorySuggestionSection">                                                   
                                                                    <div class="col-md-12 text-left">
                                                                        <h4>If you do not find the keyword then suggest for new keyword</h4> 
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control suggest_keyword" id="first_keyword_suggest" name="suggest_keyword[]" type="text" placeholder="Suggest Keyword">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <!-- Add more keyword for suggestion -->
                                                                        <a href="javascript:;" class="btn btn-success btn-sm add_more_suggest_keyword" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                    <!-- Append more suggest keyword in this div -->
                                                                    <div id="append_more_keyword_suggestion"></div>
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                                <div class="clearfix">&nbsp;</div>

                                                <div class="col-md-12 text-right">
                                                    <input type="submit" name="editUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
                                                </div>

                                            </form>

                                        @else
                                            <!-- Add new user form -->
                                            <form method="post" id="addUserForm" class="form-horizontal" action="{{ route('add_user') }}">
                                                <div class="row">
                                                    <h5 style="color:blue;">Basic Detail</h5>
                                                    <hr>
                                                    {{ csrf_field() }}
                                                    
                                                    <!-- current location of user -->
                                                    <input type="hidden" name="current_location" id="current_location">
                                                    
                                                    <!-- user id / if any user update client information during autocomplete search -->
                                                    <input type="hidden" name="client_uid" id="client_uid">
        
                                                    <!-- company name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Company Name <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="company_name" type="text" class="form-control new_company_name" name="company_name" value="{{ old('company_name') }}" required="required">

                                                                @if ($errors->has('company_name'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('company_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <!-- contact person name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name" class="col-md-2 control-label">Name <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required">

                                                                @if ($errors->has('name'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <!-- Email -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="col-md-2 control-label">E-Mail <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required="required">

                                                                @if ($errors->has('email'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- phone -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone" class="col-md-2 control-label">Phone <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required="required">

                                                                @if ($errors->has('phone'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Password -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password" class="col-md-2 control-label">Password <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="password" type="password" class="form-control" name="password" required="required">

                                                                @if ($errors->has('password'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('password') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <!-- Confirm Password -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password-confirm" class="col-md-2 control-label">Confirm Password <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="required">

                                                                @if ($errors->has('password_confirmation'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <h5 style="color:blue;">Location Detail</h5>
                                                    <hr>
        
                                                    <!-- Building Name -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="building" class="col-md-2 control-label">Building</label>

                                                            <div class="col-md-10">
                                                                <input id="building" type="text" class="form-control" name="building" value="{{ old('building') }}">

                                                                @if ($errors->has('building'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('building') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Street -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="street" class="col-md-2 control-label">Street</label>

                                                            <div class="col-md-10">
                                                                <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}">

                                                                @if ($errors->has('street'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('street') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Landmark -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="landmark" class="col-md-2 control-label">Landmark</label>

                                                            <div class="col-md-10">
                                                                <input id="landmark" type="text" class="form-control" name="landmark" value="{{ old('landmark') }}">

                                                                @if ($errors->has('landmark'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('landmark') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <!-- Country -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country" class="col-md-2 control-label">Country <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="country" type="text" class="form-control" name="country" value="India" readonly="">

                                                                @if ($errors->has('country'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('country') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- State -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="state" class="col-md-2 control-label">State/Region <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input id="state" type="text" class="form-control" name="state" value="Rajasthan" readonly="">

                                                                @if ($errors->has('state'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('state') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- City -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="city" class="col-md-2 control-label">City <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <select class="form-control" name="city" id="city" required="required" value="{{ old('city') }}">

                                                                    <option value=""> Select City</option>
                                                                    <option value="3378"> Jaipur</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <!-- Area -->
                                                    <?php
                                                        $city = '3378';
                                                        $areas = DB::table('areas')->where('city', $city)->get();
                                                    ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="area" class="col-md-2 control-label">Area <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <select name="area" id="area" class="form-control" required="required">

                                                                    <option value="">Select Area</option>

                                                                    @foreach($areas as $area)
                                                                        <option value="{{$area->id}}">{{$area->area}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>                                                

                                                    <!-- Pin code -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pin_code" class="col-md-2 control-label">Pin Code <span class="red">*</span> </label>

                                                            <div class="col-md-10">
                                                                <input type="text" name="pin_code" id="pin_code" class="validate[required] form-control" readonly="">

                                                                @if ($errors->has('pin_code'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('pin_code') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <h5 style="color:blue;">Contact Detail</h5>
                                                    <hr>
        
                                                    <!-- Phone 2 -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mobile" class="col-md-2 control-label">Mobile Number</label>

                                                            <div class="col-md-10">
                                                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">

                                                                @if ($errors->has('mobile'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- whatsapp number -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="whatsapp" class="col-md-2 control-label">Whatsapp Number</label>

                                                            <div class="col-md-10">
                                                                <input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ old('whatsapp') }}">

                                                                @if ($errors->has('whatsapp'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('whatsapp') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- landline -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="landline" class="col-md-2 control-label">Landline No</label>

                                                            <div class="col-md-10">
                                                                <input id="landline" type="text" class="form-control" name="landline" value="{{ old('landline') }}">

                                                                @if ($errors->has('landline'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('landline') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Toll Free -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="toll_free" class="col-md-2 control-label">Toll Free No</label>

                                                            <div class="col-md-10">
                                                                <input id="toll_free1" type="text" class="form-control" name="toll_free" value="{{ old('toll_free') }}">

                                                                @if ($errors->has('toll_free'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('toll_free') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website" class="col-md-2 control-label">Website</label>

                                                            <div class="col-md-10">
                                                                <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}">

                                                                @if ($errors->has('website'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('website') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <!-- About company information using editor -->
                                                    <h5 style="color:blue;">About Company</h5><hr>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            
                                                            <div class="col-md-12">
                                                                <textarea id="about_company" type="text" class="form-control summernote" name="about_company"></textarea>

                                                                @if ($errors->has('about_company'))
                                                                    <span class="help-block red">
                                                                        <strong>{{ $errors->first('about_company') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Add business keyword -->
                                                    <div class="col-md-6">

                                                        <!-- If employee edit user by autocomplete search then show exist keyword here -->
                                                        <div class="col-md-12 alert alert-warning" id="showKeywordsByAutocomplereSearch" style="display: none;">
                                                                
                                                            <script>
                                                                $(document).ready(function(){
                                                                    // Delete keyword
                                                                    $(document).on('click', '.deleteKeyword', function(){
                                                                        var id = $(this).attr('id');
                                                                        var temp = id.split('_');
                                                                        var keyword_id = temp[1];
                                                                        var keyword_identity = temp[2];                                     
                                                                        var user_id = $('#client_uid').val();

                                                                        $.ajax({
                                                                            method : 'post',
                                                                            url : '{{ route("delete_keywords_by_admin") }}',
                                                                            async : true,
                                                                            data : {"_token": "{{ csrf_token() }}", 'keyword_id': keyword_id, 'keyword_identity': keyword_identity, 'user_id': user_id},
                                                                            success:function(response){
                                                                                if(response == 1)
                                                                                {
                                                                                    $("#keyword_"+keyword_id+"_"+keyword_identity+"").remove();
                                                                                }
                                                                            },
                                                                            error: function(data){
                                                                                //console.log(data);
                                                                            },
                                                                        });
                                                                    });                                                                
                                                                });
                                                            </script>
                                                        </div>
                                                        
                                                        <!-- Add keyword section -->
                                                        <div class="panel-body1" id="add_keyword">  <!-- style="display:none;" -->
                                                            <h4>Search Business Keywords <span class="red">*</span> </h4>
                                                            <fieldset>
                                                                <div class="controls">
                                                                    <div class="form-group required">
                                                                        <!-- <div class="col-sm-9"> -->  
                                                                        <input class="form-control" name="search_keywords" id="search_keywords" type="text" placeholder="Search Keyword ...">
                                                                    </div>
                                                                </div>
                                                            </fieldset>

                                                            <!-- Show searched keyword here -->
                                                            <div class="col-lg-12" style="margin-bottom: 10px;">
                                                                <div id="keyword_searched_result"> </div>
                                                            </div>
                                                        
                                                            <!-- Keyword suggestion section / Only Not admin users can suggest -->
                                                            @if(Auth::user()->id != 1)
                                                                <div class="row" id="categorySuggestionSection">                                                   
                                                                    <div class="col-md-12 text-left">
                                                                        <h4>If you do not find the keyword then suggest for new keyword</h4> 
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control suggest_keyword" id="first_keyword_suggest" name="suggest_keyword[]" type="text" placeholder="Suggest Keyword">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <!-- Add more keyword for suggestion -->
                                                                        <a href="javascript:;" class="btn btn-success btn-sm add_more_suggest_keyword" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                    <!-- Append more suggest keyword in this div -->
                                                                    <div id="append_more_keyword_suggestion"></div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="clearfix">&nbsp;</div>
    
                                                <!-- save basic information and go to next page -->
                                                <div class="col-md-12 text-right">
                                                    <input type="submit" name="addUser" class="btn btn-success" value="Next" id="addUserBasicInformationButton" disabled="disabled">
                                                </div>

                                            </form>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@endsection