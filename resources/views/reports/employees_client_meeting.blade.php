@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Employees Client Meeting Report</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('reports') }}">Reports</a>
            </li>
            <li class="active">
                <strong>Employees Client Meeting</strong>
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
	                <h5>Employees Client Meeting Report</h5>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('generate_employee_client_meeting_report') }}" method="post">

                        {{ csrf_field() }}
                        
                        <div class="row">
                            
                            <div class="col-md-5">
                                <label for="employee">Employee</label><label class="red">*</label>
                                <select name="employee" id="employee" class="form-control" required="required">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $key => $employee)

                                        <option value="{{ $employee->user_id }}">{{ $employee->name }}</option>

                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-md-5">
                                <div class="form-group" id="data_5">
                                    <label class="font-normal">Date Range select</label><label class="red">*</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control-sm form-control" name="start" placeholder="Start Date" required="required">
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="form-control-sm form-control" name="end" placeholder="End Date" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <input type="submit" name="generate_report" value="Generate Report" class="btn btn-primary" style="margin-top: 25px;">
                            </div>

                        </div>
                    </form>
	            </div>

                <div class="ibox-content">
                    @if(!empty($meeting_records))
    
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Business Name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($meeting_records as $key => $rows)

                                    <tr class="gradeX">
                                        <td>{{ $rows->business_name }}</td>
                                        <td>{{ $rows->name }}</td>
                                        <td>{{ $rows->email }}</td>
                                        <td>{!! $rows->phone !!}</td>
                                        <td>{{ $rows->building.', '. $rows->street.', '. $rows->landmark.', '. $rows->area.', '. $rows->city.', '. $rows->state.', '. $rows->country.', '. $rows->pincode}}</td>
                                        <td>{{ $rows->created_at }}</td>
                                        <!-- <td>
                                            <a class="btn btn-success" title="Edit" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn btn-success" title="Delete" href="#">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td> -->
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    @endif
                </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
