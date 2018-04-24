@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Edit Cateogry Club</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('Category') }}">Cateogries</a>
            </li>
            <li>
                <a href="{{ route('categoryClubs') }}">Cateogry Clubs</a>
            </li>
            <li class="active">
                <strong>Edit Cateogry Club</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right"> </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="ibox-title">
                    <h5>Edit Cateogry Club</h5>
                </div>

                <div class="ibox-content">

                    <form method="post" action="{{ route('edit_category_club') }}">

                        {{ csrf_field() }}
                        <input type="hidden" name="category_club" value="{{ $category_club[0]['category_club'] }}">

                        <div class="form-group">
                            <label>Club Name</label>
                            <input type="text" name="club_name" id="club_name" class="form-control" placeholder="Club Name" required="required" value="{{ $category_club[0]['category_club_name'] }}">
                        </div>

                        <br />

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Cateogry</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- All selected categories -->
                                    @foreach($category_club as $club)
                                        <tr class="gradeX">
                                            <td>
                                                <input type="checkbox" name="select_category[]" value="{{ $club['category_id'] }}" class="Select_category" checked>
                                            </td>
                                            <td>{{ $club['category'] }}</td>
                                        </tr>
                                    @endforeach

                                    <!-- All categories which are not clubed -->
                                    @foreach($category as $cat)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" name="select_category[]" value="{{ $cat['id'] }}" class="Select_category"></td>
                                            <td>{{ $cat['category'] }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <!-- create category club button -->
                            <div class="col-md-12 text-right">
                                <input type="submit" name="create_category_club" value="Edit Club" class="btn btn-info btn-md">
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
