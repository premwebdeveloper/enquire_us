@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All subCateogry</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>subCateogry</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('add_subCategory') }}" class="btn btn-info">Add subCateogry</a>
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
                                    <th>Cateogry Name</th>
                                    <th>subCateogry Name</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php
	                        		$i=1;
	                        	?>
	                            @foreach($subcategory as $subcat)

	                                <tr class="gradeX">
                                    	<td>{{ $i }}</td>
                                        <td>
                                            {{ $subcat->category }}
                                        </td>
                                    	<td>{{ $subcat->subcategory }}</td>
                                       	<td>
                                            <a href="{{ route('editSubCategory', ['subcat_id' => $subcat->id]) }}" class="btn btn-success" title="Update Sub Category">
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

<!-- Sub category edit model -->
<div id="subcatModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Sub Category</h4>
        </div>
        <div class="modal-body">
            <p>
                <form method="post" action="{{ route('editsubCat') }}" class="form-horizontal">

                    {{ csrf_field() }}

                    <input type="hidden" name="subcat_id" id="subcat_id">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-8">
                            <select name="category" id="category" class="form-control" required="required">
                                <option value="" id="cat_id" class="cat" name="category">Select Category</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">subCategory</label>
                        <div class="col-sm-8">
                            <input type="text" name="subcategory" id="subcat" required="required" class="form-control" placeholder="subCategory">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <input type="submit" name="editCaste" class="btn btn-warning" id="editCaste" value="Update">
                    </div>
                </form>
            </p>
        </div>
    </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.editsubcat', function(){
            var id = $(this).attr('id');

            // Get subcategory details according to subcategory id
            $.ajax({
                method : 'post',
                url : 'getSubCategoryDetails',
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id': id},
                success:function(response){

                    var obj = $.parseJSON(response);

                    $('#subcat_id').val(obj.id);
                    $('#category option[value="'+obj.cat_id+'"]').attr("selected","selected")
                    $('#subcat').val(obj.subcategory);
                    $('#description').val(obj.description);

                    $('#subcatModal').modal('show');
                },
                error: function(data){
                    console.log(data);
                },
            });

        });
    });
</script>
@endsection
