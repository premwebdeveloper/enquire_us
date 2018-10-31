@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Meetings</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sales') }}">Home</a>
            </li>
            <li class="active">
                <strong>Meetings</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right pt10">
        <h2>
            <a href="{{ route('createMeetingview') }}" class="btn btn-info">Create Meeting</a>
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
                <h5>Meetings</h5>
            </div>

            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach($meetings as $meeting)
                                <tr class="gradeX">
                                    <td>{{ $meeting->company }}</td>
                                    <td>{{ $meeting->contact_person }}</td>
                                    <td>{{ $meeting->email }}</td>
                                    <td>{{ $meeting->phone }}</td>
                                    <td>{{ $meeting->created_at }}</td>
                                    <td>
                                        
                                        <a href="{{ route('editMeetingView', ['meetingID' => $meeting->id]) }}" class="btn btn-primary" title="Edit">Edit</a>

                                        <a href="{{ route('deleteMeeting', ['meetingID' => $meeting->id]) }}" class="btn btn-warning" title="Delete">Delete</a>

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