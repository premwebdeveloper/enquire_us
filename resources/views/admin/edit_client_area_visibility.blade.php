@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Area Visibility</h2>
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

						<!-- select keyword of this user with whome assigning areas -->

						<!-- <label>Select Any Keyword</label>
						<select name="keyword_name" id="keyword_name" class="form-control" required="required">
							<option value="0">Select All Keyword</option>

							@foreach($client_keywords as $key => $keyword)

								@php
									if($keyword->keyword_identity == 1){
										$key_identity = 1;
									}
									else{
										$key_identity = 2;										
									}
								@endphp	

								<option value="{{ $keyword->keyword_id.'_'.$key_identity }}">
									{{ !empty($keyword->category) ? $keyword->category : $keyword->subcategory }}
								</option>
							@endforeach

						</select> -->

						<br />
					
						<!-- Current user id -->
						<input type='hidden' name='this_user' id='this_user' value='{{ $user_info->user_id }}'>
						
						<!-- All areas without clients default area -->
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
									<tr>
										<th>
											<input type="checkbox" name="all_areas" class="all_areas" id="all_areas">
										</th>
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
												<input type="checkbox" name="areas[]" class="areas" id="area_{{ $area['id'] }}" value="{{ $area['id'] }}" {{ $selected_area }}>
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

<!-- Get all areas according to keyword and show check them -->
<script type="text/javascript">
	$(document).ready(function(){

		var all_checkbox = $('.areas').length;
		var checked_checkbox = $('input:checkbox:checked').length;

		if(all_checkbox == checked_checkbox){
			$('#all_areas').prop('checked', true);
		}

		$(document).on('change', '#all_areas', function(){

			if($(this).prop("checked") == true){
                
                $('.areas').prop('checked', true);
            }else{

            	$('.areas').prop('checked', false);
            }
		});

		// Old thing
		$(document).on('change', '#keyword_name', function(){
			var keyword = $('#keyword_name option:selected').val();
			var this_user = $('#this_user').val();
			
			$.ajax({
				url : 'getVisibleAreasAccordingToKeyword',
				type : 'post',
				data : { "_token": "{{ csrf_token() }}", 'keyword' : keyword, 'user_id' : this_user },
				success : function(response)
				{
					// convert response into object
					var obj = $.parseJSON(response);

					// First remove all checkes areas
					$('.areas').prop('checked', false);

					// Check area accorfing to keyword
					$( obj ).each(function( i, l ) {
						$('#area_'+l.area).prop('checked', true);
					});
				},
				error:function(data)
				{
					console.log(data);
				}
			});

		});
	});
</script>

@endsection
