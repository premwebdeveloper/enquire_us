    <footer>
        <!-- <div class="footer-top">
            <div class="container">
        
              <div class="row">
                    <div class="col-sm-12 subscribe">
                        <h2>Subscribe to Enquire Us</h2>
                        <p>
                            <span style="color:#DE4B39">Subscribe to get the best deals & offers in your email.</span>
                        </p>
              
                        @if(session('subscribe'))
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('subscribe') }}
                                </div>
                            </div>
                        @endif
              
                    </div>
                    <div class="col-lg-9 col-sm-offset-3">
                        <form action="{{ route('subscribers') }}" method="post" id="subscribe">
              
                            {{ csrf_field() }}
              
                            <div class="form-group col-sm-7">
                                <input type="email" id="sub_email" name="sub_email" class="form-control form-cus"  placeholder="Email address" required>
                            </div>
              
                            <div class="form-group  col-sm-1 col-cus-1">
                                <input name="submit" type="submit" id="sub_submit" class="btn btn-black"  value="Subscribe"/>
                            </div>
              
                        </form>
                    </div>
                </div>
        
            </div>
        </div> -->

        <div class="footer-bottom">
          	<div class="container">

                <div class="row">
                    <div class="col-md-12">

                    <!-- Show all categories -->
                    @foreach($foot_categories as $key => $f_cate)
                        <a href="javascript:;" class="cat_ies" id="fcate_<?= $f_cate->id; ?>">
                            {{ ucfirst($f_cate->category) }} | 
                        </a>
                    @endforeach
                    </div>
                </div>

                <hr />

              	<div class="row">

                	<div class="col-sm-4">
                      	<div class="footer-logo">
                        	<img alt="Footer-logo" src="{{url('/')}}/resources/frontend_assets/images/logo.png" />
                        </div>

                        <div class="footer-desc">
                            <p>Enquire Us is India first local services marketing platform, helps you save money through.</p>
                        </div>

                        <div class="social-media">
                          <a target="_blank" rel="nofollow" href="https://www.facebook.com/enquireusindia/" class="icon-link  facebook fill">
                            <i class="fa fa-facebook"></i>
                          </a>
                          <a target="_blank" rel="nofollow" href="https://www.linkedin.com/company/enquireus/" class="icon-link linkedin fill">
                            <i class="fa fa-linkedin"></i>
                          </a>
                          <a href="https://twitter.com/enquire_us" target="_blank"  class="icon-link  twitter fill">
                            <i class="fa fa-twitter"></i>
                          </a>
                          <a target="_blank" rel="nofollow" href="https://plus.google.com/" class="icon-link google-plus fill">
                            <i class="fa fa-google-plus"></i>
                          </a>
                          <a target="_blank" rel="nofollow" href="https://www.instagram.com/enquire_us/" class="icon-link instagram fill">
                            <i class="fa fa-instagram"></i>
                          </a>
                          <a target="_blank" rel="nofollow" href="http://www.pinterest.com/" class="icon-link pinterest fill">
                            <i class="fa fa-pinterest-p"></i>
                          </a>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="footer-menu">
                            <h3>Quick Links</h3>
                            <ul>
                                <li><a href="{{ route('about-us') }}">About Us</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>                           
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="footer-menu">
                          <h3>Merchants</h3>
                            <ul>
                                <li><a href="{{route('login')}}">Merchant Signin</a></li>
                                <li><a href="{{route('register')}}">Merchant Signup</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="apps">
                          <a href="#">
                            <img class="img-responsive" alt="" src="{{url('/')}}/resources/frontend_assets/images/play-store.png" />
                          </a>
                        </div>
                        <div class="copyright">
                            <p>&copy;&nbsp; 2018 &nbsp;<a href="javascript:;" rel="nofollow" target="_blank">
                            </a> <a href="http://dexusmedia.com" target="_blank">Designed By Dexus Media.</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Modal -->
<div class="modal fade" id="userEnquiryModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Send Enquiry</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="{{ route('send_enquiry') }}">

                {{ csrf_field() }}

                <input type="hidden" name="enq_client" id="enq_client">

                <div class="form-group required">
                    <div class="col-sm-12">
                        <label for="enq_name" class="control-label">Your Name</label>
                        <input name="enq_name" id="enq_name" class="form-control" type="text" required="">
                    </div>
                </div>
                <div class="form-group required">
                    <div class="col-sm-12">
                        <label for="enq_email" class="control-label">Your Email</label>
                        <input name="enq_email" id="enq_email" class="form-control" type="email" required="" placeholder="example@gmail.com">
                    </div>
                </div>                                
                <div class="form-group required">
                    <div class="col-sm-12">
                        <label for="enq_phone" class="control-label">Your Phone</label>
                        <input name="enq_phone" id="enq_phone" class="form-control" type="tel" required="" pattern="[789][0-9]{9}" placeholder="9876543210">
                    </div>
                </div>
                <div class="form-group required">
                    <div class="col-sm-12">
                        <label for="enq_enquiry" class="control-label">Your Enquiry</label>
                        <textarea class="form-control" id="enq_enquiry" rows="5" name="enq_enquiry" required="" placeholder="Type your enquiry here..."></textarea>
                        <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                    </div>
                </div>

                <div class="buttons">
                    <div class="text-right">
                        <button class="btn btn-primary" id="button-enquiry" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      
    </div>
</div>


<!-- Category Suggestion Modal -->
<div id="categorySuggestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Suggestion for new category</h4>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('suggest_new_category') }}" method="POST">

                    {{ csrf_field() }}

                    <?php $route = Request::route()->getName(); ?>

                    <input type="hidden" name="redirect_route" value="{{ $route }}">
                    <input type="hidden" name="redirect_param" value="">

                    <div class="row">
                        <div class="col-md-10">
                            <label for="category">Category</label>
                            <input type="text" name="suggest_category" class="form-control" id="suggest_category" placeholder="Category" required="required">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="suggest" value="Suggest" class="btn btn-primary" id="suggestCategory" style="margin-top: 25px;">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
@include('includes.public_scripts')
@include('includes.public_custom_scripts')

</body>
</html>
