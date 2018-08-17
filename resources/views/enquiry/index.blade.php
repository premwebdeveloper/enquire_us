@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Enquiries</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Enquiries</strong>
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
                <h5>Enquiries</h5>
            </div>

            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Phone</th>
                                <th>User Enquiry</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $enquiry)

                                <tr class="gradeX">
                                    <td>{{ $enquiry->business_name }}</td>
                                    <td>{{ $enquiry->name }}</td>
                                    <td>{{ $enquiry->email }}</td>
                                    <td>{{ $enquiry->phone }}</td>
                                    <td>{{ $enquiry->enquiry }}</td>
                                    <td>{{ $enquiry->created_at }}</td>                                    
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