@extends('layouts.public_app')

@section('content')

<!-- #header -->
<div id="main" class="site-main">
	<div class="container">
		<div class="row">

			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">

                    <div class="col-sm-3">
                        <div class="col-sm-12 top30 p0">
                            <h1 class="brand-header">Categories </h1>
                            <div class="list-group category_list">
                                @foreach($categories as $category)
                                    <a href="{{ URL::to('category',array('category'=>$category->category)) }}" class="list-group-item">
                                        {{ $category->category }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    

					<div class="col-sm-9">
                        <div class="col-sm-12 top30 p0">
                            <h1 class="brand-header">Latest offers </h1>
                        </div>

						<div class="row">
                            @foreach($clients as $client)

    							<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
    								<div class="offer-small offer">

    									<div class="vendor-image">
    										<a href="{{ URL::to('view',array('business'=>$client->business_name, 'id'=>Crypt::encrypt($client->user_id))) }}">
                                                <?php
                                                    if(!empty($client->logo))
                                                    {
                                                ?>
                                                <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $client->logo}}" class="img-responsive" style="height: 125px;">
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
    											<img alt="" src="{{url('/')}}/resources/frontend_assets/images/logo.png" class="img-responsive" style="height: 125px;">
                                                <?php
                                                    }
                                                ?>
    										</a>
    									</div>

    									<div class="offer-title">
                                            <span href="javascript:;"> {{ $client->business_name }} </span>
                                            <div class="offer-ends trim-content">
                                                <i class="fa fa-mobile" aria-hidden="true"></i> {{ $client->phone }}
                                            </div>
    										<div class="col-md-12 offer-location trim-content">
                                                @if(!empty($client->building))

                                                    <i class="fa fa-map-marker"></i>
                                                    {{ $client->building }}, {{ $client->street }}, {{ $client->area }}, {{ $client->city }}, {{ $client->state }}, {{ $client->country }} - {{ $client->pincode }}

                                                @endif
                                            </div>

    									</div>

    									<div class="col-md-12" style="height: 15px;"></div>

    									<div class="offer-getcode">
    										<button onclick="viewCount(899)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_899">Get Sms</button>
    									</div>

    								</div>
    							</div>

                            @endforeach

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>
@endsection



