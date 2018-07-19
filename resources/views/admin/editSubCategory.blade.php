@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Sub Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('subCategory') }}">Sub Categories</a>
            </li>
            <li class="active">
                <strong>Edit Sub Category</strong>
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
                <h5>Edit Sub Category</h5>
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

                <form method="post" class="form-horizontal" action="{{ route('editsubCat') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="hidden" name="subcat_id" id="subcat_id" value="{{ $subcategory->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10">
                            <select name="category" id="category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)

                                    @if($cat->id == $subcategory->cat_id)
                                        @php $selected = 'selected'; @endphp
                                    @else
                                        @php $selected = ''; @endphp
                                    @endif

                                    <option value="{{ $cat->id }}" {{ $selected }}>{{ $cat->category }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('category'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Category</label>
                        <div class="col-sm-10">
                            <input type="text" name="subcategory" id="subcategory" value="{{ $subcategory->subcategory }}" class="form-control" placeholder="Sub Category" required="required">

                            @if($errors->has('subcategory'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('subcategory') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control summernote" placeholder="Description">{{ $subcategory->description }}</textarea>

                            @if($errors->has('description'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" name="edit_sub_category" type="submit">Update Sub Category</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection