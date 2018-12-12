@extends('layouts.auth_app')

@section('content')
    <div class="wrapper wrapper-content">

        <div class="row">
            <div class="col-lg-3">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-lg-3">
                            <i class="fa fa-meetup fa-4x"></i>
                        </div>
                        <div class="col-lg-9 text-right">
                            <span> Total Meeting Create </span>
                            <h2 class="font-bold"><?= $total_meeting;?></h2>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-lg-3">
                            <i class="fa fa-thumbs-up fa-4x"></i>
                        </div>
                        <div class="col-lg-9 text-right">
                            <span> Total Meeting Done </span>
                            <h2 class="font-bold">26'C</h2>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-lg-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-lg-3">
                            <i class="fa fa-mail-forward fa-4x"></i>
                        </div>
                        <div class="col-lg-9 text-right">
                            <span> Total Meeting Follow Up </span>
                            <h2 class="font-bold">26'C</h2>
                        </div>
                    </div>
                </div>
            </div>           
            <a href="{{ route('addUser_basic_information') }}">          
                <div class="col-lg-3">
                    <div class="widget style1 red-bg">
                        <div class="row">
                            <div class="col-lg-3">
                                <i class="fa fa-plus fa-4x"></i>
                            </div>
                            <div class="col-lg-9 text-right">
                                <h2 class="font-bold">Create Meeting</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="row">
    <div class="col-lg-12">

@endsection