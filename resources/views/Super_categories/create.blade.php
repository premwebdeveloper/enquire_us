@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Add Super Category</h2>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('superCategories') }}">Super Categories</a></li>
            <li class="active">
                <strong>Add Super Category</strong>
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
            <div class="ibox-title">
                <h5>Add Super Category</h5>
            </div>
            <div class="ibox-content">

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                
                <form method="post" action="{{ route('createSuperCategory') }}" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" required="required">
                            
                            @if($errors->has('name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image / Icon</label>
                        <div class="col-sm-8">
                            <input type="file" name="super_cat_image" class="form-control">

                            @if($errors->has('super_cat_image'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('super_cat_image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8 text-right">
                            <button class="btn btn-primary" name="add_category" type="submit">Add Super Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection