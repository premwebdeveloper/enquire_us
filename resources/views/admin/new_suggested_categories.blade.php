@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>New Suggestions Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('Category') }}">Home</a>
            </li>
            <li class="active">
                <strong>New Suggestions Category</strong>
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

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="ibox-title">
                    <h5>New Suggestions Category</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Role</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)

                                    <tr class="gradeX">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->role }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-warning edit_category" id= "edit_category-{{ $category->id }}-{{ $category->category }}">Edit</a>
                                            <a href="javascript:;" class="btn btn-danger approve_category" id= "approve_category-{{ $category->id }}-{{ $category->category }}">Approve</a>
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

<!-- ******************************************************************************************* -->
<!-- Approve new suggested categories -->
<div id="approveSuggestedCategoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="approve_suggested_cate_title">Approve Category</h4>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('approveSuggestedCategory') }}" method="post">

                    {{ csrf_field() }}
                    
                    <input type="hidden" name="approve_suggested_cate_id" id="approve_suggested_cate_id" class="form-control">
                    <input type="hidden" name="approve_suggested_cat_name" id="approve_suggested_cat_name" class="form-control">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="super_category">Super Category</label>
                                <select name="super_category" class="form-control getCatsBySuperCat" required="required">
                                    <option value="">Select Super Category</option>
                                    @foreach($super_cats as $key => $super)
                                        <option value="{{ $super->id }}">{{ $super->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="selectCategory">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" value="Approve" name="approveSuggestedCategory" class="btn btn-primary mt20">
                            </div>
                        </div>
                    </div>

                </form>
            </div>  
        </div>

    </div>
</div>

@endsection