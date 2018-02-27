@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Areas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Areas</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('add_category') }}" class="btn btn-info">Add Area</a>
        </h2>
    </div> 
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                
                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="ibox-title">
                    <h5>Areas</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                ?>
                                @foreach($areas as $area)

                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <td id="exitCountry_{{ $area->id }}" val="{{$area->country}}">{{ $area->country_name }}</td>
                                        <td id="exitState_{{ $area->id }}" val="{{$area->state}}">{{ $area->state_name }}</td>
                                        <td id="exitCity_{{ $area->id }}" val="{{$area->city}}">{{ $area->city_name }}</td>
                                        <td id="exitArea_{{ $area->id }}">{{ $area->area }}</td>
                                        <td>
                                            <a class="btn btn-success editArea" title="Update" id="{{ $area->id }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                ?>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="areaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Area</h4>
        </div>
        <div class="modal-body">
            <p>
                <form method="post" action="{{ route('update_area') }}" class="form-horizontal">

                    {{ csrf_field() }}

                    <input type="hidden" name="area_id" id="area_id">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="country" class="form-control country_id">
                            <input type="text" id="country" class="form-control" readonly>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">State</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="state" class="form-control state_id">
                            <input type="text" id="state" class="form-control" readonly>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-8">
                            <select name="city" class="form-control" required="required">
                                <option value="" class="city_id" id="city"></option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" class="cat" name="category">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Area</label>
                        <div class="col-sm-8">
                            <input type="text" name="area" id="area" required="required" class="form-control">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <input type="submit" name="editCaste" class="btn btn-warning" id="editCaste" value="Update">
                    </div>
                </form>
            </p>
        </div>
    </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.editArea', function(){
            var id = $(this).attr('id');
            var country = $('#exitCountry_'+id).text();
            var state = $('#exitState_'+id).text();
            var city = $('#exitCity_'+id).text();            

            var country_id = $('#exitCountry_'+id).attr('val');
            var state_id = $('#exitState_'+id).attr('val');
            var city_id = $('#exitCity_'+id).attr('val');

            var area = $('#exitArea_'+id).text();

            //alert(id +','+ country +','+ state +','+ city +','+ area +','+ country_id +','+ state_id +','+ city_id);

            $('#area_id').val(id);
            $('#country').val(country);
            $('#state').val(state);
            $('#city').text(city);
            $('#area').val(area);
            
            $('.country_id').val(country_id);
            $('.state_id').val(state_id);
            $('.city_id').val(city_id);
            $('#areaModal').modal('show');
        });
    });
</script>
@endsection
