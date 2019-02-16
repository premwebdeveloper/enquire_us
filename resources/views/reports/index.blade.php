@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Reports</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Reports</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">&nbsp; </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Reports</h5>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3 text-center">
                            <a href="{{ route('employees_client_meeting') }}" class="btn btn-primary">Employees Client Meetings</a>
                        </div>
                        <!-- <div class="col-md-3 text-center">
                            <a href="" class="btn btn-primary">Employees Client Meetings</a>
                        </div>
                        <div class="col-md-3 text-center">
                            <a href="" class="btn btn-primary">Employees Client Meetings</a>
                        </div>
                                                <div class="col-md-3 text-center">
                            <a href="" class="btn btn-primary">Employees Client Meetings</a>
                        </div> -->
                    </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
