@extends('layouts.public_app')

@section('content')
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
    { padding: 3px; border-top: none; padding-left: 0; padding-right: 15px; }
    #map { height: 400px; width: 100%; }
    #lightSlider { list-style: none outside none; padding-left: 0; margin-bottom:0; }
    #lightSlider li { display: block; float: left; margin-right: 6px; cursor:pointer; }
    #lightSlider li img { display: block; height: auto; max-width: 100%; }
    .lSSlideOuter li{ padding:3px; border:#ccc solid 1px; }
    .nav-tabs > li { float: left; }
    .lSSlideOuter .lSPager.lSGallery img{height:50px;}
    .list-group-item {
        position: relative; display: block; padding: 10px 15px; margin-bottom: -1px; background-color: #fff; border: 1px solid #ddd;
    }
    .checked{color: orange;}
</style>
<div class="container">
    @if(!empty($client))

        <script>
            $(document).ready(function() {
                $('#lightSlider').lightSlider({
                    gallery: true, item: 1, loop: true, slideMargin: 0, thumbItem: 5
                });
                $("#slide_1").addClass('active');
            });
        </script>

        <div class="row">

            @if($errors->any())
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{$errors->first()}}
                </div>
            </div>
            @endif

            <div class="col-lg-12  col-xs-12">
                <div class="detail-box">

                    <!-- User enquiry button -->
                    <div class="wishlist-corner">
                        <a class="btn userEnquiryClick p0" id="userEnquiryClick_<?= encrypt($client->user_id); ?>">
                            <i class="fa fa-envelope" title="send enquiry"></i>
                        </a>
                    </div>

                    <div class="col-md-6">

                        <div class="lSSlideOuter ">
                            <div class="lSSlideWrapper usingCss">
                                @if(!empty($images[0]))

                                    <ul id="lightSlider" class="lightSlider lsGrab lSSlide">
                                        @foreach($images as $key => $image)
                                            <li data-thumb="{{url('/')}}/storage/app/uploads/{{ $image->image}}" class="lslide" id="slide_<?= $key+1;?>">
                                                <img alt="{{ $client->business_name }}" src="{{url('/')}}/storage/app/uploads/{{ $image->image}}">
                                            </li>
                                        @endforeach
                                    </ul>

                                @elseif(!empty($client->logo))
                                    <ul id="lightSlider" class="lightSlider lsGrab lSSlide">
                                        <li data-thumb="{{url('/')}}/storage/app/uploads/{{ $client->logo}}" class="lslide active">
                                            <img alt="{{ $client->business_name }}" src="{{url('/')}}/storage/app/uploads/{{ $client->logo}}">
                                        </li>
                                    </ul>
                                @else
                                    <ul id="lightSlider" class="lightSlider lsGrab lSSlide">

                                        <li data-thumb="{{url('/')}}/resources/frontend_assets/images/logo.png" class="lslide active">
                                            <img alt="{{ $client->business_name }}" src="{{url('/')}}/resources/frontend_assets/images/logo.png">
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="col-sm-12 shop-title">
                                    <h3><a class="grn" href="javascript:;">{{ $client->business_name }}</a></h3>
                                </div>

                                <!-- <div class="buy-button-section top15">
                                    <button type="button" class="btn btn-cd btn-sms" data-toggle="modal" title="">GET SMS</button>
                                </div> -->

                                <div class="offer-bought">
                                    <div class="col-sm-4 unlimited-offer">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <span class="buy-counter">Mr. {{ $client->name }}</span>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <span><i class="fa fa-phone"></i></span>
                                        <span class="time-counter"> 
                                            <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a>
                                        </span>
                                    </div>                                  
                                </div>

                                @if(!empty($client->landline))
                                <div class="address-phn">
                                    <ul>
                                        <li> <i class="fa fa-mobile"></i>
                                            <a href="tel:{{ $client->landline }}">{{ $client->landline }}</a>
                                        </li>                                        
                                    </ul>
                                </div>
                                @endif
                                @if(!empty($client->toll_free1))
                                <div class="address-phn">
                                    <ul>
                                        <li> 
                                            <i class="fa fa-mobile"></i>
                                            <a href="tel:{{ $client->toll_free1 }}">
                                                {{ $client->toll_free1 }}
                                            </a>
                                        </li>                                        
                                        @if(!empty($client->toll_free2))
                                            <li>
                                                <i class="fa fa-mobile"></i>
                                                <a href="tel:{{ $client->toll_free2 }}">
                                                    {{ $client->toll_free2 }}
                                                </a>
                                            </li>                                        
                                        @endif                                                                         
                                    </ul>
                                </div>
                                @endif                                 

                                <div class="time-share">
                                    <div class="share-box">
                                        <ul class="addthis_default_style">
                                            <li> <span><i class="fa fa-map-marker"></i></span> </li>                                            
                                            <li> {{ $client->building }}, </li>
                                            <li> {{ $client->street }}, </li>
                                            <li> {{ $client->landmark }}, </li>                                            
                                            <li> {{ $client->area_name }}, </li>                                            
                                            <li> {{ $client->city_name }}, </li>                                           
                                            <li> {{ $client->state }}, </li>                                            
                                            <li> {{ $client->country }}, </li>                                            
                                            <li> {{ $client->pincode }} </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="time-share">
                                    <div class="limited-time">
                                        <i class="fa fa-globe"></i>
                                        <span class="time-counter">
                                            <?php 
                                                $URL = $client->website;
                                                $weblink =   $URL; 
                                                if(strpos($weblink, "http://") !== false || strpos($weblink, "https://") !== false)
                                                { 

                                                }
                                                else { 
                                                    $weblink = "http://".$weblink; 
                                                }
                                            ?>
                                            <a class="weblink" <?php if($weblink != 'http://' || $weblink != 'https://'){ ?> href="<?php echo $weblink; ?>"<?php } ?> target="_blank">{{ $weblink }}</a>

                                        </span>
                                    </div>
                                    <div class="share-box mr30">
                                        <span>Share</span>
                                        <ul class="addthis_default_style">
                                            <li>
                                                <a class="addthis_button_email at300b" target="_blank" href="https://www.facebook.com/">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="addthis_button_facebook at300b" target="_blank" href="https://www.twitter.com/">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="addthis_button_twitter at300b" target="_blank" href="https://www.instagram.com/">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- <div class="time-share">
                                    <div class="limited-time  review_tab_link">
                                         <i class="fa fa-wechat" style="font-size:16px; color:#A5A5A5;"></i> <a href="#review_tab">0 reviews</a> /
                                         <a href="#review_tab">Write a review</a><p></p>
                                    </div>
                                    <div class="share-box mr30">
                                        <div class="rating_star"><span style="width:0%;"></span></div>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="col-lg-12  col-xs-12">
                    <div class="description">
                        <!--<h2 class="page-title">Description</h2>-->
                        <div class="page-para">
                            <h3>About {{ $client->business_name }}</h3>
                            <?= $client->about_company;?>
                        </div>
                        <div class="page-para"> </div>
                    </div>
                </div>

                <div class="col-lg-12  col-xs-12">

                    <ul class="nav nav-tabs" id="review_tab">
                        <li class="active">
                            <a class="text-trans" data-toggle="tab" href="#tab-review-list">Reviews ( {{ count($reviews) }} )</a>
                        </li>
                        <li class="">
                            <a class="text-trans" data-toggle="tab" href="#tab-review">Write a Review</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- This is reviews tab -->
                        <div id="tab-review-list" class="tab-pane active">
                            <!-- Show all reviews here -->
                            @if(!empty($reviews))
                                <ul class="list-group">
                                @foreach($reviews as $key => $review)
                                    <li class="list-group-item">
                                        <p>
                                            <div class="col-md-8 p0">
                                                <i> {{ $review->review }} </i>
                                            </div>
                                            <div class="col-md-4 text-right p0">
                                                @if($review->rating == 1 || (float)$review->rating == 4.1 || (float)$review->rating == 4.2)
                                                    <span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                @endif
                                                @if($review->rating == 2 || (float)$review->rating == 4.3 || (float)$review->rating == 4.4)
                                                    <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                @endif
                                                @if($review->rating == 3 || (float)$review->rating == 4.5 || (float)$review->rating == 4.6)
                                                    <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                @endif
                                                @if((float)$review->rating == 4.7 || (float)$review->rating == 4.8 || $review->rating == 4)
                                                    <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span>
                                                @endif
                                                @if($review->rating == 5 || (float)$review->rating == 4.9)
                                                    <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
                                                @endif
                                                
                                            </div>
                                        </p>
                                        <p class="text-right"> <strong> -- {{ $review->name }} </strong></p>                                        
                                    </li>
                                @endforeach
                                </ul>
                            @else
                                <p>There are no reviews found.</p>
                            @endif
                        </div>
                        <!-- Review form section -->
                        <div id="tab-review" class="tab-pane">
                            
                            <form class="form-horizontal" method="post" action="{{ route('review') }}">

                                {{ csrf_field() }}

                                <input type="hidden" name="rev_client" id="rev_client" value="{{ $client->user_id }}">

                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="rev_name" class="control-label">Your Name</label>
                                        <input name="rev_name" id="rev_name" class="form-control" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="rev_email" class="control-label">Your Email</label>
                                        <input name="rev_email" id="rev_email" class="form-control" type="email" required="" placeholder="example@gmail.com">
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="rev_phone" class="control-label">Your Phone</label>
                                        <input name="rev_phone" id="rev_phone" class="form-control" type="tel" required="" pattern="[789][0-9]{9}" placeholder="9876543210">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="rev_review" class="control-label">Your Review</label>
                                        <textarea class="form-control" id="rev_review" rows="5" name="rev_review" required="" placeholder="Type your review here..."></textarea>
                                        <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label">Rating</label> &nbsp;&nbsp;

                                        <input id="r_1" title="Ordinary" value="1" name="rev_rating" type="radio">
                                        <label for="r_1" title="Ordinary">1</label> &nbsp;&nbsp;

                                        <input id="r_2" title="Average" value="2" name="rev_rating" type="radio">
                                        <label for="r_2" title="Average">2</label> &nbsp;&nbsp;

                                        <input id="r_3" title="Good" value="3" name="rev_rating" type="radio">
                                        <label for="r_3" title="Good">3</label> &nbsp;&nbsp;

                                        <input id="r_4" title="Very Good" value="4" name="rev_rating" type="radio">
                                        <label for="r_4" title="Very Good">4</label> &nbsp;&nbsp;

                                        <input id="r_5" title="Excellent" value="5" name="rev_rating" type="radio">
                                        <label for="r_5" title="Excellent">5</label>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <div class="text-right">
                                        <button class="btn btn-primary" id="button-review" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="similar_coupons col-md-4">

                <h4><strong>Hours of Operation</strong></h4>

                <div class="offer-small offer">
                    <table class="table">
                        <tbody>
                            @foreach($other_info as $other)
                                @if($other->operation_timing=='1')
                                    <tr>
                                        <td class="text-trans-cap">{{ $other->day }}</td>
                                        <td>{{ $other->from_time }}</td>
                                        <td>-</td>
                                        <td>{{ $other->to_time }}</td>
                                        @if($other->working_status==1)
                                            <td class="green">Open</td>
                                        @else
                                            <td class="red">Close</td>
                                        @endif
                                    </tr> 
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h4><strong>Also Listed in</strong></h4>

                <div class="offer-small offer">
                    <ul class="ab_enquire">

                        @foreach($client_keywords as $client_keyword)
                            @if(!is_null($client_keyword->category))
                                <li>
                                    <i class="fa fa-check"></i> 
                                    <a href="javascript:;" class="cat_ies" id="cate_<?= $client_keyword->keyword_id; ?>">{{$client_keyword->category}}</a>
                                </li>
                            @else
                                <li>
                                    <i class="fa fa-check"></i> 
                                    <a href="javascript:;" class="sub_cat_ies" id="sub_cate_<?= $client_keyword->keyword_id; ?>">{{$client_keyword->subcategory}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <h4><strong>Modes of Payment</strong></h4>

                <div class="offer-small offer">
                    <ul class="ab_enquire"> 
                    <?php
                        $payment_mode = $client->payment_mode;
                        $payment_mode = explode("|", $payment_mode);

                        for($i=0; $i<count($payment_mode); $i++)
                        {
                            if(isset($payment_mode[0])){
                                $payment_mode[0] = "Cash";   
                            }                            
                            
                            if(isset($payment_mode[1])){
                                $payment_mode[1] = "Master";   
                            }                            

                            if(isset($payment_mode[2])){
                                $payment_mode[2] = "Visa";   
                            }   
                                                     
                            if(isset($payment_mode[3])){
                                $payment_mode[3] = "Debit";   
                            }                            

                            if(isset($payment_mode[4])){
                                $payment_mode[4] = "Money";   
                            }  

                            if(isset($payment_mode[5])){
                                $payment_mode[5] = "Cheques";   
                            }                            

                            if(isset($payment_mode[6])){
                                $payment_mode[6] = "Credit Card";   
                            } 
                                                                                
                            if(isset($payment_mode[7])){
                                $payment_mode[7] = "Travelers Cheque";   
                            }                            

                            if(isset($payment_mode[8])){
                                $payment_mode[8] = "Financing Available";   
                            }  

                            if(isset($payment_mode[9])){
                                $payment_mode[9] = "American Express Card";   
                            }                            

                            if(isset($payment_mode[10])){
                                $payment_mode[10] = "Diners Club Card";   
                            }
                    ?>
                        <li><i class="fa fa-check-square"></i> <?= $payment_mode[$i];?></li>
                    <?php
                    //break;
                        }

                    ?>
                    </ul>
                </div>

                <h4><strong>Year Established</strong></h4>

                <div class="offer-small offer">
                    <p>{{ $client->year_establishment }}</p>
                </div>
            </div>
        </div>

    @else
        <div class="col-md-12 alert alert-info">Result not found!</div>
    @endif

</div>

@endsection



