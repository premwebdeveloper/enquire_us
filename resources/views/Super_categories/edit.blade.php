@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Edit Super Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('superCategories') }}">Super Categories</a>
            </li>
            <li class="active">
                <strong>Edit Super Category</strong>
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
                <h5>Edit Super Category</h5>
            </div>
            <div class="ibox-content">

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                
                <form method="post" action="{{ route('updateSuperCategory') }}" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="hidden" name="super_cat_id" id="super_cat_id" value="{{ $super_category->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="super_cat_name" class="form-control" value="{{ $super_category->name }}">
                            
                            @if($errors->has('super_cat_name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('super_cat_name') }}</strong>
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
                        <div class="col-sm-2">
                            <button class="btn btn-primary" name="add_category" type="submit">Edit Super Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection