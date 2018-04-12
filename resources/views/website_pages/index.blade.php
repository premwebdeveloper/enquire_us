@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Website Pages</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Website Pages</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Website Pages Information</h5>
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
                                <th>Page Name</th>
                                <th>Page Description</th>
                                <th>Updated Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($web_pages as $web)

                                <?php $value = str_limit($web->page_description, 200); ?>

                                <tr class="gradeX">
                                    <td id="exitTitle_{{$web->id}}">{{ $web->page_title }}</td>
                                    <td id="exitDesc_{{$web->id}}" style="display:none">{{ $web->page_description }}</td>
                                    <td>{{ $value }}</td>
                                    <td>{{ $web->updated_at }}</td>
                                    <td>

                                        <a class="btn btn-success editPage" href="javascript:;" id="{{ $web->id }}">
                                            Edit
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
<div id="webModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Website Page</h4>
        </div>
        <div class="modal-body">
            <p>
                <form method="post" action="{{ route('update_page') }}">

                    {{ csrf_field() }}

                    <input type="hidden" name="id" id="cat_id">

                    <div class="form-group">
                        <input type="text" name="pag" id="Title" required="required" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="content" id="Desc" rows="10" required></textarea>
                    </div>

                    <div class="form-group text-right">
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
        $(document).on('click', '.editPage', function(){
            var id = $(this).attr('id');
            var page_title = $('#exitTitle_'+id).text();
            var page_desc = $('#exitDesc_'+id).text();

            $('#cat_id').val(id);
            $('#Title').val(page_title);
            $('#Desc').val(page_desc);
            $('#webModal').modal('show');
        });
    });
</script>

@endsection