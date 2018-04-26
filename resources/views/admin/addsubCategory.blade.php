@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add subCategory</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('subCategory') }}">Sub Categories</a>
            </li>
            <li class="active">
                <strong>Add Sub Category</strong>
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
                <h5>Add Sub Category</h5>
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

                <form method="post" class="form-horizontal" action="{{ route('addSubCategory') }}">

                    {{ csrf_field() }}

                    <div class="col-sm-6">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select name="category" id="category" class="form-control" required="required">
                                	<option value="">Select Category</option>
                                	@foreach($category as $cat)
                                		<option value="{{ $cat->id }}">{{ $cat->category }}</option>
                            		@endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="col-sm-3 control-label">Sub Category</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" name="subcategory" id="subCategory" class="form-control" placeholder="subCategory" required="required">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary" name="add_subCategory" type="submit">Add Sub Category</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection