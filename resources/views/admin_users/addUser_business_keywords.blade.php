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
    $(document).ready(function(){
        $(".add_keyword").click(function() {
            $("#add_keyword").show();
            $("#hide_add_button").hide();
        });
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
                                <li class=""><a href="javascript:;">Basic Information</a></li>
                                <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                <li class=""><a href="{{ route('addUser_business_timing', ['user_id' => $user_details->user_id]) }}">Business Timing</a></li>
                                <li class="active"><a href="javascript:;">Business Keywords</a></li>
                                <li class=""><a href="javascript:;">Images</a></li>
                            </ul>

                            <div class="tab-content">

                                <!-- Business Keyword -->
                                <div id="tab-4" class="tab-pane active">
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
                                        <form method="post" class="form-horizontal" action="{{ route('addUser_business_keywords', ['user_id' => $user_details->user_id]) }}">
                                            {{ csrf_field() }}
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
                                            <a href="{{ route('addUser_logo_images') }}" class="btn btn-success" style="margin-bottom: 30px;">Next</a>
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