<footer>
    <div class="footer-top">
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
    </div>

    <div class="footer-bottom">
      	<div class="container">
          	<div class="row">

            	<div class="col-sm-4">
              	<div class="footer-logo">
                	<img alt="Footer-logo" src="{{url('/')}}/resources/frontend_assets/images/logo.png" />
                </div>

                <div class="footer-desc">
                    <p>Enquire Us is India first local services marketing platform, helps you save money through.</p>
                </div>

                <div class="social-media">
                  <a target="_blank" rel="nofollow" href="https://www.facebook.com/" class="icon-link  facebook fill">
                    <i class="fa fa-facebook"></i>
                  </a>
                  <a target="_blank" rel="nofollow" href="https://www.linkedin.com/" class="icon-link linkedin fill">
                    <i class="fa fa-linkedin"></i>
                  </a>
                  <a href="https://twitter.com/" target="_blank"  class="icon-link  twitter fill">
                    <i class="fa fa-twitter"></i>
                  </a>
                  <a target="_blank" rel="nofollow" href="https://plus.google.com/" class="icon-link google-plus fill">
                    <i class="fa fa-google-plus"></i>
                  </a>
                  <a target="_blank" rel="nofollow" href="https://www.instagram.com/" class="icon-link instagram fill">
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
                        <?php $website_pages = DB::table('website_pages')->where('status', 1)->get(); ?>
                        @foreach($website_pages as $pages)
                            <?php
                                $page_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $pages->page_title);
                            ?>
                            <li><a href="{{ URL::to('webpage',array('webpage'=>$page_name)) }}">{{$pages->page_title}}</a></li>
                        @endforeach
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
                    Dexusmedia.com</a> All Rights Reserved.</p>
                </div>
            </div>
        </div>
        </div>
    </div>
    </footer>
</div>
  <!-- Modal -->
<div class="modal fade" id="myLogin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Send Enquiry</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
                <div class="form-group required">
                    <div class="col-sm-12">
                        <label for="input-name" class="control-label">Your Name</label>
                        <input name="name" value="" id="input-name" class="form-control" type="text" required="">
                        <input name="customer_id" value="" id="input-customer_id" type="hidden">
                        <input name="merchant_id" value="172" id="input-merchant-id" type="hidden">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="input-r_email" class="control-label">Your Email</label>
                        <input name="r_email" value="" id="input-email" class="form-control" type="text">
                    </div>
                </div>                                
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="input-r_email" class="control-label">Your Phone</label>
                        <input name="r_phone" value="" id="input-email" class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group required">
                    <div class="col-sm-12">
                        <label for="input-review" class="control-label">Your Review</label>
                        <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
                        <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                    </div>
                </div>

                <div class="buttons">
                    <div class="pull-right">
                        <button class="btn btn-primary" id="button-review" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
  <!-- Scripts -->
  @include('includes.public_scripts')
  @include('includes.public_custom_scripts')

</body>
</html>
