@extends('layouts.auth_app')

@section('content')

<style>
    .gj-picker {
        z-index: 99999;
    }
</style>

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
            <!-- <a href="{{ route('createMeetingview') }}" class="btn btn-info">Create Meeting</a> -->
            <a href="{{ route('addUser_basic_information') }}" class="btn btn-info">Create Meeting</a>
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
                            @foreach($users as $user)
                                <tr class="gradeX">
                                    <td>{{ $user->business_name }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <!-- Client view -->
                                        <a href="{{ route('addUser_basic_information', ['user_id' => $user->user_id]) }}" class="btn btn-primary" title="View">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        
                                        <!-- If this user / client is assigned to any sales person by support person -->
                                        @if(!is_null($user->assigned_by))
                                            
                                            <a href="{{ route('assigned_meetings', ['id' => $user->cas_id])}}" class="btn btn-warning" title="Assigned To Meeting" title="Assigned To Meeting">
                                                <i class="fa fa-thumbs-up"></i>
                                            </a>
                                        @else
                                            
                                            <!-- Assign this client to sales person for attend meeting -->
                                            <a href="javascript:;" class="btn btn-warning assignToSales" id="assign_{{ $user->user_id }}" title="Assign To Meeting">
                                                <i class="fa fa-mail-forward" aria-hidden="true"></i>
                                            </a>

                                        @endif
                                        
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

<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
    
        $(document).on('click', '.assignToSales', function(){
            
            var id = $(this).attr('id');
            $('#meeting_client_uid').val(id);
            
            $('#assignToSalesModal').modal('show');
        });
    });
</script>

<!-- Modal -->
<div id="assignToSalesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign client to sales person for Meeting</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('client_assign_to_sales') }}" method="post">
    
                    {{ csrf_field() }}

                    <input type="hidden" name="meeting_client_uid" id="meeting_client_uid">

                    <div class="row">
                        <div class='col-md-5'>
                            <label for="Date">Date</label>
                            <input type='text' name="date_time" class="form-control form_datetime1" placeholder="yyyy-mm-dd H:I" required="required" />
                        </div> 

                        <div class='col-md-5'>
                            <label for="Date">Sales Person</label>
                            <select name="sales_person" id="sales_person" class="form-control" required="required">
                                <option value="">Select Sales Person</option>
                                @foreach($sales_users as $key => $sales)
                                    <option value="{{ $sales->user_id }}">{{ $sales->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class='col-md-2'>
                            <label for="Date">&nbsp;</label>
                            <input type="submit" name="assign_client_sales" value="Assign" class="btn btn-primary">
                        </div>
                    </div>

                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>

    </div>
</div>      
@endsection