@extends('layouts.public_app')
@section('content')

<div id="main" class="site-main">
    <div class="container">
        <div class="row">

        	<div class="col-sm-3">
        		<div class="box">
        			<div class="list-group sidebar-nav">
    			        <ul class="nav nav-tabs" role="tablist">

                            <li id="change_password_menu">
                                <a href="{{ route('profile') }}" class="list-group-item">
                                    <i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span>
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

            <!-- Myself enquiries -->
            <div class="col-sm-9">

                <h1 style="margin-top: 0px;"> My Enquiries </h1>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Enquiry</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($my_enquiries as $key => $enquiry)
                            
                            <tr>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone }}</td>
                                <td>{{ $enquiry->enquiry }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>

            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>

            <!-- Enquiries for my keywords -->
            <div class="col-sm-9 col-sm-offset-3">

                <h1 style="margin-top: 0px;"> Keyword Enquiries </h1>

                <table class="table table-bordered">
                    <thead>
                        <tr>
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