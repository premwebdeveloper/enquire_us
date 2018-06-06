@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('client_area_visibility') }}">Client Area Visibility</a>
            </li>
            <li class="active">
                <strong>Edit Client Area Visibility</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">&nbsp;</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="ibox-title">
                    <h5>
						Edit Area Visibility for 
						<strong>{{ $user_info->business_name }}</strong>
					</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
				
                <div class="ibox-content">
				
					<form method="post" action="{{ route('edit_area_visibility') }}">
					
						{{ csrf_field() }}
					
						<!-- Current user id -->
						<input type='hidden' name='this_user' value='{{ $user_info->user_id }}'>
						
						<!-- All areas without clients default area -->
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
									<tr>
										<th>#</th>
										<th>Area</th>
									</tr>
								</thead>
								<tbody>
									@foreach($areas as $key => $area)
										
										<?php $selected_area = ''; ?>
										
										@foreach($visible_area as $v_key => $visible)
											@if($visible->area == $area['id'])
												<?php $selected_area = 'checked'; ?>									
											@endif
										@endforeach										

										<tr class="gradeX">
											<td>
												<input type="checkbox" name="areas[]" id="area_{{ $area['id'] }}" value="{{ $area['id'] }}" {{ $selected_area }}>
											</td>
											<td>{{ $area['area'] }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>						
						
						<input type="submit" name="edit_client_area_visibility" value="Edit Client Area Visibility" class="btn btn-info">
					
					</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
