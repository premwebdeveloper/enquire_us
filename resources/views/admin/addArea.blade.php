@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Area</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>  Areas </li>
            <li class="active">
                <strong>Add Area</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add Area</h5>
            </div>
            <div class="ibox-content">

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                
                <form method="post" class="form-horizontal" action="{{ route('addarea') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Country Name</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="country" id="country" class="form-control" value="101">
                            <input type="text" class="form-control" value="India" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">State Name</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="state" id="state" class="form-control" value="33">
                            <input type="text" class="form-control" value="Rajasthan" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">City Name</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="city" id="city" required>
                                <option value=""> Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}"> {{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Area Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="area" id="area" class="form-control" placeholder="Area Name" required="required">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode</label>
                        <div class="col-sm-8">
                            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" name="add_category" type="submit">Add Area</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection