@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>User Profile</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>

                <div>
                    <div class="ibox-content no-padding border-left-right" style="border: 1px solid #e7eaec;">
                        <img alt="image" class="img-responsive" src="resources/assets/images/sad.png">
                    </div>

                    <div class="ibox-content profile-content">
                        <h2><strong>{{ $user_details->business_name }}</strong></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>User Informations</h5>
                </div>

                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="tabs-container">

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Basic Information</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2">Location</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3">Company Information</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4">Other Information</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-5">Images</a></li>
                            </ul>

                            <div class="tab-content">

                                <!-- User Basic information -->
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Full Name</td>
                                                    <td>{{ $user_details->name }}</td>
                                                    <td>Designation</td>
                                                    <td>{{ $user_details->designation }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone No.</td>
                                                    <td>{{ $user_details->phone }}</td>
                                                    <td>Landline</td>
                                                    <td>{{ $user_details->landline }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Fax 1</td>
                                                    <td>{{ $user_details->fax1 }}</td>
                                                    <td>Fax 2</td>
                                                    <td>{{ $user_details->fax2 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Toll Free 1</td>
                                                    <td>{{ $user_details->toll_free1 }}</td>
                                                    <td>Toll Free 2</td>
                                                    <td>{{ $user_details->toll_free2 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Website</td>
                                                    <td colspan="3">{{ $user_details->website }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                               <!-- Location Information -->
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Building</td>
                                                    <td>{{ $user_details->building }}</td>
                                                    <td>Street</td>
                                                    <td>{{ $user_details->street }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Landmark</td>
                                                    <td>{{ $user_details->landmark }}</td>
                                                    <td>Area</td>
                                                    <td>{{ $user_details->area_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{ $user_details->city_name }}</td>
                                                    <td>Pincode</td>
                                                    <td>{{ $user_details->pincode }}</td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td>{{ $user_details->state }}</td>
                                                    <td>Country</td>
                                                    <td>{{ $user_details->country }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Company Information -->
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Payment Mode</td>
                                                    <td>{{ $user_details->payment_mode }}</td>
                                                    <td>Year Establishment</td>
                                                    <td>{{ $user_details->year_establishment }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Annual Turn Over</td>
                                                    <td>{{ $user_details->annual_turnover }}</td>
                                                    <td>Number of Employees</td>
                                                    <td>{{ $user_details->no_of_emps }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Professional Associations</td>
                                                    <td>{{ $user_details->professional_associations }}</td>
                                                    <td>Certifications</td>
                                                    <td>{{ $user_details->certifications }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                 <!-- Other Information -->
                                <div id="tab-4" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Operation Timing</th>
                                                    <th>Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Work status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i= 1; ?>
                                                @foreach($other_information as $other_info)

                                                    @if($other_info->working_status == 0)
                                                        <?php $working_status = 'Closed'; ?>
                                                    @else
                                                        <?php $working_status = 'Open'; ?>
                                                    @endif

                                                    @if($other_info->from_time == '')
                                                        <?php $from_time = '-'; ?>
                                                    @else
                                                        <?php $from_time = $other_info->from_time; ?>
                                                    @endif

                                                    @if($other_info->to_time == '')
                                                        <?php $to_time = '-'; ?>
                                                    @else
                                                        <?php $to_time = $other_info->to_time; ?>
                                                    @endif

                                                    @if($other_info->operation_timing == 1)
                                                        <?php $operation_timing = 'Single Time'; ?>
                                                    @else
                                                        <?php $operation_timing = 'Dual Time'; ?>
                                                    @endif

                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $operation_timing }}</td>
                                                        <td>{{ $other_info->day }}</td>
                                                        <td>{{ $from_time }}</td>
                                                        <td>{{ $to_time }}</td>
                                                        <td>{{ $working_status }}</td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Images Information -->
                                <div id="tab-5" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i= 1; ?>
                                                @foreach($images as $image)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td><img src="storage/app/uploads/{{ $image->image }}" width="100"></td>
                                                    </tr>
                                                    <?php $i++; ?>
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
