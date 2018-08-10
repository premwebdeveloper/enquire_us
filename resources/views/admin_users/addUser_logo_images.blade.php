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

            @if(isset($status))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ $status }}
                    </div>
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
                                                          <!-- <a class="btn btn-primary continue" data-original-title="" title="">Save & Exit</a> -->
                                                          <input type="submit" name="save_exit" class="btn btn-success" value="Save">
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
                                @if(!empty($user_logo->logo))
                                    <tr class="gradeX">
                                        <td><img src="{{url('/')}}/storage/app/uploads/{{ $user_logo->logo }}" class="img-responsive" width="100px"></td>
                                        <td>

                                            <a class="btn btn-danger" title="Delete" href="#logo_{{ $user_logo->user_id }}" data-toggle="modal">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                @foreach($user_images as $images)

                                    <tr class="gradeX">
                                        <td><img src="{{url('/')}}/storage/app/uploads/{{ $images->image}}" class="img-responsive" width="100px"></td>
                                        <td>

                                            <a class="btn btn-danger" title="Delete" href="#{{$images->user_id}}" data-toggle="modal">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- delete user logo modal -->
                                    <div id="logo_{{ $user_logo->user_id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Logo Image</h4>
                                              </div>
                                              <div class="modal-body">
                                                <form method="post" action="{{route('userDeteteLogo')}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="user_id" value="{{$user_logo->user_id}}">
                                                    <p>
                                                        Are you sure you want to Delete logo Image ?

                                                        <button class="btn btn-danger pull-right" type="submit" name="approve" value="{{$user_logo->user_id}}">Yes</button>

                                                    </p>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete user image modal -->
                                    <div id="{{ $images->user_id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Image</h4>
                                              </div>
                                              <div class="modal-body">
                                                <form method="post" action="{{ route('userDeteteImage') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="user_id" value="{{ $images->user_id }}">
                                                    <input type="hidden" name="id" value="{{$images->id}}">
                                                    <p>
                                                        Are you sure you want to Delete this Image ?
                                                        <button class="btn btn-danger pull-right" type="submit" name="approve" value="{{ $images->user_id }}">Yes</button>
                                                    </p>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

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