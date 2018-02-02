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
								<a class="cata-box" href="category/food-and-drinks.html"><span>
									<img src="resources/frontend_assets//images/food.png" alt="Restaurants Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />Food &amp; Drinks</span></a>

								<a class="cata-box" href="category/beauty.html"><span>
									<img src="resources/frontend_assets//images/beauty.png" alt="Beauty Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />Beauty</span></a>

								<a class="cata-box" href="category/electronics.html"><span>
									<img src="resources/frontend_assets//images/electronics.png" alt="Electronics Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />Electronics</span></a>

								<a class="cata-box" href="category/moblie-and-laptop.html"><span>
									<img src="resources/frontend_assets//images/mobile-tablets-small.png" alt="Mobile &amp; Laptop Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />Mobile &amp; Laptop</span></a>

								<a class="cata-box" href="category/fashion.html"><span>
									<img src="resources/frontend_assets//images/clothing.png" alt="Fashion Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />Fashion's</span></a>

							 	<a class="cata-box" href="category/gift-and-jewellery.html"><span>
							 		<img src="resources/frontend_assets//images/gifts-icon-small.png" alt="Gift &amp; Jewellery Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />Gift &amp; Jewellery</span></a>

							 	<a class="cata-box" href="category/ecommerce.html"><span>
							 		<img src="resources/frontend_assets//images/E-commerce-small.png" alt="E-Commerce Discount Offers, Vouchers, Coupons, Promo Code &amp; SMS Deals" />E-Commerce</span></a>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="slider-wrapper theme-default">
						  	<div id="slider" class="nivoSlider">
						        <a href="grand-sultan-tea-resort-and-golf.html">
						        	<img class="img-responsive" src="resources/frontend_assets//uploads/banner/e6f01314fab0326f86fffe3cb3c69031.jpg" alt="Grand Sultan Tea Resort & Golf" />
						        </a>
						        <a href="food-booking.html">
						        	<img class="img-responsive" src="resources/frontend_assets//uploads/banner/d947622c3d8bb5c098864dda05a1e96c.jpg" alt="Event Food Booking" />
						        </a>
						        <a href="fantasy-kingdom.html">
						        	<img class="img-responsive" src="resources/frontend_assets//uploads/banner/93aebfb8dfb6c80156c67890661c9a60.jpg" alt="Fantasy Kingdom Complex Coupon, Offer, Discount and More." />
						        </a>
						        <img class="img-responsive" src="resources/frontend_assets//uploads/banner/10dd0287672e638625148e8f8320a115.png" alt="Home Slider One" />
						        <a href="mregister.html">
						        	<img class="img-responsive" src="resources/frontend_assets//uploads/banner/c479881dd39289327dd58c77208be173.png" alt="Merchant Registration" />
						        </a>
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



