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
                                <li class=""><a href="{{ route('addUser_basic_information') }}">Basic Information</a></li>
                                <li class=""><a href="{{ route('addUser_payment_modes') }}">Payment Modes</a></li>
                                <li class=""><a href="{{ route('addUser_business_timing') }}">Business Timing</a></li>
                                <li class=""><a href="{{ route('addUser_business_keywords') }}">Business Keywords</a></li>
                                <li class="active"><a href="javascript:;">Images</a></li>
                            </ul>

                            <div class="tab-content">

                                <!-- Images Information -->
                                <div id="tab-5" class="tab-pane active">
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