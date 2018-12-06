@extends('layouts.auth_app')

@section('content')

<style>
	.btn-success{ padding: 4px; border-radius: 4px; }
	.btn-danger{ padding: 4px; border-radius: 4px; }
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
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            @foreach($users as $user)
	                                <tr class="gradeX">
                                        <td>{{ $user->created_by_name }} ({{ $user->created_by_phone }})</td>
                                        <td>{{ $user->business_name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->area_name .', '.$user->city_name .' - '.$user->pincode }}</td>
	                                    <td>
   											<a href="{{ route('updateUserStatus', ['user_id' => $user->user_id]) }}" class="btn btn-primary element" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Yes" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-class="btn-danger" data-title="Approve?">
													Approve
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
