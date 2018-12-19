@extends('layouts.auth_app')

@section('content')

<style type="text/css">
.form-horizontal .control-label{ padding-top: 0px; padding: 0px; text-align: left; font-size: 11px; }
.form-horizontal .form-group { margin-left: 0px; }
.btn-success{ padding: 4px; border-radius: 4px; }
.btn-danger{ padding: 4px; border-radius: 4px; }
.padding{ padding: 2px;}
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

            @if(isset($status) && !empty($status))
                <div class="alert alert-success">
                    {{ $status }}
                </div>
            @endif

            @if (\Session::has('status'))
                <div class="alert alert-success">
                    {!! \Session::get('status') !!}
                </div>
            @endif
                        
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="tabs-container">
                            @if(!empty($user_details->user_id))
                                <ul class="nav nav-tabs">
                                    <li><a href="{{ route('addUser_basic_information', ['user_id' => $user_id]) }}">Basic Information</a></li>
                                    <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_id]) }}">Payment Modes</a></li>
                                    <li class=""><a href="{{ route('addUser_business_timing', ['user_id' => $user_id]) }}">Business Timing</a></li>
                                    <li class=""><a href="{{ route('addUser_business_keywords', ['user_id' => $user_id]) }}">Business Keywords</a></li>
                                    <li class="active"><a href="{{ route('addUser_logo_images', ['user_id' => $user_id]) }}">Images</a></li>
                                </ul>
                            @else
                                <ul class="nav nav-tabs">
                                    <li class=""><a href="javascript:;">Basic Information</a></li>
                                    <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                    <li class=""><a href="{{ route('addUser_business_timing', ['user_id' => $user_details->user_id]) }}">Business Timing</a></li>
                                    <li class=""><a href="{{ route('addUser_business_keywords', ['user_id' => $user_details->user_id]) }}">Business Keywords</a></li>
                                    <li class="active"><a href="javascript:;">Images</a></li>
                                </ul>
                            @endif

                            <div class="tab-content">

                                <!-- Images Information -->
                                <div id="tab-5" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="box">
                                            <h4>Upload logo/Photos</h4>
                                            <hr />

                                            <form action="{{ route('addUser_logo_images', ['user_id' => $user_id]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <input type="hidden" class="form-control" name="check_validation" value="1">
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
                                                        <!-- If logged in user is admin then Button Save And Approve -->
                                                        @if(Auth::user()->id == 1)

                                                            <!-- If user is not approved then user will be approve also -->
                                                            @if($user_logo->status == 0)

                                                                <input type="hidden" name="approve_also" value="1">

                                                                <!-- If keyword not assigned to user then admin can not approve user else can approve -->
                                                                @if($keyword_exit == 1)
                                                                    <input type="submit" name="save_exit" class="btn btn-success" value="Save And Approve">
                                                                @else
                                                                    <a href="#approve_modal" class="btn btn-success" data-toggle="modal">
                                                                        Save And Approve
                                                                    </a>
                                                                @endif
                                                            @else
    
                                                                <!-- If user already approved -->
                                                                <input type="hidden" name="approve_also" value="0">

                                                                <input type="submit" name="save_exit" class="btn btn-success" value="Save">
                                                            @endif
                                                        @else
                                                            
                                                            <!-- If logged in user is not admin then button Save And Submit -->
                                                            <input type="submit" name="save_exit" class="btn btn-success"   value="Save And Submit">
                                                        @endif
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- user logo image -->
                                @if(!empty($user_logo->logo))
                                    <tr class="gradeX">
                                        <td>
                                            <img src="{{url('/')}}/storage/app/uploads/{{ $user_logo->logo }}" class="img-responsive" style="width: 100px;height: 80px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('userDeteteLogo', ['user_id' => $user_id]) }}" class="btn btn-warning element" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Yes" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" data-title="Delete?">
                                                Delete Logo
                                            </a>
                                        </td>
                                    </tr>
                                @endif

                                <!-- User profile images -->
                                @foreach($user_images as $images)
                                    <tr class="gradeX">
                                        <td>
                                            <img src="{{url('/')}}/storage/app/uploads/{{ $images->image}}" class="img-responsive" style="width: 100px;height: 80px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('userDeteteImage', ['user_id' => $user_id, 'image_id' => $images->id]) }}" class="btn btn-danger element" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Yes" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" data-title="Delete?">
                                                Delete Logo
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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