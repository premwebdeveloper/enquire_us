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
                                    <th>Cateogry</th>
                                    <th>Image</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php
	                        		$i=1;
	                        	?>
	                            @foreach($category as $cat)

	                                <tr class="gradeX">
                                    	<td>{{ $i }}</td>
                                        <td id="exitCat_{{ $cat->id }}">{{ $cat->category }}</td>
                                    	<td>
                                            <img src="storage/app/uploads/categories/{{ $cat->image }}" alt="{{ $cat->image }}" style="height: 50px;">
                                        </td>
                                       	<td>
                                            <a class="btn btn-success editcat" title="Update" id="{{ $cat->id }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
	                                    </td>
	                                </tr>
                                <?php
                                	$i++;
                                ?>
	                            @endforeach

	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>

<!-- Edit category Modal -->
<div id="catModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Category</h4>
        </div>
        <div class="modal-body">
            <p>
                <form method="post" action="{{ route('editCat') }}">

                    {{ csrf_field() }}

                    <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group">
                        <label>Category</label>
                        <select name="super_category" id="super_category" class="form-control" required>
                            <option value="">Select Super Category</option>
                            @foreach($super_categories as $super_cat)
                                <option value="{{ $super_cat->id }}">{{ $super_cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" id="cat" required="required" class="form-control" placeholder="Category">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="category_description" id="category_description" class="form-control" placeholder="Category Description" required="required"></textarea>
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" name="editCategory" class="btn btn-warning" id="editCaste" value="Update">
                    </div>
                </form>
            </p>
        </div>
    </div>

    </div>
</div>

<!-- Edit category -->
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.editcat', function(){
            var id = $(this).attr('id');

            $.ajax({
                method : 'post',
                url : 'getCategoryDetails',
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id': id},
                success:function(response){

                    var obj = $.parseJSON(response);

                    $('#cat_id').val(obj.id);
                    $('#cat').val(obj.category);
                    $('#category_description').val(obj.description);
                    $('#catModal').modal('show');

                    // old super category selected
                    $('#super_category option[value="'+obj.super_category+'"]').prop('selected', true);
                },
                error: function(data){
                    console.log(data);
                },
            });

        });
    });
</script>
@endsection
