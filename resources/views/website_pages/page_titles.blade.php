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
                $('#page').attr('disabled', 'disabled');
            }
            else
            {
                $('#category').removeAttr('disabled', 'disabled');
                $('#sub_category').removeAttr('disabled', 'disabled');
                $('#page').removeAttr('disabled', 'disabled');
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
                    @if(session('status'))
                       <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

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

                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="area" class="control-label">Area</label>
                                        <select class="form-control" name="area" id="area">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> -->

                            <div clear="both">&nbsp;</div>

                            <div class="col-sm-3">
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
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="page" class="control-label">Page</label>
                                        <input type="text" class="form-control" name="page" id="page" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
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
                                        <textarea name="keyword" id="keyword" rows="1" class="form-control" required="required"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="page" class="control-label">Description</label>
                                        <textarea name="description" id="description" rows="1" class="form-control" required="required"></textarea>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Title</th>
                                <th>Keyword</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($titles))
                                @foreach($titles as $title)
                                <tr class="gradeX">
                                    <td>{{ $title->page_url }}</td>
                                    <td>{{ $title->title }}</td>
                                    <td>{{ $title->keyword }}</td>
                                    <td>{{ $title->description }}</td>
                                    <td> <a class="btn btn-success editPage" href="javascript:;" id="dfg"> Edit </a> </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>

@endsection