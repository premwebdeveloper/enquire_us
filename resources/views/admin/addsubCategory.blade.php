@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add subCategory</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>subCategory</li>
            <li class="active">
                <strong>Add subCategory</strong>
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
                <h5>Add subCategory</h5>
            </div>
            <div class="ibox-content">

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="post" class="form-horizontal" action="{{ route('addSubCategory') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-8">
                            <select name="category" id="category" class="form-control" required="required">
                            	
                            	<option value="">Select Category</option>
                            	@foreach($category as $cat)
                            		<option value="{{ $cat->id }}">{{ $cat->category }}</option>
                        		@endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">subCategory</label>
                        <div class="col-sm-8">
                            <input type="text" name="subcategory" id="subCategory" class="form-control" placeholder="subCategory" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-2 control-label"></label>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" name="add_subCategory" type="submit">Add subCategory</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection