@extends('layouts.auth_app')

@section('content')

<style>
    .gj-picker {
        z-index: 99999;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Meeting Schedule</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sales') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('meetings') }}">Meetings</a>
            </li>
            <li class="active">
                <strong>Meeting Schedule</strong>
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
                <h5>Meeting Schedule</h5>
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
                            <tr class="gradeX">
                                <td>{{ $meeting_information->business_name }}</td>
                                <td>{{ $meeting_information->assigned_by_name }} ( {{ $meeting_information->assigned_by_phone }} )</td>
                                <td>{{ $meeting_information->assigned_to_name }} ( {{ $meeting_information->assigned_to_phone }} )</td>
                                <td>{{ $meeting_information->assign_date_time }}</td>
                                <td>
                                    <a href="{{ route('client_meeting_response_view', ['meeting_id' => $meeting_information->id]) }}" class="btn btn-warning" title="Client Response">
                                        <i class="fa fa-reply"></i>
                                    </a>
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>     
@endsection