@extends('layouts.public_app')

@section('content')
<script>
	$(document).ready(function(){
		var user_type = $("[name=type]:checked").val();
		if(user_type=='merchant')
		{
			$('#social_login').hide(); 
		}
		
		$("#hidden").click(function(){
		   $('#social_login').hide();
		});
		$("#visible").click(function(){
			$('#social_login').fadeIn();
		});
	});
</script>
  <!-- #header -->
  <div id="main" class="site-main">
   
    

 <div class="container">
    
    <div id="message">
    		
				
				
		    </div>
		
<div class="row"> 
  
  <!--Banner-->
  <div class="col-sm-12 banner-slider">
    <div class="row">
      <!--<div class="col-sm-12">
        <div class="welcome-msg-ctr" style="margin:0 0 20px 0 ">
          <div class="welcome-ribbon">Welcome</div>
          <div class="welcome-triangle"></div>
          <div class="welcome-msg">New to SaveTk.com? Get free SMS, Show before shop payment and Enjoy amazing discounts !! <a href="http://savetk.com/signup" >Sign up &amp; Save</a> !! </div>
        </div>
      </div>-->
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
        <h1 class="brand-header">Latest offers <a href="latest-offers.html" class="more-store">more...</a></h1>
      </div>
      <div class="col-sm-12">
        <div class="row">
        		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="12% Discount on Any Food Bill." href="offer/899.html">
				  <img alt="Fulkuchi Cafe Shop (1 offer) | 12% Discount on Any Food Bill." src="assets/uploads/cache/coupons/0180390be5b3c2f9b222eb353f05d5f7-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/899.html">
				                    12% Discount on Any Food Bill.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 38 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(899)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_899">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="fulkuchi-cafe-shop.html">Fulkuchi Cafe Shop (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_899" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">12% Discount on Any Food Bill.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_899" name="customer_mobile_899" value="">
																
								<button onclick="sendSms(899)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="fulkuchi-cafe-shop.html">Fulkuchi Cafe Shop</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 38 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="fulkuchi-cafe-shop.html">Fulkuchi Cafe Shop (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 10% Discount on Any Beauty Services." href="offer/1778.html">
				  <img alt="Men's Look (1 offer) | Get 10% Discount on Any Beauty Services." src="assets/uploads/cache/coupons/5b3280314f61f939fb974a8f00ff0db1-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1778.html">
				                    Get 10% Discount on Any Beauty Services.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Dhanmondi</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 43 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1778)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1778">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="mens-look.html">Men's Look (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1778" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 10% Discount on Any Beauty Services.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1778" name="customer_mobile_1778" value="">
																
								<button onclick="sendSms(1778)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="mens-look.html">Men's Look</a> Outlet at <span class="coupon-verified">Dhanmondi</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 43 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="mens-look.html">Men's Look (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 15% Off on Total Billing." href="offer/1253.html">
				  <img alt="Cafe 360 (1 offer) | Get 15% Off on Total Billing." src="assets/uploads/cache/coupons/06f0ca728b8ec89c1a38073135129446-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1253.html">
				                    Get 15% Off on Total Billing.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 37 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1253)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1253">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="cafe-360.html">Cafe 360 (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1253" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 15% Off on Total Billing.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1253" name="customer_mobile_1253" value="">
																
								<button onclick="sendSms(1253)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="cafe-360.html">Cafe 360</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 37 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="cafe-360.html">Cafe 360 (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 10% Discount on Any Food Bill." href="offer/261.html">
				  <img alt="THAI KITCHEN (1 offer) | Get 10% Discount on Any Food Bill." src="assets/uploads/cache/coupons/92f7a1f12c204fb1b03f0a11943c5d4a-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/261.html">
				                    Get 10% Discount on Any Food Bill.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Bashundhara City</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 36 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(261)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_261">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="thai-kitchen.html">THAI KITCHEN (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_261" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 10% Discount on Any Food Bill.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_261" name="customer_mobile_261" value="">
																
								<button onclick="sendSms(261)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="thai-kitchen.html">THAI KITCHEN</a> Outlet at <span class="coupon-verified">Bashundhara City</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 36 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="thai-kitchen.html">THAI KITCHEN (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Flat 10% discount on any food bill. (without party)" href="offer/1116.html">
				  <img alt="Bay Leaf Restaurant (1 offer) | Flat 10% discount on any food bill. (without party)" src="assets/uploads/cache/coupons/ad444982d291c272b2fa9e0ed7cd9427-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1116.html">
				                    Flat 10% discount on any food bill. (without party)				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 36 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1116)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1116">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="bayleaf-restaurant.html">Bay Leaf Restaurant (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1116" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Flat 10% discount on any food bill. (without party)</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1116" name="customer_mobile_1116" value="">
																
								<button onclick="sendSms(1116)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="bayleaf-restaurant.html">Bay Leaf Restaurant</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 36 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="bayleaf-restaurant.html">Bay Leaf Restaurant (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 15% discount on Al Carte Menu" href="offer/1591.html">
				  <img alt="Lounge Comida (2 offers) | Get 15% discount on Al Carte Menu" src="assets/uploads/cache/coupons/0641352e3fed9dc037b2610bd3f497a9-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1591.html">
				                    Get 15% discount on Al Carte Menu				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Gulshan 1</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 36 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1591)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1591">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="lounge-comida.html">Lounge Comida (2 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1591" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 15% discount on Al Carte Menu</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1591" name="customer_mobile_1591" value="">
																
								<button onclick="sendSms(1591)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="lounge-comida.html">Lounge Comida</a> Outlet at <span class="coupon-verified">Gulshan 1</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 36 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="lounge-comida.html">Lounge Comida (2 offers)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 10% Discount on Total Billing." href="offer/1263.html">
				  <img alt="Food Garden (1 offer) | Get 10% Discount on Total Billing." src="assets/uploads/cache/coupons/b2097d9e80772632bf7becb75cf625d7-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1263.html">
				                    Get 10% Discount on Total Billing.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 36 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1263)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1263">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="food-garden.html">Food Garden (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1263" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 10% Discount on Total Billing.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1263" name="customer_mobile_1263" value="">
																
								<button onclick="sendSms(1263)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="food-garden.html">Food Garden</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 36 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="food-garden.html">Food Garden (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="12% off on any food bill." href="offer/1121.html">
				  <img alt="Rihas Cake & Foods (1 offer) | 12% off on any food bill." src="assets/uploads/cache/coupons/41ce18c28b0363ac8772199fa2f66811-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1121.html">
				                    12% off on any food bill.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 36 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1121)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1121">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="rihas-cake-and-foods.html">Rihas Cake & Foods (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1121" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">12% off on any food bill.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1121" name="customer_mobile_1121" value="">
																
								<button onclick="sendSms(1121)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="rihas-cake-and-foods.html">Rihas Cake & Foods</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 36 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="rihas-cake-and-foods.html">Rihas Cake & Foods (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Flat 15% off on Any Services." href="offer/1381.html">
				  <img alt="Heaven Hair Cutting (1 offer) | Flat 15% off on Any Services." src="assets/uploads/cache/coupons/2a18ad79280f21678576293bc7949af1-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1381.html">
				                    Flat 15% off on Any Services.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 44 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1381)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1381">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="heaven-hair-cutting.html">Heaven Hair Cutting (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1381" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Flat 15% off on Any Services.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1381" name="customer_mobile_1381" value="">
																
								<button onclick="sendSms(1381)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="heaven-hair-cutting.html">Heaven Hair Cutting</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 44 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="heaven-hair-cutting.html">Heaven Hair Cutting (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 20% discount on A-La-Carte Menu." href="offer/1672.html">
				  <img alt="Meraki (2 offers) | Get 20% discount on A-La-Carte Menu." src="assets/uploads/cache/coupons/b18c7f31496541a53854a750cacff0fe-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1672.html">
				                    Get 20% discount on A-La-Carte Menu.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Gulshan-2</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 35 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1672)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1672">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="meraki.html">Meraki (2 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1672" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 20% discount on A-La-Carte Menu.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1672" name="customer_mobile_1672" value="">
																
								<button onclick="sendSms(1672)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="meraki.html">Meraki</a> Outlet at <span class="coupon-verified">Gulshan-2</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 35 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="meraki.html">Meraki (2 offers)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Flat 15% Discount on Total Bill." href="offer/994.html">
				  <img alt="Sigree (1 offer) | Flat 15% Discount on Total Bill." src="assets/uploads/cache/coupons/4d515401195192d035c2924c0b744074-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/994.html">
				                    Flat 15% Discount on Total Bill.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 33 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(994)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_994">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="sigree.html">Sigree (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_994" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Flat 15% Discount on Total Bill.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_994" name="customer_mobile_994" value="">
																
								<button onclick="sendSms(994)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="sigree.html">Sigree</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 33 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="sigree.html">Sigree (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Flat 5% Discount on Any Food Bill." href="offer/1814.html">
				  <img alt="American Captain (1 offer) | Flat 5% Discount on Any Food Bill." src="assets/uploads/cache/coupons/565b2a7f312f848fc50bee6b57f94ef9-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1814.html">
				                    Flat 5% Discount on Any Food Bill.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 33 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<button onclick="viewCount(1814)" class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1814">Get Sms</button>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="american-captain.html">American Captain (1 offer)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_1814" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Flat 5% Discount on Any Food Bill.</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
												<div class="code-title">Please enter your mobile number &amp; get free sms.</div>
						<p style="display:none;" class="msg"></p>
						<div class="coupon-code-container">
							<span style="font-size:25px;">+88</span> 
								<input style="width:65%;" placeholder="" maxlength="11" autocomplete="off" class="coupon-code inline-block mobile mobile_num" type="text" id="customer_mobile_1814" name="customer_mobile_1814" value="">
																
								<button onclick="sendSms(1814)" class="btn btn-primary inline-block  get_code">Send</button>
						</div>
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                                                    
                            <div class="inline-block coupon-title">Visit the <a class="coupon-verified" href="american-captain.html">American Captain</a> Outlet at <span class="coupon-verified">Mirpur</span> &amp; Use the above sms to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                            
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 33 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="american-captain.html">American Captain (1 offer)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
            </div>
      </div>
    </div>
  </div>
 
 <!--Online offers-->
  <div class="col-sm-12 offset-margin-2">
    <div class="row">
      <div class="col-sm-12 top30">
        <h1 class="brand-header">E-commerce offers <a href="online.html" class="more-store">more...</a></h1>
      </div>
      <div class="col-sm-12">
        <div class="row">
        		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Othoba.com Daily Shopping." href="offer/2420.html">
				  <img alt="Othoba.com (19 offers) | Othoba.com Daily Shopping." src="assets/uploads/cache/coupons/5b840630539dc3c305d5686a95e2c707-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2420.html">
				                    Othoba.com Daily Shopping.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 22 days, 2 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="https://goo.gl/NHuF9Z" onclick="totalGetCount(2420)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="othoba-com.html">Othoba.com (19 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Free 12 Ltr Bucket Offer SURF EXCEL Washing Powder - 1 kg" href="offer/2415.html">
				  <img alt="Chaldal.Com (21 offers) | Free 12 Ltr Bucket Offer SURF EXCEL Washing Powder - 1 kg" src="assets/uploads/cache/coupons/cb51d15f82ca37f5d7e034f0ae267899-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2415.html">
				                    Free 12 Ltr Bucket Offer SURF EXCEL Washing Powder - 1 kg				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 35 days, 1 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="http://bit.ly/2D0n5z0" onclick="totalGetCount(2415)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="chaldal-com.html">Chaldal.Com (21 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="13% Discount on Aarong Dairy Low Fat Yogurt (Doi) - 500 gm" href="offer/2414.html">
				  <img alt="Chaldal.Com (21 offers) | 13% Discount on Aarong Dairy Low Fat Yogurt (Doi) - 500 gm" src="assets/uploads/cache/coupons/36f057a78ee556400b5513118f474375-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2414.html">
				                    13% Discount on Aarong Dairy Low Fat Yogurt (Doi) - 500 gm				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 28 days, 3 hours, 48 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="http://bit.ly/2qOtOWU" onclick="totalGetCount(2414)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="chaldal-com.html">Chaldal.Com (21 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Buy 2 Get 1 Free Danish Lexus Vegetable Crackers 240 gm x 3" href="offer/2413.html">
				  <img alt="Chaldal.Com (21 offers) | Buy 2 Get 1 Free Danish Lexus Vegetable Crackers 240 gm x 3" src="assets/uploads/cache/coupons/90e78ac87134bfe12224462bbb9f27ea-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2413.html">
				                    Buy 2 Get 1 Free Danish Lexus Vegetable Crackers 240 gm x 3				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 28 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="https://goo.gl/SHxDir" onclick="totalGetCount(2413)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="chaldal-com.html">Chaldal.Com (21 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 3% Off on first order at Chaldal.com" href="offer/794.html">
				  <img alt="Chaldal.Com (21 offers) | Get 3% Off on first order at Chaldal.com" src="assets/uploads/cache/coupons/5a535a00fe7fec40983b9bef625633ee-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/794.html">
				                    Get 3% Off on first order at Chaldal.com				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online coupon</div>
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 41 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
									
					<button onclick="viewCount(794)" class="btn btn-cd btn-code" data-toggle="modal" data-target="#myModal_794">Get Code</button>
                  
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="chaldal-com.html">Chaldal.Com (21 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		<!-- Modal -->
	
		
	<div class="modal fade" id="myModal_794" tabindex="-1" role="dialog"  aria-hidden="true">
		
		<div class="modal-dialog coupon-popup">
			
			<div class="modal-content">
			
				  <a class="custommodal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				  
				  <div class="modal-header"><h4 class="modal-title">Get 3% Off on first order at Chaldal.com</h4></div>
					
				  <div class="modal-body">
				  
					<div class="light section modal-data-section modal-coupon-section">
					
												
						<div class="code-title">Paste this code at checkout process</div>
                        
                        
						<!--<div class="coupon-code-container">
							<div id="coupon_code_794" class="coupon-code inline-block">SAVE 3</div>
							<a data-clipboard-target="div#coupon_code_794" onClick="totalGetCount(794)" data-clipboard-text="SAVE 3" class="btn btn-primary inline-block copy-code zeroclipboard-is-hover get_code">Copy</a>
						</div>-->
						
						<div id="popupCode_794" class="ui-content popupCode">
                            <input class="coupon-code" placeholder="SAVE 3" id="viewCode_794"  value="SAVE 3">
                            <button onClick="totalGetCount(794)" id="copyCode_794" data-id="794" data-url="https://goo.gl/lhKOWq" class="btn btn-primary get_code btn-copy btn-custom btn-code" data-clipboard-target="#viewCode_794">Copy</button>
                        </div>
						
												
						 
						
						
												
					</div>
					
					
					<div class="dark section" style="padding-top:0;">
						<div>
                        							<div class="inline-block coupon-title">Click copy button &amp; Use the above code to avail the offer</div>
							<div data-couponinfo="online" class="offer-wallet"></div>
                                                      
                            
                            
						</div>
						
												
						<div class="separated-data">
							<div class="voting inline-block no-border voted">
								<div data-value="1" class="voteup voted"></div>
								<div data-value="0" class="votedown "></div>
							</div>
							
											
							<div class="coupon-verified inline-block ">
								Verified							</div>
							
							<div class="coupon-end inline-block no-border">Ends: 41 days, 3 hours, 49 mins.</div>
						</div>
						<div class="view-all"><a href="chaldal-com.html">Chaldal.Com (21 offers)</a></div>
				    </div>
				
				  </div>
				  
			</div>
			
		</div>
	
	 </div>
<script type="text/javascript" src="assets/js/clipboard.min.js"></script>

<script type="text/javascript">

$('button[id^=copyCode_]').on('click', function(e){
	var id=$(this).data("id");
	var url=$(this).data("url");
    var clipboard = new Clipboard('#copyCode_'+id);
    clipboard.on('success', function(e) {
		$('#copyCode_'+id).text( "Copied" );
		window.open(url, '_blank'); 
		e.clearSelection();
	 }); 
 });

</script>


		
	
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="64% Discount on Samsung Galaxy S7 EDGE Wireless Fast Charging Pad - Black" href="offer/2412.html">
				  <img alt="daraz.com.bd (29 offers) | 64% Discount on Samsung Galaxy S7 EDGE Wireless Fast Charging Pad - Black" src="assets/uploads/cache/coupons/dddd942e33cae56a6384eb3db4b53e0d-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2412.html">
				                    64% Discount on Samsung Galaxy S7 EDGE Wireless Fast Charging Pad - Black				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 13 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="http://bit.ly/2CVczbz" onclick="totalGetCount(2412)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="daraz-com-bd.html">daraz.com.bd (29 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="New Year New Home - Up to 50% off on Home Appliances. " href="offer/2410.html">
				  <img alt="daraz.com.bd (29 offers) | New Year New Home - Up to 50% off on Home Appliances. " src="assets/uploads/cache/coupons/53efc4b6eb95b3b6ad6401d72d304d2d-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2410.html">
				                    New Year New Home - Up to 50% off on Home Appliances. 				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 12 days, 20 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="http://bit.ly/2D9Sk7q" onclick="totalGetCount(2410)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="daraz-com-bd.html">daraz.com.bd (29 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
		<div class="col-lg-3 col-sm-3 col-xs-6 res-cop-box">
	        
        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Down to Party - Up to 70% Discount." href="offer/2409.html">
				  <img alt="daraz.com.bd (29 offers) | Down to Party - Up to 70% Discount." src="assets/uploads/cache/coupons/f5e4d8f0e5dfc9a0a202984e359d0b65-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2409.html">
				                    Down to Party - Up to 70% Discount.				  </a>
			  
                              <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                               <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 20 days, 3 hours, 49 mins.</div>
			  
              
              </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
								
								

				<a target="_blank" href="http://bit.ly/2m9xRaR" onclick="totalGetCount(2409)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="daraz-com-bd.html">daraz.com.bd (29 offers)</a> 
			  </div>
			  
		</div>
			
    </div>
	
		
            </div>
      </div>
    </div>
  </div>
 
  <div class="col-sm-12 offset-margin-2">
    <div class="row">
      <div class="col-sm-12 top30">
        <h1 class="brand-header">special offers</h1>
      </div>
      <div class="col-sm-12">
        <div class="owl-carousel owl-theme">
          
	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 3% Off on first order at Chaldal.com" href="offer/794.html">
				  <img alt="Get 3% Off on first order at Chaldal.com" src="assets/uploads/cache/coupons/5a535a00fe7fec40983b9bef625633ee-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/794.html">
				                    Get 3% Off on first order at Chaldal.com				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online coupon</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 41 days, 3 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
									
					<a  href="offer/794.html"  class="btn btn-cd btn-code">Get Code</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="chaldal-com.html">Chaldal.Com (21 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Get 20% off on any Services." href="offer/200.html">
				  <img alt="Get 20% off on any Services." src="assets/uploads/cache/coupons/8b9318188ff867b8bdf3c87573505549-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/200.html">
				                    Get 20% off on any Services.				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Gulshan-2</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 13 days, 3 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<a href="offer/200.html"  class="btn btn-cd btn-sms">Get Sms</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="seven-door-spa-and-salon.html">Seven door spa and salon (1 offer)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Up to 70% off on Islamic Book." href="offer/1852.html">
				  <img alt="Up to 70% off on Islamic Book." src="assets/uploads/cache/coupons/1c82b26dbfd90e2316324aae17ee6788-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1852.html">
				                    Up to 70% off on Islamic Book.				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 27 days, 3 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
				
				<a target="_blank" href="https://goo.gl/QUmtqo" onclick="totalGetCount(1852)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="rokomari-com.html">Rokomari.com (12 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Upto 40% off on Winter Collection." href="offer/1277.html">
				  <img alt="Upto 40% off on Winter Collection." src="assets/uploads/cache/coupons/455c72faff9b0ecd7ff2b027b995b706-260x142.png" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1277.html">
				                    Upto 40% off on Winter Collection.				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 37 days, 3 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
				
				<a target="_blank" href="https://goo.gl/q6v2Ag" onclick="totalGetCount(1277)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="othoba-com.html">Othoba.com (19 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="A perfect Lunch meal for one @ BDT 245 Taka" href="offer/977.html">
				  <img alt="A perfect Lunch meal for one @ BDT 245 Taka" src="assets/uploads/cache/coupons/9129b1f067b7ff251a91c42008747087-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/977.html">
				                    A perfect Lunch meal for one @ BDT 245 Taka				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Banani </div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 12 days, 21 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<a href="offer/977.html"  class="btn btn-cd btn-sms">Get Sms</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="absolute-thai.html">Absolute Thai (1 offer)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="15% off on Al-a-carte " href="offer/176.html">
				  <img alt="15% off on Al-a-carte " src="assets/uploads/cache/coupons/50585fc09e18a880f01b8104630cc299-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/176.html">
				                    15% off on Al-a-carte 				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Uttara</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 163 days, 2 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<a href="offer/176.html"  class="btn btn-cd btn-sms">Get Sms</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="royal-cousine.html">Royal Cuisine (2 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="10% off on Lunch and Dinner Buffet" href="offer/177.html">
				  <img alt="10% off on Lunch and Dinner Buffet" src="assets/uploads/cache/coupons/ca67d0c8800dc28f4d1694513df55008-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/177.html">
				                    10% off on Lunch and Dinner Buffet				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Uttara</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 163 days, 2 hours, 48 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<a href="offer/177.html"  class="btn btn-cd btn-sms">Get Sms</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="royal-cousine.html">Royal Cuisine (2 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Flat 20% Discount on Any Spa Service." href="offer/1990.html">
				  <img alt="Flat 20% Discount on Any Spa Service." src="assets/uploads/cache/coupons/fb80bd01b074a750f24edbd4ddc786d1-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1990.html">
				                    Flat 20% Discount on Any Spa Service.				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Gulshan-2</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 102 days, 1 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<a href="offer/1990.html"  class="btn btn-cd btn-sms">Get Sms</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="divine-health-care.html">Divine Health Care & Spa (1 offer)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Up to 56% off on Kitchen Tools." href="offer/1647.html">
				  <img alt="Up to 56% off on Kitchen Tools." src="assets/uploads/cache/coupons/23b0fd88d5958590872b5e141462f657-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/1647.html">
				                    Up to 56% off on Kitchen Tools.				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-tag"></i> Online deal</div> 
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 12 days, 3 hours, 49 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							 
			
				
				<a target="_blank" href="https://goo.gl/YQRY5S" onclick="totalGetCount(1647)" class="btn btn-cd btn-danger online" data-original-title="" title="">Activate Deal</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="othoba-com.html">Othoba.com (19 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Upto 60% discount on room rent and 15% discount on food " href="offer/2216.html">
				  <img alt="Upto 60% discount on room rent and 15% discount on food " src="assets/uploads/cache/coupons/0d38ad8a2b92b11a82aa750afcf8c9a9-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2216.html">
				                    Upto 60% discount on room rent and 15% discount on food 				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-tag"></i> Promotional deal</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 193 days, 16 hours, 20 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
				
				<a href="offer/2216.html" class="btn btn-cd btn-coupon" data-original-title="" title="">View Details</a>
				
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="grameenphone.html">Grameenphone (24 offers)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	

	
	<div class="res-cop-box item">
	        
        <div class="offer-small offer">
			 			  <div class="vendor-image">
				<a title="Enjoy 15% discount on 1000 Tk billing" href="offer/2196.html">
				  <img alt="Enjoy 15% discount on 1000 Tk billing" src="assets/uploads/cache/coupons/7295d328b3458a7c2684c5206013d3a2-260x142.jpg" class="img-responsive">
				 </a> 
			  </div>
			  <div class="offer-title"> 
				<a href="offer/2196.html">
				                    Enjoy 15% discount on 1000 Tk billing				  </a>
                  
                                <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Uttara</div>
                  
			   <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 71 days, 16 hours, 21 mins.</div>
			  </div>
			  
			  
			  					<div class="col-md-12" style="height: 15px;"></div>
							  
			  
			  <div class="offer-getcode">
							
					
					<a href="offer/2196.html"  class="btn btn-cd btn-sms">Get Sms</a>
								
						  </div>
			  			  
			  <div class="vendor-offer-count trim-content"> <a href="sangam-restaurant.html">Sangam Restaurant (1 offer)</a> 
			  </div>
			  
		</div>
		

    </div>
	
	
	


        </div>
        
      </div>
    </div>
  </div>
  <script>
         	$('.owl-carousel').owlCarousel({
			loop:true,
			margin:25,
			autoplay:true,
			autoplayTimeout:2000,
			autoplayHoverPause:true,
			nav:true,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:4
				}
			}
		})
         
         </script> 
  
 
  
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
                        <div class="brand-logo"> <a href="ajkerdeal-com.html"><img class="img-responsive" alt="Ajkerdeal.com Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/85d10360442a5209dc16fcb639a0cded-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="athenas-furniture-and-home-decor.html"><img class="img-responsive" alt="Athenas Furniture & Home Decor Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/fbba960676728b5fb59017e3761f5e04-150x60.jpg" /></a> </div>
                        <div class="brand-logo"> <a href="bistrovia.html"><img class="img-responsive" alt="Bistrovia Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/49668c61de50c05d13ca299f2ab77d42-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="chaldal-com.html"><img class="img-responsive" alt="Chaldal.Com Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/ced95974905570bca11eb03094f5e418-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="daraz-com-bd.html"><img class="img-responsive" alt="daraz.com.bd Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/77f0768e1e15f56fd69e363feced8ede-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="fantasy-kingdom.html"><img class="img-responsive" alt="Fantasy Kingdom Complex Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/18dee38c23c7e9ca0580ba6b60df0524-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="foodee.html"><img class="img-responsive" alt="Foodee Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/7b6edb35d7c25cd55b4a9f392ba561e6-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="gitanjali-jewellers.html"><img class="img-responsive" alt="Gitanjali Jewellers Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/42e262e507ba339b000e9f02e5561d5c-150x60.jpg" /></a> </div>
                        <div class="brand-logo"> <a href="grand-sultan-tea-resort-and-golf.html"><img class="img-responsive" alt="Grand Sultan Tea Resort & Golf Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/62394b4f39f347bb0c210e444cfd636a-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="le-pizzaria.html"><img class="img-responsive" alt="Le Pizzaria  Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/87d49567233fe9067d056a0089bf4dac-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="nordic-hotels-merchant983.html"><img class="img-responsive" alt="Nordic Hotels Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/8c272e2fe9d1bf2e0f046cbaf7c04b10-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="othoba-com.html"><img class="img-responsive" alt="Othoba.com Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/8547d2ae708b7683bfc2de9438d89337-150x60.png" /></a> </div>
                        <div class="brand-logo"> <a href="rokomari-com.html"><img class="img-responsive" alt="Rokomari.com Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/7b1d43b90637f10bbb686f52e328047b-150x60.jpg" /></a> </div>
                        <div class="brand-logo"> <a href="womans-world.html"><img class="img-responsive" alt="Woman's World Discount Offers, Vouchers, Coupons, Promo Code & SMS Deals" src="assets/uploads/cache/merchant/28b07eefa4512958cbd5c1a96c7b2f7f-150x60.jpg" /></a> </div>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
@endsection



