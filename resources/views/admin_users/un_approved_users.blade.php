@extends('layouts.auth_app')

@section('content')

<style>
	.btn-success{ padding: 4px; border-radius: 4px; }
    .btn-danger{ padding: 4px; border-radius: 4px; }
	.padding{ padding: 2px;}
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>All UnApproved Users</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>UnApproved Users</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-2 text-right"> &nbsp; </div>
	<div class="col-lg-1 text-right"> &nbsp; </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>UnApproved Users</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>Created By</th>
                                    <th>Company</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            @foreach($users as $user)
                                @php
                                if($user->keyword_exit == 1):
                                    $assigned_keyword_user = "";
                                else:
                                    $assigned_keyword_user = "danger";
                                endif;
                                @endphp
	                                <tr class="gradeX {{$assigned_keyword_user}}">
                                        <td>{{ $user->created_by_name }} ({{ $user->created_by_phone }})</td>
                                        <td>{{ $user->business_name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->area_name .', '.$user->city_name .' - '.$user->pincode }}</td>
                                        <td>{{ $user->created_at }}</td>
	                                    <td>
   											<a href="{{ route('addUser_basic_information', ['user_id' => $user->user_id]) }}" class="btn btn-info btn-xs">
                                                View
                                            </a>
                                            @if($user->keyword_exit == 1)
                                            <a href="{{ route('updateUserStatus', ['user_id' => $user->user_id]) }}" class="btn btn-primary btn-xs element" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Yes" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" data-title="Approve?">
                                                Approve
                                            </a>
                                            @else
                                            <a href="#approve_modal" class="btn btn-primary btn-xs" data-toggle="modal">
                                                Approve
                                            </a>
                                            @endif
                                            <a href="{{ route('deleteUser', ['user_id' => $user->user_id]) }}" class="btn btn-danger padding btn-xs element" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Yes" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" data-title="Delete?">
												Delete
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
@endsection
