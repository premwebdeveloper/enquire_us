@extends('layouts.public_app')
@section('content')

<div id="main" class="site-main">
    <div class="container">
        <div class="row">

        	<div class="col-sm-3">
        		<div class="box">
        			<div class="list-group sidebar-nav">
    			        <ul class="nav nav-tabs" role="tablist">

                            <li class="active" id="dashboard_menu">
                                <a href="#dashboard" class="list-group-item" aria-controls="dashboard" role="tab" data-toggle="tab" aria-expanded="true">
                                    <i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span>
                                </a>
                            </li>

                            <li id="location_menu">
                                <a href="#loc" class="list-group-item" aria-controls="location" role="tab" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-map-marker fa-fw"></i> <span>Location Information</span>
                                </a>
                            </li>

                            <li id="contact_menu">
                                <a href="#contact" class="list-group-item" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-phone fa-fw"></i> <span>Contact Information</span>
                                </a>
                            </li>

                            <li id="other_menu">
                                <a href="#other" class="list-group-item" aria-controls="other" role="tab" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-cog fa-fw"></i> <span>Other Information</span>
                                </a>
                            </li>

                            <li id="business_menu">
                                <a href="#business" class="list-group-item" aria-controls="business" role="tab" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-cog fa-fw"></i> <span>Business Keywords</span>
                                </a>
                            </li>

                            <li id="keyword_menu">
                                <a href="#add_keywords" class="list-group-item text-center" role="tab" data-toggle="tab" style="color: #a59898;">
                                    <i class="fa fa-arrow-right fa-fw"></i> <span>Add Keywords</span>
                                </a>
                            </li>

                            <li id="logo_menu">
                                <a href="#uploads_video" class="list-group-item" aria-controls="uploads_video" role="tab" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-photo fa-fw"></i> <span>Uploads Logo/Pictures</span>
                                </a>
                            </li>

                            <li id="change_password_menu">
                                <a href="#change_password" class="list-group-item" aria-controls="uploads_video" role="tab" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-lock fa-fw"></i> <span>Change Password</span>
                                </a>
                            </li>

                            <li id="change_password_menu">
                                <a href="{{ route('enquiry') }}" class="list-group-item">
                                    <i class="fa fa-lock fa-fw"></i> <span>Enquiries</span>
                                </a>
                            </li>

                        </ul>
        			</div>
        		</div>
        	</div>

            <div class="col-sm-9">

                <h1 style="margin-top: 0px;">Enquiries</h1>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Enquiry</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $key => $enquiry)
                            
                            <tr>
                                <td>
                                    @if(!empty($enquiry->category))
                                        {{ $enquiry->category }}
                                    @else
                                        {{ $enquiry->subcategory }}                                    
                                    @endif
                                </td>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone }}</td>
                                <td>{{ $enquiry->enquiry }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection