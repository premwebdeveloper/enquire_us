@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Blog</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('blogs') }}">Blogs</a>
            </li>
            <li class="active">
                <strong>Add Blog</strong>
            </li>
        </ol>
    </div>
<div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Add Blog</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Add employee form start -->
                    <form method="post" class="form-horizontal" action="{{ route('createBlog') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <div class="col-sm-4">
                                <label class="control-label">Title</label>
                                <textarea name="title" id="title" cols="10" rows="5" class="form-control" placeholder="Title" required="required"></textarea>

                                @if($errors->has('title'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label">Content</label>
                                <textarea name="content" id="content" cols="10" rows="5" class="form-control" placeholder="Content" required="required"></textarea>

                                @if($errors->has('content'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="clearfix">&nbsp;</div>
                            
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" name="add_blog" type="submit">Add Blog</button>
                            </div>

                        </div>
                    </form>
	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
