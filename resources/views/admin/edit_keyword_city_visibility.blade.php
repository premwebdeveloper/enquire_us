@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>City Visibility</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('keyword_city_visibility') }}">Keyword City Visibility</a>
            </li>
            <li class="active">
                <strong>Edit Keyword City Visibility</strong>
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
						Edit City Visibility for keyword
						<strong>{{ ($keyword_info->identity == 1 ) ? $keyword_info->category : $keyword_info->subcategory  }}</strong>
					</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
				
                <div class="ibox-content">
				
					<form method="post" action="{{ route('edit_city_visibility') }}">
					
						{{ csrf_field() }}
					
						<!-- Current user id -->
						<input type='hidden' name='this_keyword' id='this_keyword' value='{{ $keyword_info->id }}'>
						<input type='hidden' name='keyword_identity' id='keyword_identity' value='{{ $keyword_info->identity }}'>

						<label for="this_city">Select Any City</label>
						<select name="this_city" id="this_city" class="form-control" required="required">
							<option value="">Select Any City</option>
							<option value="3378">Jaipur</option>
						</select>

						<br />
						
						<!-- All areas without clients default area -->
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
									<tr>
										<th>#</th>
										<th>Client</th>
									</tr>
								</thead>
								<tbody>
									@foreach($clients as $key => $client)

										<?php $selected_client = ''; ?>

										<tr class="gradeX">
											<td>
												<input type="checkbox" name="clients[]" class="clients" id="client_{{ $client->user_id }}" value="{{ $client->user_id }}" {{ $selected_client }}>
											</td>
											<td>{{ $client->business_name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>						
						
						<input type="submit" name="edit_city_visibility" value="Edit Keyword City Visibility" class="btn btn-info">
					
					</form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Get all areas according to keyword and show check them -->
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change', '#this_city', function(){
			var city = $('#this_city option:selected').val();
			var this_keyword = $('#this_keyword').val();
			var keyword_identity = $('#keyword_identity').val();
			
			$.ajax({
				url : 'getAssignedClientsToThisKeyword',
				type : 'post',
				data : { "_token": "{{ csrf_token() }}", 'keyword' : this_keyword, 'keyword_identity' : keyword_identity, 'city' : city },
				success : function(response)
				{
					// convert response into object
					var obj = $.parseJSON(response);
					console.log(obj);

					// First remove all checkes areas
					$('.clients').prop('checked', false);

					// Check area accorfing to keyword
					$( obj ).each(function( i, l ) {
						$('#client_'+l.user_id).prop('checked', true);
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
