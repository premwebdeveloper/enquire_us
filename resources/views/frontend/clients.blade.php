@extends('layouts.public_app')

@section('content')

<!-- #header -->
<div id="main" class="site-main">
    <div class="shop-banner"> 
        <img style="width:100%;" alt="Best Dhaka Restaurants Discount, Deals, Vouchers, Coupons, Offers, SMS in Bangladesh | savetk.com" src="http://savetk.com/assets/uploads/cache/bb1688447f5584f6274c712dd9651a0a-1366x250.jpg"> 
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
                                <h3>
                                    @if(isset($title_info->category))
                                        {{ $title_info->category }}
                                    @else
                                        {{ $title_info->subcategory }}
                                    @endif
                                </h3>
                            </div>
                            <div class="filter top30 cata-dis-none">
                                <h1 class="brand-header">SubCategories </h1>
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
                            <div class="filter top30 cata-dis-none">
                                <h1 class="brand-header"> Related Links </h1>
                                <div class="list-group category_list">
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
                            </div>
                        </div>
                    </div>

                    <!-- Middle main content bar -->
					<div class="col-sm-6" style="margin-top: 35px;">

                        <div class="col-sm-12 top40 p0">
                            <h1 class="brand-header">Latest offers </h1>
                        </div>

						<div class="row">
                            
                            @if(!empty($clients[0]))
                                @foreach($clients as $client)

    							<div class="col-lg-12 col-sm-12 col-xs-12 res-cop-box">
    								<div class="offer-small offer">

                                        <?php
                                            $business_name = $client->business_name;
                                        ?>

    									<div class="col-lg-6 col-sm-6 col-xs-12 vendor-image">
                                            <a href="javascript:;" class="client_view_details" id="client-view_{{ $client->user_id }}">
                                                <?php
                                                    if(!empty($client->logo))
                                                    {
                                                        ?>
                                                        <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $client->logo}}" class="img-responsive" style="height: 125px;">
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
            											<img alt="" src="{{url('/')}}/resources/frontend_assets/images/logo.png" class="img-responsive" style="height: 125px;">
                                                        <?php
                                                    }
                                                ?>
    										</a>
    									</div>

    									<div class="offer-title col-lg-6 col-sm-6 col-xs-12 ">
                                            <h3 class="margin0">
                                                <a href="javascript:;" class="client_view_details" id="client-view_{{ $client->user_id }}">
                                                    {{ $client->business_name }} 
                                                </a>
                                            </h3>
                                            <div class="offer-ends trim-content">
                                                <p class="margin0">
                                                    <i class="fa fa-phone" aria-hidden="true"></i> 
                                                    <span>{{ $client->phone }}</span>
                                                </p>
                                                @if(!empty($client->area))
                                                <p>
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>
                                                        {{ $client->building }}, {{ $client->street }}, {{ $client->landmark }}...
                                                    </span>
                                                </p>
                                                @endif
                                            </div>
    									
                                            <div class="offer-getcode">
                                                <a href="javascript:;" class="client_view_details btn btn-cd btn-coupon" id="client-view_{{ $client->user_id }}">
        										    View Details
                                                </a>   
        									</div>
                                        </div>

    								</div>
    							</div>

                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="col-md-12 alert alert-info">
                                        Result not found!
                                    </div>
                                </div>
                            @endif
						</div>

					</div>

                    <!-- Right sidebar -->
                    <div class="col-sm-3" style="margin-top: 35px;">
                        <div class="col-sm-12 top40 p0">
                            <h1 class="brand-header"> Enquiry </h1>
                        </div>

                        <div class="col-sm-12 p0">

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

                                Click <a href="javascript:;" id="enquiry-for_<?= encrypt($title_info->id); ?>_<?= $identity; ?>" class="btn btn-info btn-xs multiple_enquiries"> Here </a> to enquiry this keyword
                        </div>

                    </div>

                    <!-- Category description -->
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="col-sm-12">
                            <div class="filter top30 cata-dis-none">
                                @if(!empty($title_info->description))
                                    <?= $title_info->description; ?>
                                @endif
                            </div>
                        </div>
                    </div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection



