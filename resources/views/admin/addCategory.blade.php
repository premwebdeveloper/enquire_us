@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('Category') }}">Categories</a>
            </li>
            <li class="active">
                <strong>Add Category</strong>
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
                <h5>Add Category</h5>
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

                <form method="post" class="form-horizontal" action="{{ route('addCategory') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Super Category</label>
                        <div class="col-sm-10">
                            <select name="super_category" id="super_category" class="form-control" required>
                                <option value="">Select Super Category</option>
                                @foreach($super_categories as $super_cat)
                                    <option value="{{ $super_cat->id }}">{{ $super_cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10">
                            <input type="text" name="category" id="category" class="form-control" placeholder="Category" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" name="add_category" type="submit">Add Category</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection