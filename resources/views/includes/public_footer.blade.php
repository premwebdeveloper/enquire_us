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

  <!-- Scripts -->
  @include('includes.public_scripts')
  @include('includes.public_custom_scripts')

</body>
</html>
