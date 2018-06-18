@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Keywords</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Keywords</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">&nbsp;</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                @if(session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="ibox-title">
                    <h5>Keywords</h5>
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
                                    <th>Keyword</th>
                                    <th>Identity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Show all categories -->

                                @foreach($categories as $key => $category)
                                    <tr class="gradeX">
                                        <td>{{ $category->category }}</td>
                                        <td>category</td>        
                                        <td>
                                            <form method="post" action="{{ route('edit_keyword_city_visibility')}}">
                                            
                                                {{ csrf_field() }}
                                                <input type="hidden" name="keyword_id" value="{{ $category->id }}">
                                                <input type="hidden" name="keyword_identity" value="1">
                                                
                                                <button type="submit" name="keyword_city_visibility" class="btn btn-success">Edit Keyword City Visibility</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Show all sub categories -->

                                @foreach($subcategories as $s_key => $subcategory)
                                    <tr class="gradeX">
                                        <td>{{ $subcategory->subcategory }}</td>
                                        <td>subcategory</td>        
                                        <td>
                                            <form method="post" action="{{ route('edit_keyword_city_visibility')}}">
                                            
                                                {{ csrf_field() }}
                                                <input type="hidden" name="keyword_id" value="{{ $subcategory->id }}">
                                                <input type="hidden" name="keyword_identity" value="2">
												
												<button type="submit" name="keyword_city_visibility" class="btn btn-success">Edit Keyword City Visibility</button>
											</form>
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
