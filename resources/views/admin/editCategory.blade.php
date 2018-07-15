@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('Category') }}">Categories</a>
            </li>
            <li class="active">
                <strong>Edit Category</strong>
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
                <h5>Edit Category</h5>
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

                <form method="post" class="form-horizontal" action="{{ route('editCat') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="hidden" name="cat_id" id="cat_id" value="{{ $category->id }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Super Category</label>
                        <div class="col-sm-10">
                            <select name="super_category" id="super_category" class="form-control" required>
                                <option value="">Select Super Category</option>
                                @foreach($super_categories as $super_cat)

                                    @if($super_cat->id == $category->super_category)
                                        @php $selected = 'selected'; @endphp
                                    @else
                                        @php $selected = ''; @endphp
                                    @endif

                                    <option value="{{ $super_cat->id }}" {{ $selected }}>{{ $super_cat->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('super_category'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('super_category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10">
                            <input type="text" name="category" id="category" value="{{ $category->category }}" class="form-control" placeholder="Category" required="required">

                            @if($errors->has('category'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="image" class="form-control">

                            @if($errors->has('image'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control summernote" placeholder="Description">{{ $category->category }}</textarea>

                            @if($errors->has('description'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" name="add_category" type="submit">Update Category</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection