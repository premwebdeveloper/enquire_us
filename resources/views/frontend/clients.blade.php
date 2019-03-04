@extends('layouts.public_app')

@section('content')

<!-- #header -->
<div id="main" class="site-main">
    <div class="shop-banner"> 
        <img style="width:100%;" alt="enquire us" src="{{ asset('resources/assets/images/banner.jpg') }}"> 
    </div>
	<div class="container">
		<div class="row">
			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">

                    <!-- Left sidebar -->
                    <div class="col-sm-3">
                        <div class="col-sm-12">
                            <div class="catagory-name">
                                <h1 class="text-center" style="font-size: 22px;color: #000;margin-top: 10px;">
                                    @if(isset($title_info->category))
                                        {{ $title_info->category }}
                                    @else
                                        {{ $title_info->subcategory }}
                                    @endif

                                    @if(isset($area_name))
                                       in {{ $area_name }}
                                    @endif
                                </h1>
                            </div>
                            @if(!empty($subcategories[0]))
                            <div class="filter top30 cata-dis-none hidden-xs">
                                <h2 class="brand-header">Related Services </h2>
                                <div class="list-group category_list">
                                    @foreach($subcategories as $subcat)
                                        <?php
                                            $cat_name = $subcat->subcategory;
                                            $cat_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $cat_name);
                                            $encrypted = Crypt::encrypt($subcat->id);
                                        ?>
                                        <a href="javascript:;" class="list-group-item sub_cat_ies" id="sub_cate_<?= $subcat->id; ?>">
                                            {{ $subcat->subcategory }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="filter top30 cata-dis-none hidden-xs">
                                <h1 class="brand-header"> Search by Area </h1>
                                <div class="list-group category_list hide_related_link">
                                    @foreach($pageUrls as $url)
                                        <!-- If sub category is searched then subcategory link appeat -->
                                        @if(!empty($url->subcategory))
                                            <a href="javascript:;" class="list-group-item related_links" alt="{{ $url->page_url }}" id="<?= $url->encoded_params; ?>">
                                        @else
                                            <!-- category link appear -->
                                            <a href="javascript:;" class="list-group-item related_links" alt="{{ $url->page_url }}" id="<?= $url->encoded_params; ?>">
                                        @endif                                        
                                            {{ ucfirst(str_replace("-"," ",$url->page_url)) }}
                                        </a>
                                    @endforeach
                                </div>
                                <a href="javascript:;" id="hide_related_link">View More</a>
                            </div>
                        </div>
                    </div>

                    <!-- Middle main content bar -->
					<div class="col-sm-9 mt100">
                        @if(!empty($clients[0]))
                            <?php 
                            $clients = json_decode(json_encode($clients), true);
                            shuffle($clients); 
                            ?>
                            @foreach($clients as $client)
                                <div class="display-salon hidden-xs">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3 hidden-xxs hidden-xs">
                                                    <?php
                                                        if(!empty($client['logo']))
                                                        {
                                                            ?>
                                                            <img alt="{{ $client['business_name'] }}" src="{{url('/')}}/storage/app/uploads/{{ $client['logo'] }}" class="img-responsive image-style">
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <img alt="" src="{{url('/')}}/resources/frontend_assets/images/logo.png" class="img-responsive image-style">
                                                            <?php
                                                        }
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center">
                                                            <a href="javascript:;" class="btn btn-green margin-top-10 btn-block client_view_details" id="client-view_{{ $client['user_id'] }}">
                                                                <span class="buy-offer">FULL DETAIL</span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-7 hidden-xxs hidden-xs">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h2 class="salon-heading">
                                                                <a href="javascript:;" class="btn-block client_view_details" id="client-view_{{ $client['user_id'] }}" title="{{ $client['business_name'] }}">{{ $client['business_name'] }}</a>
                                                            </h2>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 margin-top-5px">
                                                            <div class="row">

                                                                <div class="col-xs-12">
                                                                    <div class="rating-star full">
                                                                        <i class="fa fa-star fa-fw"></i>
                                                                    </div>
                                                                    <div class="rating-star full">
                                                                        <i class="fa fa-star fa-fw"></i>
                                                                    </div>
                                                                    <div class="rating-star full">
                                                                        <i class="fa fa-star fa-fw"></i>
                                                                    </div>
                                                                    <div class="rating-star full">
                                                                        <i class="fa fa-star fa-fw"></i>
                                                                    </div>
                                                                    <div class="rating-star half">
                                                                        <i class="fa fa-star-half-full fa-fw"></i>
                                                                    </div>
                                                                    <div class="rating-starcount">4.9 Ratings</div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="content-display">
                                                                <ul>
                                                                    <li> <span class="icon-holder icon-space">
                                                                        <i class="fa fa-map-marker fa-fw"></i></span>
                                                                        @if(!empty($client['area']))
                                                                        <span class="text-reset">{{ $client['street'] }}</span>
                                                                        @endif
                                                                    </li>
                                                                    <li> <span class="icon-holder icon-space ">
                                                                        <i class="fa fa-credit-card fa-fw"></i></span>
                                                                        <span class="text-reset">Cash/Credit/Debit Card</span>
                                                                    </li>
                                                                    <li> <span class="icon-holder icon-space">
                                                                        <i class="fa fa-phone fa-fw"></i></span>
                                                                        <span class="reset-span text-reset">
                                                                            <a href="javascript:;" class="client_view_details" id="client-view_{{ $client['user_id'] }}">View Phone</a>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-2 hidden-xxs hidden-xs">
                                                    <!-- Show enquiry success / error message -->
                                                    @if($errors->any())
                                                    <div class="col-md-12 p0">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            {{$errors->first()}}
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @php
                                                        if(isset($title_info->category)){
                                                            $identity = '1';
                                                        }else{
                                                            $identity = '2'; 
                                                        }
                                                    @endphp

                                                    <a href="javascript:;" id="enquiry-for_<?= encrypt($title_info->id); ?>_<?= $identity; ?>" class="btn btn-info btn-md multiple_enquiries margin-top-65px"> Enquire Now </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-lg-12 hidden-xs">
                            <div class="filter top30 cata-dis-none">
                                @if(!empty($title_info->description))
                                    <?= $title_info->description; ?>
                                @endif
                            </div>
                        </div>
    
                        <!-- FOR MOBILE SCREEN -->
                        <div class="row hidden-lg">
                            
                            @if(!empty($clients[0]))
                                <?php 
                                $clients = json_decode(json_encode($clients), true);
                                shuffle($clients); 
                                ?>
                                @foreach($clients as $client)

                                <div class="col-lg-12 col-sm-12 col-xs-12 res-cop-box">
                                    <div class="offer-small offer">

                                        <?php $business_name = $client['business_name']; ?>

                                        <div class="col-lg-6 col-sm-6 col-xs-3 vendor-image">
                                            <a href="javascript:;" class="client_view_details" id="client-view_{{ $client['user_id'] }}">
                                                <?php
                                                    if(!empty($client['logo']))
                                                    {
                                                        ?>
                                                        <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $client['logo']}}" class="img-responsive">
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

                                        <div class="offer-title col-lg-6 col-sm-6 col-xs-7">
                                            <h3 class="margin0">
                                                <a href="javascript:;" class="client_view_details" id="client-view_{{ $client['user_id'] }}" style="font-size: 13px;font-weight: bold;">
                                                    {{ $client['business_name'] }} 
                                                </a>
                                            </h3>
                                            <div class="rating-starcount">4.9</div>
                                            <div class="rating-star full">
                                                <i class="fa fa-star fa-fw"></i>
                                            </div>
                                            <div class="rating-star full">
                                                <i class="fa fa-star fa-fw"></i>
                                            </div>
                                            <div class="rating-star full">
                                                <i class="fa fa-star fa-fw"></i>
                                            </div>
                                            <div class="rating-star full">
                                                <i class="fa fa-star fa-fw"></i>
                                            </div>
                                            <div class="rating-star half">
                                                <i class="fa fa-star-half-full fa-fw"></i>
                                            </div>
                                            <div class="offer-ends trim-content">
                                                @if(!empty($client['area']))
                                                <p>
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>
                                                        {{ $client['building'] }}, {{ $client['street'] }}, {{ $client['landmark'] }}...
                                                    </span>
                                                </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="offer-title col-lg-6 col-sm-6 col-xs-2">        
                                            <p class="margin0">
                                                <a href="tel:{{ $client['phone'] }}" style="font-size: 26px;color: #e04b36;margin-bottom: 15px;margin-top: 10px;">
                                                    <i class="fa fa-phone" aria-hidden="true"></i> 
                                                </a>
                                                @if(!empty($client['whatsapp']))
                                                <a href="whatsapp://send?phone={{ $client->whatsapp }}&amp;text=Hello!" style="font-size: 26px;color: #17960d;">
                                                    <i class="fa fa-whatsapp" aria-hidden="true"></i> 
                                                </a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            <div class="col-xs-12">
                                <div class="filter top30 cata-dis-none">
                                    @if(!empty($title_info->description))
                                        <?= $title_info->description; ?>
                                    @endif
                                </div>
                            </div>
                        </div>
					</div>

                    <!-- Category description -->
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="filter top30 cata-dis-none breadCrumb">
                            <?= $list_seo_title;?>
                        </div>
                    </div>
                    <div class="col-xs-12 hidden-lg mt100 enquireus">
                        @if(!empty($subcategories[0]))
                            <h1 class="brand-header">Related Services </h1>
                            @foreach($subcategories as $subcat)
                                <?php
                                    $cat_name = $subcat->subcategory;
                                    $cat_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $cat_name);
                                    $encrypted = Crypt::encrypt($subcat->id);
                                ?>
                                <a href="javascript:;" class="list-group-item sub_cat_ies" id="sub_cate_<?= $subcat->id; ?>">
                                    {{ $subcat->subcategory }} |
                                </a>
                            @endforeach
                        @endif
                        <h1 class="brand-header mt100"> Search by Area </h1>
                        <div class="list-group category_list">
                            @foreach($pageUrls as $url)
                                <!-- If sub category is searched then subcategory link appeat -->
                                @if(!empty($url->subcategory))
                                    <a href="javascript:;" class="list-group-item related_links" alt="{{ $url->page_url }}" id="<?= $url->encoded_params; ?>">
                                @else
                                    <!-- category link appear -->
                                    <a href="javascript:;" class="list-group-item related_links" alt="{{ $url->page_url }}" id="<?= $url->encoded_params; ?>">
                                @endif                                        
                                    {{ ucfirst(str_replace("-"," ",$url->page_url)) }} |
                                </a>
                            @endforeach
                        </div>
                    </div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection



