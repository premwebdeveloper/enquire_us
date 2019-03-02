@extends('layouts.auth_app')

@section('content')

<script type="text/javascript">
    $(document).ready(function(){

        // Get sub categories according to category
        $("#category").change(function(){
            var id = $(this).val();

            if(id != '')
            {
                $('#page').attr('disabled', 'disabled');
                $('#business').attr('disabled', 'disabled');
            }
            else
            {
                $('#page').removeAttr('disabled', 'disabled');
                $('#business').removeAttr('disabled', 'disabled');
            }

            $.ajax({
                method : 'post',
                url : 'getSubcategoriesAccordingToCategory',
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'cat_id': id},
                success:function(response){
                    $('#sub_category').html(response);
                },
                error: function(data){
                    console.log(data);
                },
            });

        });

        // If page name is filled dynamic page not creating
        $('#page').change(function(){
            var page = $(this).val();
            if(page != '')
            {
                $('#category').attr('disabled', 'disabled');
                $('#sub_category').attr('disabled', 'disabled');
                $('#city').attr('disabled', 'disabled');
                $('#area').attr('disabled', 'disabled');
                $('#business').attr('disabled', 'disabled');
            }
            else
            {
                $('#category').removeAttr('disabled', 'disabled');
                $('#sub_category').removeAttr('disabled', 'disabled');
                $('#city').removeAttr('disabled', 'disabled');
                $('#area').removeAttr('disabled', 'disabled');
                $('#business').removeAttr('disabled', 'disabled');
            }
        });

        // If Business name is selected then -
        $('#business').change(function(){
            var business = $(this).val();
            if(business != '')
            {
                $('#category').attr('disabled', 'disabled');
                $('#sub_category').attr('disabled', 'disabled');
                $('#page').val('');
                $('#page').attr('disabled', 'disabled');
                $('#city').attr('disabled', 'disabled');
            }
            else
            {
                $('#category').removeAttr('disabled', 'disabled');
                $('#sub_category').removeAttr('disabled', 'disabled');
                $('#page').removeAttr('disabled', 'disabled');
                $('#city').removeAttr('disabled', 'disabled');
            }
        });

    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Website Page Titles</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Website Page Titles</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"> &nbsp; </div>
</div>

<!-- Add page head titles -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Page Titles</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    @if(isset($status) && !empty($status))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $status }}
                        </div>
                    @endif
                
                    <!-- if the page url and titles are exist then update -->
                    @if(!empty($exist))
                        
                        <div class="row">
                            <form method="post" action="{{ route('update_page_titles') }}">

                                {{ csrf_field() }}

                                <input type="hidden" name="u_cat_id" value="{{ $exist->category }}" />
                                <input type="hidden" name="u_subcat_id" value="{{ $exist->subcategory }}" />
                                <input type="hidden" name="u_city_id" value="3378" />

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="Category" class="control-label">Category</label>
                                            <select class="form-control" name="u_category" id="u_category" required="required" disabled="disabled">
                                                <option value="">Select Category</option>
                                                @foreach($category as $cat)
                                                    @php
                                                    if($exist->category == $cat->id){
                                                        $selected = 'selected';
                                                    }else{
                                                        $selected = '';
                                                    }
                                                    @endphp
                                                    <option value="{{ $cat->id }}" {{ $selected }}>{{ $cat->category }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                @if(!empty($exist->subcategory))
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="Sub Category" class="control-label">Sub Category</label>
                                                <select class="form-control" name="u_sub_category" id="u_sub_category" disabled="disabled">
                                                    <option value="{{ $exist->subcategory }}">{{ $sub_category_info->subcategory }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="city" class="control-label">City</label>
                                            <select class="form-control" name="u_city" id="u_city" required="required" disabled="disabled">
                                                <option value="3378" selected>Jaipur</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div clear="both">&nbsp;</div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Title</label>
                                            <input type="text" class="form-control" name="u_title" id="u_title" value="{{ $exist->title }}" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div clear="both">&nbsp;</div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Keyword</label>
                                            <textarea name="u_keyword" id="u_keyword" rows="2" class="form-control" required="required">{{ $exist->keyword }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Description</label>
                                            <textarea name="u_description" id="u_description" rows="2" class="form-control" required="required">{{ $exist->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div clear="both">&nbsp;</div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-primary btn-block" name="updateTitles" id="updateTitles" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    @else
                    <!-- New page url and titles create -->
                        <div class="row">
                            <form method="post" action="{{ route('page_titles') }}">

                                {{ csrf_field() }}

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="Category" class="control-label">Category</label>
                                            <select class="form-control" name="category" id="category" required="required">
                                                <option value="">Select Category</option>
                                                @foreach($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="Sub Category" class="control-label">Sub Category</label>
                                            <select class="form-control" name="sub_category" id="sub_category">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="city" class="control-label">City</label>
                                            <select class="form-control" name="city" id="city" required="required">
                                                <option value="">Select City</option>
                                                <option value="3378">Jaipur</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div clear="both">&nbsp;</div>

                                <!-- <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Business Name</label>
                                            <select class="form-control" name="business" id="business">
                                                <option value="">Select Business</option>
                                                @foreach($business as $busi)
                                                    <option value="{{ $busi->user_id }}">{{ $busi->business_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Page</label>
                                            <input type="text" class="form-control" name="page" id="page" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div clear="both">&nbsp;</div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Keyword</label>
                                            <textarea name="keyword" id="keyword" rows="2" class="form-control" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="page" class="control-label">Description</label>
                                            <textarea name="description" id="description" rows="2" class="form-control" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div clear="both">&nbsp;</div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-primary btn-block" name="addTitles" id="addTitles" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Show all pages head titles -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pages Titles</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                    </div>
                </div>
                <div class="ibox-content">

                    @if(session('status'))
                       <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example page_titles_data_table">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th>Title</th>
                                    <th>Keyword</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit Page titles Modal -->
<div id="pageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Page Titles</h4>
        </div>
        <div class="modal-body">
            <p>
                <form method="post" action="{{ route('editPageUrlTitle') }}">

                    {{ csrf_field() }}

                    <input type="hidden" name="row_id" id="row_id">

                    <div class="form-group">
                        <label>Title</label>
                        <textarea name="edit_title" id="edit_title" class="form-control" placeholder="Title"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Keyword</label>
                        <textarea name="edit_keyword" id="edit_keyword" class="form-control" placeholder="Keyword"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="edit_description" id="edit_description" class="form-control" placeholder="Description"></textarea>
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" name="editPageUrlTitle" class="btn btn-warning" id="editPageUrlTitle" value="Update">
                    </div>
                </form>
            </p>
        </div>
    </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        var pTable = $('.page_titles_data_table').dataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('getAllPageTitles') }}",
            "columns": [
                {data: 'page_url', name: 'page_url'},
                {data: 'title', name: 'title'},
                {data: 'keyword', name: 'keyword'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action'}
            ],
        });

        // Edit page url and titles
        $(document).on('click', '.editPageUrlTitle', function(){
            var id = $(this).attr('id');
            var temp = id.split('_');
            var row_id = temp[1];

            // Get all titles and page url of this row id
            $.ajax({
                method : 'post',
                url : 'getPageUrlTitles',
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id': row_id},
                success:function(response){

                    var obj = $.parseJSON(response);

                    $('#row_id').val(obj.id);
                    $('#edit_title').val(obj.title);
                    $('#edit_keyword').val(obj.keyword);
                    $('#edit_description').val(obj.description);
                    $('#pageModal').modal('show');

                },
                error: function(data){
                    console.log(data);
                },
            });
        });
    });
</script>

@endsection