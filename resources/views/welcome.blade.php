@extends('layouts.public_app')

@section('content')

<!-- #header -->
<div id="main" class="site-main">
	<div class="container">
		<div class="row">


			<!--Banner-->
			<div class="col-sm-12 banner-slider">
			    <div class="row">
					<div class="col-sm-3">
						<div class="row">
							<div class="col-lg-12 res-catagories">
                                @foreach($category as $cat)
                                <?php

                                    $cat_name = $cat->category;
                                    $cat_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $cat_name);
                                    $encrypted = Crypt::encrypt($cat->id);
                                ?>
								    <a class="cata-box" href="{{ URL::to('category',array('category' => $cat->page_url, 'id' => $encrypted)) }}">
                                        <span>
        									<img src="resources/frontend_assets//images/food.png" alt="{{ $cat->category }}" />{{ $cat->category }}
                                        </span>
                                    </a>
                                @endforeach
							</div>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="slider-wrapper theme-default">
						  	<div id="slider" class="nivoSlider">
                                @foreach($sliders as $slider)
    						        <a href="javascript:;">
    						        	<img class="img-responsive" src="storage/app/uploads/{{$slider->image}}" alt="Grand Sultan Tea Resort & Golf" />
    						        </a>
                                @endforeach
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
									controlNav: true,                 // 1,2,3... navigation
									controlNavThumbs: false,          // Use thumbnails for Control Nav
									pauseOnHover: true,               // Stop animation while hovering
									manualAdvance: false,
								});
							});
						</script>
					</div>

			    </div>
			</div>

			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">
					<div class="col-sm-12 top30">
						<h1 class="brand-header">Latest offers </h1>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
								<div class="offer-small offer">
									<div class="vendor-image">
										<a title="12% Discount on Any Food Bill." href="offer/899.html">
											<img alt="" src="assets/uploads/cache/coupons/0180390be5b3c2f9b222eb353f05d5f7-260x142.png" class="img-responsive">
										</a>
									</div>

									<div class="offer-title">
										<a href="offer/899.html"> 12% Discount on Any Food Bill. </a>
										<div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
										<div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 38 days, 3 hours, 49 mins.</div>
									</div>

									<div class="col-md-12" style="height: 15px;"></div>

									<div class="offer-getcode">
										<button onclick="viewCount(899)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_899">Get Sms</button>
									</div>

									<div class="vendor-offer-count trim-content">
										<a href="fulkuchi-cafe-shop.html">Fulkuchi Cafe Shop (1 offer)</a>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">
					<div class="col-sm-12 top30">
						<h1 class="brand-header">Latest offers </h1>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
								<div class="offer-small offer">
									<div class="vendor-image">
										<a title="12% Discount on Any Food Bill." href="offer/899.html">
											<img alt="" src="assets/uploads/cache/coupons/0180390be5b3c2f9b222eb353f05d5f7-260x142.png" class="img-responsive">
										</a>
									</div>

									<div class="offer-title">
										<a href="offer/899.html"> 12% Discount on Any Food Bill. </a>
										<div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
										<div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 38 days, 3 hours, 49 mins.</div>
									</div>

									<div class="col-md-12" style="height: 15px;"></div>

									<div class="offer-getcode">
										<button onclick="viewCount(899)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_899">Get Sms</button>
									</div>

									<div class="vendor-offer-count trim-content">
										<a href="fulkuchi-cafe-shop.html">Fulkuchi Cafe Shop (1 offer)</a>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Featured Stores-->
			<div class="col-sm-12">
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
			</div>

		</div>
	</div>
</div>
@endsection



