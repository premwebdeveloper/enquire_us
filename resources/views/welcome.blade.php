@extends('layouts.public_app')

@section('content')

<!-- #header -->
<div id="main" class="site-main">
	<div class="container">
		<div class="row">

            <!--Banner-->
            <div class="col-sm-12 banner-slider">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="slider-wrapper theme-default">
                            <div id="slider" class="nivoSlider">
                                @foreach($sliders as $slider)
                                    <a href="javascript:;">
                                        <img class="img-responsive" src="storage/app/uploads/{{$slider->image}}" alt="Grand Sultan Tea Resort & Golf" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="slider-wrapper theme-default">
                            <div id="slider1" class="nivoSlider">
                                @foreach($sliders as $slider)
                                    <a href="javascript:;">
                                        <img class="img-responsive" src="storage/app/uploads/{{$slider->image}}" alt="Grand Sultan Tea Resort & Golf" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="slider-wrapper theme-default">
                            <div id="slider2" class="nivoSlider">
                                @foreach($sliders as $slider)
                                    <a href="javascript:;">
                                        <img class="img-responsive" src="storage/app/uploads/{{$slider->image}}" alt="Grand Sultan Tea Resort & Golf" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#slider').nivoSlider({
                        effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                        animSpeed: 1500,                   // Slide transition speed
                        pauseTime: 6000,                  // How long each slide will show
                        startSlide: 0,                    // Set starting Slide (0 index)
                        directionNav: true,               // Next & Prev navigation
                        controlNav: false,                 // 1,2,3... navigation
                        controlNavThumbs: false,          // Use thumbnails for Control Nav
                        pauseOnHover: true,               // Stop animation while hovering
                        manualAdvance: false,
                    });                    
                    $('#slider1').nivoSlider({
                        effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                        animSpeed: 1500,                   // Slide transition speed
                        pauseTime: 6000,                  // How long each slide will show
                        startSlide: 0,                    // Set starting Slide (0 index)
                        directionNav: true,               // Next & Prev navigation
                        controlNav: false,                 // 1,2,3... navigation
                        controlNavThumbs: false,          // Use thumbnails for Control Nav
                        pauseOnHover: true,               // Stop animation while hovering
                        manualAdvance: false,
                    });                    
                    $('#slider2').nivoSlider({
                        effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                        animSpeed: 1500,                   // Slide transition speed
                        pauseTime: 6000,                  // How long each slide will show
                        startSlide: 0,                    // Set starting Slide (0 index)
                        directionNav: true,               // Next & Prev navigation
                        controlNav: false,                 // 1,2,3... navigation
                        controlNavThumbs: false,          // Use thumbnails for Control Nav
                        pauseOnHover: true,               // Stop animation while hovering
                        manualAdvance: false,
                    });
                });
            </script>
            
			<div class="col-sm-12 banner-slider">
			    <div class="row">
                    @foreach($category as $cat)
                    <?php

                        $cat_name = $cat->category;
                        $cat_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $cat_name);
                        $encrypted = Crypt::encrypt($cat->id);
                    ?>
    					<div class="col-sm-2">
    						<div class="row">
    							<div class="col-lg-12 res-catagories">
                                    
								    <a class="cata-box" href="{{ URL::to('category',array('category' => $cat->page_url, 'id' => $encrypted)) }}">
                                        <span>
        									<img src="resources/frontend_assets//images/food.png" alt="{{ $cat->category }}" />
                                        </span>
                                        <br>
                                        {{ $cat->category }}
                                    </a>
                                    
    							</div>
    						</div>
    					</div>
                    @endforeach
                </div>
			</div>

			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">
					<div class="col-sm-12 top30">
						<h1 class="brand-header">Our Partners </h1>
					</div>
					<div class="col-sm-12">
						<div class="row">
                            @foreach($home_page_clients as $home_page_client)
							<div class="col-lg-55 col-md-55 col-sm-55 col-xs-12 res-cop-box">
								<div class="offer-small offer">
									<div class="vendor-image amit">
										<a title="{{$home_page_client->business_name}}." href="{{ URL::to('view', array('business_url' => $home_page_client->page_url, 'id' => Crypt::encrypt($home_page_client->user_id) )) }}">
                                            <?php
                                                if(!empty($home_page_client->logo))
                                                {
                                            ?>
                                                <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $home_page_client->logo}}" class="img-responsive" style="height: 125px;">
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                                <img alt="" src="{{url('/')}}/resources/frontend_assets/images/logo.png" class="img-responsive">
                                            <?php
                                                }
                                            ?>
										</a>
									</div>

<!-- 									<div class="offer-title">
										<a href="offer/899.html"> 12% Discount on Any Food Bill. </a>
										<div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
										<div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 38 days, 3 hours, 49 mins.</div>
									</div>

									<div class="col-md-12" style="height: 15px;"></div>

									<div class="offer-getcode">
										<button onclick="viewCount(899)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_899">Get Sms</button>
									</div> -->
                                    
								</div>
							</div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>

			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">
					<div class="col-sm-12 top30">
						<h1 class="brand-header">Latest</h1>
					</div>
					<div class="col-sm-12">
						<div class="row">
                            @foreach($latest_home_page_clients as $latest_home_page_client)
                            <div class="col-lg-55 col-md-55 col-sm-55 col-xs-12 res-cop-box">
                                <div class="offer-small offer">
                                    <div class="vendor-image amit">
                                        <a title="{{$home_page_client->business_name}}." href="{{ URL::to('view', array('business_url' => $latest_home_page_client->page_url, 'id' => Crypt::encrypt($latest_home_page_client->user_id) )) }}">
                                            <?php
                                                if(!empty($latest_home_page_client->logo))
                                                {
                                            ?>
                                                <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $latest_home_page_client->logo}}" class="img-responsive" style="height: 125px;">
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                                <img alt="" src="{{url('/')}}/resources/frontend_assets/images/logo.png" class="img-responsive">
                                            <?php
                                                }
                                            ?>
                                        </a>
                                    </div>

<!--                                    <div class="offer-title">
                                        <a href="offer/899.html"> 12% Discount on Any Food Bill. </a>
                                        <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                                        <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 38 days, 3 hours, 49 mins.</div>
                                    </div>

                                    <div class="col-md-12" style="height: 15px;"></div>

                                    <div class="offer-getcode">
                                        <button onclick="viewCount(899)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_899">Get Sms</button>
                                    </div> -->
                                    
                                </div>
                            </div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>

			<!--Featured Stores-->
<!-- 			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-12 top30">
								<h3 class="brand-header"> Featured Stores <a href="store.html" class="more-store">more...</a> </h3>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 res-catagories">
								<div class="brand-logo">
									<a href="ajkerdeal-com.html">
										<img class="img-responsive" alt="" src="assets/uploads/cache/merchant/85d10360442a5209dc16fcb639a0cded-150x60.png" />
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->

		</div>
	</div>
</div>
@endsection



