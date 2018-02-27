@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Slider</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>Sliders </li>
            <li class="active">
                <strong>Add Slider</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add Slider</h5>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" action="{{ route('add_slider') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Slider Image</label>
                        <div class="col-sm-8">
                            <input type="file" name="file[]" class="form-control" required="required" multiple>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" name="add_caste" type="submit">Add Slider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection