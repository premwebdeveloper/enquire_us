<footer>
  	<div class="footer-top">
    	<div class="container">
        	<div class="row">
            	<div class="col-sm-12 subscribe">
                	<h2>Subscribe to SaveTk.com</h2>
                    <p><span style="color:#DE4B39">Be the first save!</span> Subscribe to get the best deals & offers in your email.</p>
                    <p id="error"></p>
                </div>
                <div class="col-lg-9 col-sm-offset-3">
						
                       <form action="http://savetk.com/subscribe" method="post" accept-charset="utf-8" id="subscribe">                        
                       	<div class="form-group col-sm-7">
                          <input type="email" id="sub_email" name="email" class="form-control form-cus"  placeholder="Email address" required>
                        </div>
                       <!-- <div class="form-group col-sm-3 col-xcus-3">
                          <select onChange="getCitiesfooter(this.value);" class='form-control selectWidth form-cus' name='state_id' id="footer_state_id">
                          
                          <option value="*">Region</option><option value="320">Barisal</option><option value="321">Chittagong</option><option value="322">Dhaka</option><option value="323">Khulna</option><option value="324">Rajshahi</option><option value="325">Sylhet</option>                         </select>
                        </div>
                        <div class="form-group col-sm-3 col-xcus-3">
                          <select  class='form-control form-control selectWidth form-cus' name='city_id' id="footer_city_id">
                    		<option value="all">City</option>
                        </select>
                        </div>-->
                        <div class="form-group  col-sm-1 col-cus-1">
                          <input name="submit" type="button" id="sub_submit" onClick="subscribe_validation()" class="btn btn-black"  value="Subscribe"/>
                          
                        </div>
                    
                      </form>
        		</div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
    	<div class="container">
        	<div class="row">
            	<div class="col-sm-4">
                  	<div class="footer-logo">
                    	<img alt="Footer-logo" src="resources/frontend_assets/uploads/f9ed641f9a48428ecb6f3b48513b4170.png" />
                    </div>
                	<div class="footer-desc">
                       <p>SaveTk&nbsp;is Bangladeshis first local services marketing platform, helps you save money through its comprehensive listing of vouchers, offers, deals &amp; discounts. We grab the hottest deals in town and make them better by helping you search and find the right things at the right price at the right time. Everything you can get in here what you want!!!</p>                    </div>
                   <div class="social-media">
                        <a target="_blank" rel="nofollow" href="https://www.facebook.com/" class="icon-link  facebook fill"><i class="fa fa-facebook"></i></a>
                        <a target="_blank" rel="nofollow" href="https://www.linkedin.com/" class="icon-link linkedin fill"><i class="fa fa-linkedin"></i></a>
                        <a href="https://twitter.com/" target="_blank"  class="icon-link  twitter fill"><i class="fa fa-twitter"></i></a>
                        <a target="_blank" rel="nofollow" href="https://plus.google.com/" class="icon-link google-plus fill"><i class="fa fa-google-plus"></i></a>
                       
                       <a target="_blank" rel="nofollow" href="https://www.instagram.com/" class="icon-link instagram fill"><i class="fa fa-instagram"></i></a>
                       
                       <a target="_blank" rel="nofollow" href="http://www.pinterest.com/" class="icon-link pinterest fill"><i class="fa fa-pinterest-p"></i></a> 
                        
                        
                        
                    </div>
                    <!--<div class="privacy">
                    	<a href="#">Terms and Conditions</a>|
                        <a href="#">Privacy Policy</a>
                    </div>-->
                </div>
                <div class="col-sm-2">
                	<div class="footer-menu">
                    <h3>SaveTk.com</h3>
                    	<ul>
                        	<li><a href="about-us.html">About SaveTk</a></li>
                            <li><a href="careers.html">Careers</a></li>
                            <li><a href="press.html">Press</a></li>
                            <li><a href="faq.html">Faqs</a></li>
							<li><a href="blog/index.html">Blog</a></li>
                            <li><a href="how-it-works.html">How it works</a></li>
                            <li><a href="privacy-policay.html">Privacy Policy</a></li>
                            <li><a href="terms-condition.html">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                	<div class="footer-menu">
                    <h3>Merchants</h3>
                    	<ul>
                                                        <li><a href="mlogin.html">Merchant Signin</a></li>
                            <li><a href="mregister.html">Merchant Signup</a></li>
                                                        <li><a href="join_us.html">Join Us</a></li>
                            <li><a href="benefits.html">Benefits</a></li>
                        </ul>
                    </div>
                    <div class="footer-menu">
                    <h3>Customers</h3>
                    	<ul>
                                                  	<li><a href="loginb13b.html?type=customer">Customer Signin</a></li>
                            <li><a href="cregister.html">Customer Signup</a></li>
                                                    </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                	<div class="apps">
                    	<a href="#"><img class="img-responsive"  alt="google play store" src="resources/frontend_assets/images/play-store.png" /></a>
                    </div>
                	<div class="copyright">
                    	<p>&copy;&nbsp; 2018 &nbsp;<a href="http://2rsolution.com/" rel="nofollow" target="_blank">2R Solution Ltd.</a> All Rights Reserved.</p>
                    </div>
                    <div class="payment_method">
                      <span>Secure Payment by</span>
                      <img class="img-responsive" alt="Payment Method" src="resources/frontend_assets/images/payment-gateway.png"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </footer>
  
</div>

    <!-- Scripts -->
     @include('includes.public_scripts')
     @include('includes.public_custom_scripts')

</body>
</html>
