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
                    url: 'getPincodeByAreaForUser',
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
.form-horizontal .control-label
    {
        padding-top: 0px;
        padding: 0px;
        text-align: left;
        font-size: 11px;
    }
.form-horizontal .form-group
    {
        margin-left: 0px;
    }
</style>

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
                            @if(!empty($user_details->user_id))
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="{{ route('addUser_basic_information', ['user_id' => $user_details->user_id]) }}">Basic Information</a></li>
                                    <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                    <li class=""><a href="{{ route('addUser_business_timing', ['user_id' => $user_details->user_id]) }}">Business Timing</a></li>
                                    <li class=""><a href="{{ route('addUser_business_keywords', ['user_id' => $user_details->user_id]) }}">Business Keywords</a></li>
                                    <li class=""><a href="{{ route('addUser_logo_images', ['user_id' => $user_details->user_id]) }}">Images</a></li>
                                </ul>
                            @else
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="javascript:;">Basic Information</a></li>
                                    <li class=""><a href="javascript:;">Payment Modes</a></li>
                                    <li class=""><a href="javascript:;">Business Timing</a></li>
                                    <li class=""><a href="javascript:;">Business Keywords</a></li>
                                    <li class=""><a href="javascript:;">Images</a></li>
                                </ul>
                            @endif
                            <div class="tab-content">
                                <!-- User Basic information -->
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                    @if(!empty($user_details->user_id))

                                        <form method="post" class="form-horizontal" action="{{ route('update_admin_user') }}">
                                            <div class="row">
                                                <h5 style="color:blue;">Basic Detail</h5>
                                                <hr>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user_id" value="{{ $user_details->user_id }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-md-2 control-label">Company Name</label>

                                                        <div class="col-md-10">
                                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ $user_details->business_name }}" required="required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-md-2 control-label">Name</label>

                                                        <div class="col-md-10">
                                                            <input id="name" type="text" class="form-control" name="name" value="{{ $user_details->name }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="col-md-2 control-label">E-Mail</label>

                                                        <div class="col-md-10">
                                                            <input id="email" type="text" class="form-control" name="email" value="{{ $user_details->email }}" required="required" readonly="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="col-md-2 control-label">Phone</label>

                                                        <div class="col-md-10">
                                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $user_details->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            
                                                <h5 style="color:blue;">Location Detail</h5>
                                                <hr>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="building" class="col-md-2 control-label">Building</label>

                                                        <div class="col-md-10">
                                                            <input id="building" type="text" class="form-control" name="building" value="{{ $user_details->building }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="street" class="col-md-2 control-label">Street</label>

                                                        <div class="col-md-10">
                                                            <input id="street" type="text" class="form-control" name="street" value="{{ $user_details->street }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="landmark" class="col-md-2 control-label">Landmark</label>

                                                        <div class="col-md-10">
                                                            <input id="landmark" type="text" class="form-control" name="landmark" value="{{ $user_details->landmark }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country" class="col-md-2 control-label">Country</label>

                                                        <div class="col-md-10">
                                                            <input id="country" type="text" class="form-control" name="country" value="{{$user_details->country}}" readonly="">
                                                        </div>
                                                    </div>
                                                </div>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pin_code" class="col-md-2 control-label">Pin Code</label>

                                                        <div class="col-md-10">
                                                            <input type="text" name="pin_code" id="pin_code" class="validate[required] form-control" value="{{$user_details->pincode}}" readonly="">
                                                        </div>
                                                    </div>
                                                </div>

                                            
                                                <h5 style="color:blue;">Contact Detail</h5>
                                                <hr>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="landline" class="col-md-2 control-label">Landline No</label>

                                                        <div class="col-md-10">
                                                            <input id="landline" type="text" class="form-control" name="landline" value="{{ $user_details->landline }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fax" class="col-md-2 control-label">Fax No</label>

                                                        <div class="col-md-10">
                                                            <input id="fax" type="text" class="form-control" name="fax" value="{{ $user_details->fax1 }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fax2" class="col-md-2 control-label">Fax No 2</label>

                                                        <div class="col-md-10">
                                                            <input id="fax2" type="text" class="form-control" name="fax2" value="{{ $user_details->fax2 }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="toll_free" class="col-md-2 control-label">Toll Free No</label>

                                                        <div class="col-md-10">
                                                            <input id="toll_free" type="text" class="form-control" name="toll_free" value="{{ $user_details->toll_free1 }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="toll_free2" class="col-md-2 control-label">Toll Free No 2</label>

                                                        <div class="col-md-10">
                                                            <input id="toll_free2" type="text" class="form-control" name="toll_free2" value="{{ $user_details->toll_free2 }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="website" class="col-md-2 control-label">Website</label>

                                                        <div class="col-md-10">
                                                            <input id="website" type="text" class="form-control" name="website" value="{{ $user_details->website }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <h5 style="color:blue;">About Company</h5>
                                                <hr>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        
                                                        <div class="col-md-12">
                                                            <textarea id="about_company" type="text" class="form-control summernote" name="about_company"><?= $user_details->about_company;?></textarea>

                                                            @if ($errors->has('about_company'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('about_company') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-right">
                                                <input type="submit" name="addUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
                                            </div>

                                        </form>

                                    @else

                                        <form method="post" class="form-horizontal" action="{{ route('add_user') }}">
                                            <div class="row">
                                                <h5 style="color:blue;">Basic Detail</h5>
                                                <hr>
                                                {{ csrf_field() }}

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-md-2 control-label">Company Name</label>

                                                        <div class="col-md-10">
                                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required="required">

                                                            @if ($errors->has('company_name'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-md-2 control-label">Name</label>

                                                        <div class="col-md-10">
                                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                                            @if ($errors->has('name'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="col-md-2 control-label">E-Mail</label>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="col-md-2 control-label">Phone</label>

                                                        <div class="col-md-10">
                                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                                            @if ($errors->has('phone'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password" class="col-md-2 control-label">Password</label>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-confirm" class="col-md-2 control-label">Confirm Password</label>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country" class="col-md-2 control-label">Country</label>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="state" class="col-md-2 control-label">State/Region</label>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pin_code" class="col-md-2 control-label">Pin Code</label>

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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fax" class="col-md-2 control-label">Fax No</label>

                                                        <div class="col-md-10">
                                                            <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax') }}">

                                                            @if ($errors->has('fax'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('fax') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fax2" class="col-md-2 control-label">Fax No 2</label>

                                                        <div class="col-md-10">
                                                            <input id="fax2" type="text" class="form-control" name="fax2" value="{{ old('fax2') }}">

                                                            @if ($errors->has('fax2'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('fax2') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="toll_free" class="col-md-2 control-label">Toll Free No</label>

                                                        <div class="col-md-10">
                                                            <input id="toll_free" type="text" class="form-control" name="toll_free" value="{{ old('toll_free') }}">

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
                                                        <label for="toll_free2" class="col-md-2 control-label">Toll Free No 2</label>

                                                        <div class="col-md-10">
                                                            <input id="toll_free2" type="text" class="form-control" name="toll_free2" value="{{ old('toll_free2') }}">

                                                            @if ($errors->has('toll_free2'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('toll_free2') }}</strong>
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
                                                <h5 style="color:blue;">About Company</h5>
                                                <hr>
                                                <div class="col-md-12">
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
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-right">
                                            <input type="submit" name="addUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
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