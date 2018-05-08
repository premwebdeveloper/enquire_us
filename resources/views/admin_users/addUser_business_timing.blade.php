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

                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <div class="feed-activity-list">
                            <div class="tabs-container">

                                <ul class="nav nav-tabs">
                                    <li class=""><a href="{{ route('addUser_basic_information') }}">Basic Information</a></li>
                                    <li class=""><a href="{{ route('addUser_payment_modes') }}">Payment Modes</a></li>
                                    <li class="active"><a href="javascript:;">Business Timing</a></li>
                                    <li class=""><a href="{{ route('addUser_business_keywords') }}">Business Keywords</a></li>
                                    <li class=""><a href="{{ route('addUser_logo_images') }}">Images</a></li>
                                </ul>

                                <div class="tab-content">

                                    <!-- Business Timining Information -->
                                    <div id="tab-3" class="tab-pane active">
                                        <div class="panel-body">

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