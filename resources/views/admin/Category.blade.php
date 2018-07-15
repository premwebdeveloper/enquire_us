@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>All Cateogry</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Cateogry</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">
        <h2>
            <a href="{{ route('categoryClubs') }}" class="btn btn-info">Category Clubs</a>
            <a href="{{ route('add_category') }}" class="btn btn-info">Add Category</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                @endif

	            <div class="ibox-title">
	                <h5>Cateogry</h5>
	            </div>

	            <div class="ibox-content">

	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Super Cateogry</th>
                                    <th>Cateogry</th>
                                    <th>Image</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            @foreach($category as $key => $cat)
	                                <tr class="gradeX">
                                    	<td>{{ $key+1 }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ $cat->category }}</td>
                                    	<td>
                                            <img src="storage/app/uploads/categories/{{ $cat->image }}" alt="{{ $cat->image }}" style="height: 50px;">
                                        </td>
                                       	<td>
                                            <a href="{{ route('editCategory', ['cat_id' => $cat->id]) }}" class="btn btn-success" title="Update Category">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
	                                    </td>
	                                </tr>
	                            @endforeach

	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>

@endsection
