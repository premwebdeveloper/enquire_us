@extends('layouts.auth_app')

@section('content')

<style>
    .gj-picker {
        z-index: 99999;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Meeting Response</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sales') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('meeting_schedules') }}">Meetings</a>
            </li>
            <li class="active">
                <strong>Meeting Response</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right pt10">
        <h2>
            &nbsp;
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
                <h5>Meeting Response</h5>
            </div>

            <div class="ibox-content">
                <!-- If this user is sales executive then he can submit response only -->
                @if($role_id == 6)
                    <div class="table-responsive">                    
                        <form action="{{ route('client_meeting_response') }}" method="post">
                                
                            {{ csrf_field() }}

                            <input type="hidden" name="meeting_id" value="{{ $meeting_id }}">

                            <div class="col-md-6">
                                <label for="Date">Possibilities</label>
                                <select name="possibility" class="form-control" id="possibility" required="required">
                                    <option value="">Select Any Possibility</option>
                                    <option value="1">Not Available</option>
                                    <option value="2">Not Visited</option>
                                    <option value="3">Follow Up</option>
                                    <option value="4">Deal Closed</option>
                                </select>
                            </div>

                            <div class="col-md-6" id="followup_remark" style="display: none;">
                                <label for="Date">Date</label>
                                <input type="text" name="date_time" class="form-control form_datetime1" placeholder="yyyy-mm-dd H:I" />
                            </div>

                            <div class="col-md-6" id="remark_remark" style="display: none;">
                                <label for="Remark">Remark</label>
                                <textarea name="remark" class="form-control" placeholder="Remark" cols="3" rows="10" ></textarea>
                            </div>

                            <div class="clearfix">&nbsp;</div>

                            <div class="col-md-12 text-right">
                                <input type="submit" name="client_response" value="submit" class="btn btn-primary" />
                            </div>

                        </form>

                    </div>
                @endif
                <!-- show old meeting responses -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sales Ex.</th>
                                <th>Possibility</th>
                                <th>Follow Up</th>
                                <th>Remark</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @foreach($responses as $key => $response)                   
                            <tr class="gradeX">
                                <td>{{ $response->name }}</td>
                                <td>
                                    @if($response->possibility == 1)
                                        Not Available
                                    @elseif($response->possibility == 2)
                                        Not Visited
                                    @elseif($response->possibility == 3)
                                        Follow Up
                                    @elseif($response->possibility == 4)
                                        Deal Closed
                                    @endif
                                </td>
                                <td>{{ $response->follow_up_date }}</td>
                                <td>{{ $response->remark }}</td>
                                <td>{{ $response->created_at }}</td>                                
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $(document).on('change', '#possibility', function(){

            var possibility = $(this).val();

            // If follow up selected
            if(possibility == 3){

                $('#followup_remark').show();
                $('#remark_remark').hide();
            }
            else if(possibility == 4){  // If deal closed

                $('#followup_remark').hide();
                $('#remark_remark').show();
            }else{

                $('#followup_remark').hide();
                $('#remark_remark').hide();
            }
        });
    });
</script>
@endsection