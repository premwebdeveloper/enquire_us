@extends('layouts.auth_app')

@section('content')

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
<script>
    // Select payment mode
    $(document).on('change', '.checkAll', function(){
        var value = $(this).val();

        if(value == 0)
            {
                if($(this).is(":checked"))
                {
                  $(".payment_mode").prop('checked', true);
                }
                else
                {
                    $(".payment_mode").prop('checked', false);
                }
            }
        });
    $(document).on('click', '.add_keyword', function(){
        $("#add_keyword").show();
        $("#hide_add_button").hide();
    });
</script>
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

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Basic Information</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2">Payment Modes</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3">Business Timing</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4">Business Keywords</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-5">Images</a></li>
                            </ul>

                            <div class="tab-content">
                                <!-- User Basic information -->
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <form method="post" class="form-horizontal" action="{{ route('add_user') }}">
                                            <div class="row">
                                                <h5 style="color:blue;">Basic Detail</h5>
                                                <hr>
                                                {{ csrf_field() }}

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-md-2 control-label">Company Name</label>

                                                        <div class="col-md-10">
                                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

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
                                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

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
                                                            <input id="password" type="password" class="form-control" name="password">

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
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

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
                                                        <label for="name" class="col-md-2 control-label">Business Name</label>

                                                        <div class="col-md-10">
                                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

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
                                                        <label for="name" class="col-md-2 control-label">Building</label>

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
                                                        <label for="email" class="col-md-2 control-label">Street</label>

                                                        <div class="col-md-10">
                                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

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
                                                        <label for="phone" class="col-md-2 control-label">Landmark</label>

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
                                                        <label for="password" class="col-md-2 control-label">Country</label>

                                                        <div class="col-md-10">
                                                            <input id="password" type="password" class="form-control" name="password">

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
                                                        <label for="password-confirm" class="col-md-2 control-label">State/Region</label>

                                                        <div class="col-md-10">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                                            @if ($errors->has('password_confirmation'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="col-md-2 control-label">City</label>

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
                                                        <label for="password" class="col-md-2 control-label">Area</label>

                                                        <div class="col-md-10">
                                                            <input id="password" type="password" class="form-control" name="password">

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
                                                        <label for="password-confirm" class="col-md-2 control-label">Pin Code</label>

                                                        <div class="col-md-10">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

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
                                                <h5 style="color:blue;">Contact Detail</h5>
                                                <hr>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-md-2 control-label">Contact Person</label>

                                                        <div class="col-md-10">
                                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

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
                                                        <label for="name" class="col-md-2 control-label">Landline No</label>

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
                                                        <label for="email" class="col-md-2 control-label">Mobile No</label>

                                                        <div class="col-md-10">
                                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

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
                                                        <label for="phone" class="col-md-2 control-label">Fax No</label>

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
                                                        <label for="password" class="col-md-2 control-label">Fax No 2</label>

                                                        <div class="col-md-10">
                                                            <input id="password" type="password" class="form-control" name="password">

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
                                                        <label for="password-confirm" class="col-md-2 control-label">Toll Free No</label>

                                                        <div class="col-md-10">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                                            @if ($errors->has('password_confirmation'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="col-md-2 control-label">Email ID</label>

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
                                                        <label for="password" class="col-md-2 control-label">Website</label>

                                                        <div class="col-md-10">
                                                            <input id="password" type="password" class="form-control" name="password">

                                                            @if ($errors->has('password'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('password') }}</strong>
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

                                    </div>
                                </div>

                               <!-- Location Information -->
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <form action="javascript:;" method="post" id="other_information_form" class="form-horizontal">
                                            <fieldset>

                                              <div class="controls">

                                              <h4>Payment Modes Accepted By You</h4>

                                              <div class="form-group required">

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="0" class="checkAll">
                                                    <span style="color:#de4b39;">Select All</span>
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="1" name="payment_mode[]" class="payment_mode"> Cash
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="2" name="payment_mode[]" class="payment_mode"> Master Card
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="3" name="payment_mode[]" class="payment_mode"> Visa Card
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="4" name="payment_mode[]" class="payment_mode"> Debit Cards
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="5" name="payment_mode[]" class="payment_mode"> Money Orders
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="6" name="payment_mode[]" class="payment_mode"> Cheques
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="7" name="payment_mode[]" class="payment_mode"> Credit Card
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="8" name="payment_mode[]" class="payment_mode"> Travelers Cheque
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="9" name="payment_mode[]" class="payment_mode"> Financing Available
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="10" name="payment_mode[]" class="payment_mode"> American Express Card
                                                </div>

                                                <div class="col-sm-4">
                                                    <input type="checkbox" value="11" name="payment_mode[]" class="payment_mode"> Diners Club Card
                                                </div>

                                              </div>

                                              <hr />

                                              <h4>Company Information</h4>

                                                <div class="form-group required">
                                                  <label for="Name" class="col-sm-4 control-label">Year Of Establishment: </label>
                                                  <div class="col-sm-2">
                                                    <input class="form-control" name="establishment_year" id="establishment_year" type="text" placeholder="1995">
                                                  </div>

                                                  <div class="col-sm-3">
                                                    <input class="form-control" name="annual_turnover" id="annual_turnover" placeholder="Annual Turnover" type="text">
                                                  </div>

                                                  <div class="col-sm-3">
                                                    <select class="form-control" id="number_employees" name="number_employees">
                                                        <option value="">Select Employees</option>
                                                        <option value="Less than 10">Less than 10</option>
                                                        <option value="10-100">10-100</option>
                                                        <option value="100-500">100-500</option>
                                                        <option value="500-1000">500-1000</option>
                                                        <option value="1000-2000">1000-2000</option>
                                                        <option value="2000-5000">2000-5000</option>
                                                        <option value="5000-10000">5000-10000</option>
                                                        <option value="More than 10000">More than 10000</option>
                                                    </select>
                                                  </div>

                                                </div>

                                                <div class="form-group required">
                                                    <label class="col-sm-4 control-label">Professional Associations: </label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" name="professional_association" id="professional_association">
                                                    </div>
                                                </div>

                                                <div class="form-group required">
                                                    <label for="Email" class="col-sm-4 control-label">Certifications: </label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" name="certification" id="certification">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-right">
                                                    <input type="submit" name="addUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
                                                </div>

                                              </div>
                                            </fieldset>

                                        </form>
                                    </div>
                                </div>

                                <!-- Company Information -->
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">

                                    </div>
                                </div>

                                <!-- Other Information -->
                                <div id="tab-4" class="tab-pane">
                                    <div class="panel-body" id="hide_add_button">
                                        <h4>Business Keywords</h4>
                                        <p>For business keywords that you no longer wish to be listed in simply click on cross next to the keyword and when you are done, Click "Save"</p>

                                        <div class="col-sm-12" style="padding: 0px;border-bottom: 1px solid #ddd;">
                                            <a class="add_keyword" style="color:#3b5998;font-weight: bold;float:right">
                                                Add more keywords
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body" id="add_keyword" style="display:none;">
                                        <h4>Type your Business Keywords and click Search</h4>
                                        <form method="post" class="form-horizontal" action="{{ route('add_user') }}">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

                                                            @if ($errors->has('company_name'))
                                                                <span class="help-block red">
                                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>

                                        <!-- Searched result will show here -->
                                        <div id="searched_result"> </div>
                                        <div class="col-md-3 text-right">
                                            <button class="btn btn-info btn-block" id="save_keywords">Save</button>
                                        </div>
                                        
                                        <div class="col-md-12 text-right">
                                            <hr>
                                            <input type="submit" name="addUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Images Information -->
                                <div id="tab-5" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="box">
                                            <h4>Upload logo/Photos</h4>
                                            <hr />

                                            <form action="{{ route('uploadLogoAndPhotos') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                              <fieldset>
                                                <div class="controls">

                                                    {{ csrf_field() }}

                                                  <div class="form-group required">
                                                    <label for="Name" class="col-sm-4 control-label">Upload Logo: </label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="logo" id="logo" type="file">
                                                    </div>
                                                  </div>

                                                  <div class="form-group required">
                                                    <label for="Name" class="col-sm-4 control-label">Upload Photos: </label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="photos[]" id="photos" type="file" multiple>
                                                    </div>
                                                  </div>

                                                </div>
                                                <div class="col-md-12 text-right">
                                                      <!-- <a class="btn btn-primary continue" data-original-title="" title="">Save & Exit</a> -->
                                                      <input type="submit" name="save_exit" class="btn btn-success" value="Save & Exit">
                                                </div>
                                              </fieldset>
                                            </form>
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
</div>

@endsection