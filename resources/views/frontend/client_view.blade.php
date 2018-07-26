@extends('layouts.public_app')

@section('content')
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        padding: 3px;
        border-top: none;
        padding-left: 0;
        padding-right: 15px;
    }
</style>
<div class="container">
    @if(!empty($client))

        <script>
            $(document).ready(function() {
                $('#lightSlider').lightSlider({
                    gallery: true,
                    item: 1,
                    loop: true,
                    slideMargin: 0,
                    thumbItem: 5
                });
                $("#slide_1").addClass('active');
            });
        </script>

        <style type="text/css">
            #lightSlider { list-style: none outside none; padding-left: 0; margin-bottom:0; }
            #lightSlider li { display: block; float: left; margin-right: 6px; cursor:pointer; }
            #lightSlider li img { display: block; height: auto; max-width: 100%; }
            .lSSlideOuter li{ padding:3px; border:#ccc solid 1px; }
            .nav-tabs > li { float: left; }
            .lSSlideOuter .lSPager.lSGallery img{height:50px;}
        </style>

        <div class="row">
            <div class="col-lg-12  col-xs-12">
                <div class="detail-box">

                    <div class="wishlist-corner">
                        <a data-toggle="modal" data-target="#myLogin" data-original-title="Add to Wishlist" class="btn" style="padding:0;">
                            <i class="fa fa-envelope" title="send enquiry"></i>
                        </a>
                    </div>

                    <div class="col-md-6">

                        <div class="lSSlideOuter ">
                            <div class="lSSlideWrapper usingCss" style="transition-duration: 400ms; transition-timing-function: ease;">
                                @if(!empty($images[0]))

                                    <ul id="lightSlider" class="lightSlider lsGrab lSSlide" style="width: 3234px; transform: translate3d(-539px, 0px, 0px); height: 298px; padding-bottom: 0%;">
                                        @foreach($images as $key => $image)
                                            <li data-thumb="{{url('/')}}/storage/app/uploads/{{ $image->image}}" class="lslide" id="slide_<?= $key+1;?>" style="width: 539px; margin-right: 0px;">
                                                <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $image->image}}" style="width:100%;height: 270px;">
                                            </li>
                                        @endforeach
                                    </ul>

                                @elseif(!empty($client->logo))
                                    <ul id="lightSlider" class="lightSlider lsGrab lSSlide" style="width: 3234px; transform: translate3d(-539px, 0px, 0px); height: 298px; padding-bottom: 0%;">
                                        <li data-thumb="{{url('/')}}/storage/app/uploads/{{ $client->logo}}" class="lslide active" style="width: 539px; margin-right: 0px;">
                                            <img alt="" src="{{url('/')}}/storage/app/uploads/{{ $client->logo}}" style="width:100%;height: 270px;">
                                        </li>
                                    </ul>
                                @else
                                    <ul id="lightSlider" class="lightSlider lsGrab lSSlide" style="width: 3234px; transform: translate3d(-539px, 0px, 0px); height: 298px; padding-bottom: 0%;">

                                        <li data-thumb="{{url('/')}}/resources/frontend_assets/images/logo.png" class="lslide active" style="width: 539px; margin-right: 0px;">
                                            <img alt="" src="{{url('/')}}/resources/frontend_assets/images/logo.png" style="width:100%;height: 270px;">
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
                                    <h3><a style="color:#006A4E;" href="javascript:;">{{ $client->business_name }}</a></h3>
                                </div>

                                <!-- <div class="buy-button-section top15">
                                    <button type="button" class="btn btn-cd btn-sms" data-toggle="modal" title="">GET SMS</button>
                                </div> -->

                                <div class="offer-bought" style="border-top:1px solid #d7d7d7; margin-top:10px;">
                                    <div class="col-sm-4 unlimited-offer">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <span class="buy-counter">Mr. {{ $client->name }}</span>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <span><i class="fa fa-graduation-cap"></i></span>
                                        <span class="time-counter"> {{ $client->designation }}</span>
                                    </div>                                  
                                </div>

                                <div class="address-phn">
                                    <ul>
                                        <li> <i class="fa fa-envelope"></i>{{ $client->email }}</li>
                                        <li> <i class="fa fa-phone"></i>
                                            <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a>
                                        </li>
                                        <li> <i class="fa fa-mobile"></i>
                                            <a href="tel:{{ $client->landline }}">{{ $client->landline }}</a>
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="address-phn">
                                    <ul>                                        
                                        <li> <i class="fa fa-mobile"></i>
                                            <a href="tel:{{ $client->toll_free1 }}">{{ $client->toll_free1 }}</a>
                                        </li>                                        
                                        <li> <i class="fa fa-mobile"></i>
                                            <a href="tel:{{ $client->toll_free2 }}">{{ $client->toll_free2 }}</a>
                                        </li>                                        
                                        <li> <i class="fa fa-fax"></i>
                                            <a href="tel:{{ $client->fax1 }}">{{ $client->fax1 }}</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="time-share">
                                    <div class="share-box">
                                        <ul class="addthis_default_style">
                                            <li>
                                                <span><i class="fa fa-map-marker"></i></span> 
                                            </li>                                            
                                            <li>
                                                {{ $client->building }},
                                            </li>
                                            <li>
                                                {{ $client->street }},
                                            </li>
                                            <li>
                                                {{ $client->landmark }},
                                            </li>                                            
                                            <li>
                                                {{ $client->area_name }},
                                            </li>                                            
                                            <li>
                                                {{ $client->city_name }},
                                            </li>                                           
                                            <li>
                                                {{ $client->state }},
                                            </li>                                            
                                            <li>
                                                {{ $client->country }},
                                            </li>                                            
                                            <li>
                                                {{ $client->pincode }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="time-share">
                                    <div class="limited-time">
                                        <i class="fa fa-globe"></i>
                                        <span class="time-counter">
                                            <a href="{{ $client->website }}" target="_blank">{{ $client->website }}</a>
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

                                <div class="time-share">
                                    <div class="limited-time  review_tab_link">
                                         <i class="fa fa-wechat" style="font-size:16px; color:#A5A5A5;"></i> <a href="#review_tab">0 reviews</a> /
                                         <a href="#review_tab">Write a review</a><p></p>
                                    </div>
                                    <div class="share-box mr30">
                                        <div class="rating_star"><span style="width:0%;"></span></div>
                                    </div>
                                </div>

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
                        <div class="page-para" style="float:left; width:100%;">
                            <h4>Deal Highlights</h4>
                            <ul>
                                <li>Kindly show your SMS before availing the offer.</li>
                            </ul>
                            <h4>Deal Terms</h4>
                            <ul>
                                <li>1 SMS per Customer.</li>
                            </ul>
                            <h4>How to Use</h4>
                            <ul>
                                <li>1st click the "GET SMS" button.</li>
                            </ul>
                        </div>
                        <div class="page-para" style="float:left; width:100%;"> </div>
                    </div>

                    <div class="location-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3556.2231484551985!2d75.7762477150459!3d26.959831883107462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db3b47a84b429%3A0x92b38efd91251d5d!2sDexus+Media+Best+website+development+company!5e0!3m2!1sen!2sin!4v1530094876331" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12  col-xs-12">

                    <ul class="nav nav-tabs" id="review_tab">
                        <li class="active">
                            <a style="text-transform:inherit;" data-toggle="tab" href="#tab-review-list">Reviews (0)</a>
                        </li>
                        <li class="">
                            <a style="text-transform:inherit;" data-toggle="tab" href="#tab-review">Write a Review</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab-review-list" class="tab-pane active">
                            <p>There are no reviews for this offer.</p>
                        </div>
                        <div id="tab-review" class="tab-pane">
                            <div id="review_msg"></div>
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
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label">Rating</label>
                                        &nbsp;&nbsp;
                                        <input id="r_1" title="Ordinary" value="1" name="rating" type="radio">
                                        <label for="r_1" title="Ordinary">1</label>
                                        &nbsp;&nbsp;
                                        <input id="r_2" title="Average" value="2" name="rating" type="radio">
                                        <label for="r_2" title="Average">2</label>
                                        &nbsp;&nbsp;
                                        <input id="r_3" title="Good" value="3" name="rating" type="radio">
                                        <label for="r_3" title="Good">3</label>
                                        &nbsp;&nbsp;
                                        <input id="r_4" title="Very Good" value="4" name="rating" type="radio">
                                        <label for="r_4" title="Very Good">4</label>
                                        &nbsp;&nbsp;
                                        <input id="r_5" title="Excellent" value="5" name="rating" type="radio">
                                        <label for="r_5" title="Excellent">5</label>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <div class="pull-right">
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
                                        <td style="text-transform: capitalize;">{{ $other->day }}</td>
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



