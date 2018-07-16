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
                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/apple.png" alt="Apple Caterers" />
                                </a>                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/legal-dekho.png" alt="Legal Dekho" />
                                </a>                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/mt-sales.png" alt="MT Sales Corp" />
                                </a>
                                
                            </div>
                        </div>
                        <div class="slider-wrapper theme-default">
                            <div id="slider2" class="nivoSlider">
                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/saras-kripa.png" alt="Saras Kripa" />
                                </a>                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/system-indus.png" alt="System Indus" />
                                </a>
                                
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
            
            <!-- Show all super category -->
            <div class="col-sm-12 banner-slider">
                <div class="row">
                    @php $s = 6; $l = 11; @endphp
                    @for($i = 1; $i < count($super_catgory); $i++)
                                    
                        <div class="col-sm-2">
                            <div class="row">
                                <div class="col-lg-12 res-catagories text-center">
                                    <a href="{{ route('categories', ['super_cat_id' => $super_catgory[$i]->id]) }}" class="list-group-item super_caties">                                       
                                        <img src="storage/app/uploads/super_category/{{ $super_catgory[$i]->image }}" alt="{{ $super_catgory[$i]->name }}" width="150" />
                                        <br>
                                        {{ $super_catgory[$i]->name }}
                                    </a>                                    
                                </div>
                            </div>
                        </div>

                        @if($s == $i)
                            <div class="col-sm-1"> &nbsp; </div>
                            @php $s += 11; @endphp  
                        @endif

                        @if($l == $i)
                            <div class="col-sm-1"> &nbsp; </div>
                            @php $l += 11; @endphp
                        @endif

                    @endfor
                </div>
            </div>

			<!-- Our partners -->
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

                                            <a title="{{$home_page_client->business_name}}" href="javascript:;" class="client_view_details" id="client-view_{{ $home_page_client->user_id }}">
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
                                        
    								</div>
    							</div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>

			<!-- Lattest clients -->
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

                                        <a title="{{$latest_home_page_client->business_name}}" href="javascript:;" class="client_view_details" id="client-view_{{ $latest_home_page_client->user_id }}">
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