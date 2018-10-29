@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Employees</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Employees</strong>
            </li>
        </ol>
    </div>
<div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('empCreateView') }}" class="btn btn-info">Add Employee</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Employees</h5>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>

	                            @foreach($employees as $emp)

	                                <tr class="gradeX">
                                        <td>{{ $emp->name }}</td>
                                        <td>{{ $emp->email }}</td>
                                        <td>{{ $emp->phone }}</td>
                                        <td>{{ $emp->role }}</td>
	                                    <td>
                                            <a class="btn btn-success" title="Edit" href="{{ route('editEmployee', ['user_id' => $emp->user_id]) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn btn-success" title="Delete" href="{{ route('deleteEmployee', ['user_id' => $emp->user_id]) }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
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
