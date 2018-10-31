@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Meeting</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sales') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('meetings') }}">meetings</a>
            </li>
            <li class="active">
                <strong>Edit Meeting</strong>
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
                <h5>Edit Meeting</h5>
            </div>
            <div class="ibox-content">

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" class="form-horizontal" action="{{ route('editMeeting') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">

                    <div class="form-group">

                        <div class="col-sm-4">
                            <label class="control-label">Contact Person</label>
                            <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person" value="{{ $meeting->contact_person }}" required autofocus>

                            @if($errors->has('contact_person'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('contact_person') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Company</label>
                            <input type="text" name="company" id="company" class="form-control" placeholder="Company" value="{{ $meeting->company }}" required autofocus>

                            @if($errors->has('company'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $meeting->email }}" required autofocus>

                            @if($errors->has('email'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ $meeting->phone }}">

                            @if($errors->has('phone'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Category</label>  
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ ($cat->id == $meeting->category) ? 'selected' : '' }}>{{ $cat->category }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('category'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Custom category</label>
                            <input type="number" name="custom_category" id="custom_category" class="form-control" placeholder="Custom Category" value="{{ $meeting->custom_category }}">

                            @if($errors->has('custom_category'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('custom_category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Address" cols="10" rows="3">{{ $meeting->address }}</textarea>

                            @if($errors->has('address'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" name="craete_meeting" type="submit">Edit Meeting</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection