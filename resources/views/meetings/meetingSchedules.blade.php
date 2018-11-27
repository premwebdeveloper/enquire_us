@extends('layouts.auth_app')

@section('content')

<style>
    .gj-picker {
        z-index: 99999;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Meeting Schedules</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sales') }}">Home</a>
            </li>
            <li class="active">
                <strong>Meeting Schedules</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right pt10">
        <h2>
            &nbsp;
        </h2>
    </div>
</div>
<br />

<div class="row">
    <div class="col-lg-12">
       <div class="ibox float-e-margins">

            @if(session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status') }}
                </div>
            @endif

            <div class="ibox-title">
                <h5>Meeting Schedules</h5>
            </div>

            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Client Company</th>
                                <th>Assigned By</th>
                                <th>Assigned To</th>
                                <th>Date / Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @foreach($schedules as $key => $schedule)                   
                            <tr class="gradeX">
                                <td>{{ $schedule->business_name }}</td>
                                <td>{{ $schedule->assigned_by_name }} ( {{ $schedule->assigned_by_phone }} )</td>
                                <td>{{ $schedule->assigned_to_name }} ( {{ $schedule->assigned_to_phone }} )</td>
                                <td>{{ $schedule->assign_date_time }}</td>
                                <td>
                                    <!-- Client view -->
                                    <a href="{{ route('addUser_basic_information', ['user_id' => $schedule->user_id]) }}" class="btn btn-primary" title="View">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <!-- response for the meeting -->
                                    <a href="{{ route('client_response', ['meeting_id' => $schedule->id]) }}" class="btn btn-warning" title="Client Response">
                                        <i class="fa fa-reply"></i>
                                    </a>

                                    <a href=""></a>
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
@endsection