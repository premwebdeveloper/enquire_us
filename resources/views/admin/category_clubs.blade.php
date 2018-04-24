@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>All Cateogry Clubs</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('Category') }}">Cateogries</a>
            </li>
            <li class="active">
                <strong>Cateogry Clubs</strong>
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
                    <h5>Create Cateogry Club</h5>
                </div>

                <div class="ibox-content">

                    <form method="post" action="{{ route('create_category_club') }}">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Club Name</label>
                            <input type="text" name="club_name" id="club_name" class="form-control" placeholder="Club Name" required="required">
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
                                <input type="submit" name="create_category_club" value="Create Club" class="btn btn-info btn-md">
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Show all catrgory clubs -->
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Cateogry Clubs</h5>
	            </div>

	            <div class="ibox-content">
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>Club Name</th>
                                    <th>Cateogries</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            @foreach($category_clubs as $club)
	                                <tr class="gradeX">
                                        <td>{{ $club['category_club_name'] }}</td>
                                        <td>{{ rtrim($club['category_name'], ', ') }}</td>
                                    	<td>
                                            <a href="{{ route('edit_club', $club['category_club']) }}" class="btn btn-danger">Edit</a>
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
