@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Notifications</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Notifications</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right pt10">
        &nbsp;
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
                <h5>Notifications</h5>
            </div>

            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Employee</th>
                                <th>Update For</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notify)

                                <tr class="gradeX">
                                    <td>{{ $notify->business_name }}</td>
                                    <td>{{ $notify->update_by_emp }} ( {{ $notify->update_by_phone }} )</td>
                                    <td>
                                    @php
                                        if($notify->status == 1):
                                            echo 'Client Basic Information';
                                        elseif($notify->status == 2):
                                            echo 'Client Payment Modes';
                                        elseif($notify->status == 3):
                                            echo 'Client Business Timing';
                                        elseif($notify->status == 4):
                                            echo 'Client Logo And Images';
                                        endif;
                                    @endphp
                                    </td>
                                    <td>{{ $notify->created_at }}</td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-info btn-xs changes_for_approval" id="changes_{{ $notify->id }}">View Changes</a>
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

<!-- compareChangesModal -->
<div id="compareChangesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <form method="post" action="{{ route('admin_approval_for_updates') }}">
                
                {{ csrf_field() }}
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Compare Changes</h4>
                </div>
                <div class="modal-body">
                    <p id="showComparedChanges"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection