@extends('layouts.auth_app')

@section('content')

<style>
    .checked{color: orange;}
</style>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Reviews</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Reviews</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right pt10">
        &nbsp;
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
                <h5>Reviews</h5>
            </div>

            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Phone</th>
                                <th>User Review</th>
                                <th>Rating</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr class="gradeX">
                                    <td>{{ $review->business_name }}</td>
                                    <td>{{ $review->name }}</td>
                                    <td>{{ $review->email }}</td>
                                    <td>{{ $review->phone }}</td>
                                    <td>{{ $review->review }}</td>
                                    <td>
                                        <?php 
                                            for($i = 1; $i<= $review->rating; $i++ ){
                                                ?>
                                                    <span class="fa fa-star checked">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>{{ $review->created_at }}</td>
                                    <td> <a href="{{ route('review_remove', ['id' => $review->id]) }}" title="Delete Review" class="btn btn-info btn-sm">Delete</a> </td>
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