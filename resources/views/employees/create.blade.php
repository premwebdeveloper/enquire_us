@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Employee</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('employees') }}">Employees</a>
            </li>
            <li class="active">
                <strong>Add Employee</strong>
            </li>
        </ol>
    </div>
<div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Add Employee</h5>
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

                    <!-- Add employee form start -->
                    <form method="post" class="form-horizontal" action="{{ route('createEmployee') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <div class="col-sm-4">
                                <label class="control-label">Employee Role</label>
                                <select name="emp_role" id="emp_role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="3">Support</option>
                                    <option value="5">Seo</option>
                                    <option value="6">Sales</option>
                                    <option value="7">Accounts</option>
                                </select>

                                @if($errors->has('emp_role'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('emp_role') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="required">

                                @if($errors->has('name'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">

                                @if($errors->has('email'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label">Phone</label>
                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone" required="required">

                                @if($errors->has('phone'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>

                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" name="add_employee" type="submit">Add Employee</button>
                            </div>

                        </div>
                    </form>
	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
