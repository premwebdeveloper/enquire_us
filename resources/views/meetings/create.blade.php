@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create Meeting</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sales') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('meetings') }}">meetings</a>
            </li>
            <li class="active">
                <strong>Create Meeting</strong>
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
                <h5>Create Meeting</h5>
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

                <form method="post" class="form-horizontal" action="{{ route('createMeeting') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <div class="col-sm-4">
                            <label class="control-label">Contact Person</label>
                            <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person" value="{{ old('contact_person') }}" required autofocus>

                            @if($errors->has('contact_person'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('contact_person') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Company</label>
                            <input type="text" name="company" id="company" class="form-control" placeholder="Company" value="{{ old('company') }}" required autofocus>

                            @if($errors->has('company'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>

                            @if($errors->has('email'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">

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
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
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
                            <input type="number" name="custom_category" id="custom_category" class="form-control" placeholder="Custom Category">

                            @if($errors->has('custom_category'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('custom_category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Address" cols="10" rows="3"></textarea>

                            @if($errors->has('address'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" name="craete_meeting" type="submit">Create Meeting</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection