@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Super Categories</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Super Categories</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right pt10">
        <h2><a href="{{ route('createSuperCategory') }}" class="btn btn-info">Add Super Category</a></h2>
    </div>
</div>

<br />

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
                <h5>Super Categories</h5>
            </div>

            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Super Cateogry</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($super_categories as $cat)

                                <tr class="gradeX">
                                    <td>{{ $cat->name }}</td>
                                    <td><img src="storage/app/uploads/super_category/{{$cat->image}}" alt="" style="width: 100px; height: 100px;"></td>
                                    <td>
                                        <a class="btn btn-success editcat" title="Update" id="{{ $cat->id }}">
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

@endsection