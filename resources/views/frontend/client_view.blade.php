@extends('layouts.public_app')

@section('content')

<div class="container">

    <link rel="stylesheet" href="http://savetk.com/assets/css/lightslider.css" type="text/css">
    <script type="text/javascript" src="http://savetk.com/assets/js/lightslider.js"></script>
    <script>
        $(document).ready(function() {
            $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 5
            });
        });
    </script>

    <style type="text/css">
        #lightSlider { list-style: none outside none; padding-left: 0; margin-bottom:0; }
        #lightSlider li { display: block; float: left; margin-right: 6px; cursor:pointer; }
        #lightSlider li img { display: block; height: auto; max-width: 100%; }
        .lSSlideOuter li{ padding:3px; border:#ccc solid 1px; }
        .nav-tabs > li { float: left; }
    </style>


    <div class="row">
        <div class="col-lg-12  col-xs-12">
            <div class="detail-box">

                <div class="wishlist-corner">
                    <a data-toggle="modal" data-target="#myLogin" data-original-title="Add to Wishlist" class="btn" style="padding:0;">
                        <i id="star-icon-261" class="fa fa-star "></i>
                    </a>
                </div>

                <div class="col-md-6">

                    <div class="lSSlideOuter ">
                        <div class="lSSlideWrapper usingCss" style="transition-duration: 400ms; transition-timing-function: ease;">
                            <ul id="lightSlider" class="lightSlider lsGrab lSSlide" style="width: 3234px; transform: translate3d(-539px, 0px, 0px); height: 298px; padding-bottom: 0%;">

                                <li data-thumb="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_4-105x57.png" class="clone left" style="width: 539px; margin-right: 0px;">
                                    <img src="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_4-550x300.png">
                                </li>

                                <li data-thumb="http://savetk.com/assets/uploads/cache/coupons/92f7a1f12c204fb1b03f0a11943c5d4a-105x57.png" class="lslide active" style="width: 539px; margin-right: 0px;">
                                    <img alt="THAI KITCHEN (1 offer) | Get 10% Discount on Any Food Bill." src="http://savetk.com/assets/uploads/cache/coupons/92f7a1f12c204fb1b03f0a11943c5d4a-550x300.png">
                                </li>

                                <li data-thumb="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_1-105x57.png" class="lslide" style="width: 539px; margin-right: 0px;">
                                    <img src="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_1-550x300.png">
                                </li>

                                <li data-thumb="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_2-105x57.png" class="lslide" style="width: 539px; margin-right: 0px;">
                                    <img src="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_2-550x300.png">
                                </li>

                                <li data-thumb="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_4-105x57.png" class="lslide" style="width: 539px; margin-right: 0px;">
                                    <img src="http://savetk.com/assets/uploads/cache/coupons/ykEHPtIEWE551084_4-550x300.png">
                                </li>

                                <li data-thumb="http://savetk.com/assets/uploads/cache/coupons/92f7a1f12c204fb1b03f0a11943c5d4a-105x57.png" class="clone right" style="width: 539px; margin-right: 0px;">
                                    <img alt="THAI KITCHEN (1 offer) | Get 10% Discount on Any Food Bill." src="http://savetk.com/assets/uploads/cache/coupons/92f7a1f12c204fb1b03f0a11943c5d4a-550x300.png">
                                </li>
                            </ul>

                            <div class="lSAction"><a class="lSPrev"></a><a class="lSNext"></a></div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="col-sm-12 shop-title">
                                <h3><a style="color:#006A4E;" href="javascript:;">THAI KITCHEN </a></h3>
                                <h4 style="margin-bottom:15px;">Get 10% Discount on Any Food Bill.</h4>
                            </div>

                            <div class="buy-button-section top15">
                                <button type="button" class="btn btn-cd btn-sms" data-toggle="modal" title="">GET SMS</button>
                            </div>

                            <div class="offer-bought" style="border-top:1px solid #d7d7d7; margin-top:10px;">
                                <div class="col-sm-6 unlimited-offer">
                                    <span><i class="fa fa-tag"></i></span>
                                    <span class="time-counter">Unlimited Offer</span>
                                </div>
                                <div class="col-sm-4 bought-section">
                                    <span class="glyphicon glyphicon-user"></span>
                                    <span class="buy-counter">8 Got This </span>
                                </div>
                            </div>

                            <div class="address-phn">
                                <ul>
                                    <li> <i class="fa fa-map-marker"></i>Bashundhara City</li>
                                    <li> <i class="fa fa-phone"></i>01768130391</li>
                                    <li><i class="fa fa-archive"></i><a style="text-decoration:underline;" href="http://savetk.com/thai-kitchen">View all deals of THAI KITCHEN</a></li>
                                </ul>
                            </div>

                            <div class="time-share">
                                <div class="limited-time">
                                    <span class="glyphicon glyphicon-time"></span>
                                    <span class="time-counter">Expires: 38 days, 1 hours, 29 mins..</span>
                                </div>
                                <div class="share-box">
                                    <span>Share</span>
                                    <ul class="addthis_default_style">
                                        <li>
                                            <a class="addthis_button_email at300b" target="_blank" href="#">F</a>
                                        </li>
                                        <li>
                                            <a class="addthis_button_facebook at300b" href="#">G</a>
                                        </li>
                                        <li>
                                            <a class="addthis_button_twitter at300b" href="#">T</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="time-share">
                                <div class="limited-time  review_tab_link">
                                     <i class="fa fa-wechat" style="font-size:16px; color:#A5A5A5;"></i> <a href="#review_tab">0 reviews</a> /
                                     <a href="#review_tab">Write a review</a><p></p>
                                </div>
                                <div class="share-box">
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
        <div class="col-md-9">
            <div class="row">

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
                            <div class="col-sm-8"> &nbsp; map </div>
                            <div class="col-sm-4">
                                <div class="location">
                                    <div class="location-details clear">
                                        <h3>THAI KITCHEN</h3>
                                        <p>
                                            <span class="glyphicon glyphicon-road"></span>
                                            <span id="address">Level 8, Block C, Shop 4, Panthapath, Bashundharangladesh</span>
                                        </p>

                                        <p>
                                            <span class="glyphicon glyphicon-earphone"></span>
                                            <a href="tel:01768130391">01768130391</a>
                                        </p>

                                        <p>
                                            <span class="glyphicon glyphicon-envelope"></span>
                                            <a href="mailto:thaikitchencity@gmail.com">thaikitchencity@gmail.com</a>
                                        </p>

                                        <p>
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            <a target="_blank" href="javascript:;">Facebook</a>
                                        </p>
                                    </div>
                                </div>
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
                                        <input name="name" value="" id="input-name" class="form-control" type="text">
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
                                        <button class="btn btn-primary" data-loading-text="Loading..." id="button-review" type="button" data-original-title="" title="">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="similar_coupons col-md-3" style="float:left;">

            <h2 class="page-title" style="margin-bottom:20px;">Similar Offers</h2>
            <div style="width:100%;">
                <div class="offer-small offer">
                    <div class="vendor-image">
                        <a title="MetroSTAR" href="javascript:;">
                            <img alt="Grameenphone (22 offers) | Metro Kitchens - 12% off on all food (except drinks/water/tea) to GP STAR" src="http://savetk.com/assets/uploads/cache/coupons/b73d37dd5a34a49f253d4fb1ddff5e21-260x142.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="offer-title">
                        <a href="javascript:;">
                            Metro Kitchens - 12% off on all food (except drinks/water/tea) to GP STAR
                        </a>
                        <div class="offer-location trim-content"><i class="fa fa-tag"></i> Promotional deal</div>
                        <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 299 days, 21 hours, 29 mins.</div>
                    </div>

                    <div class="col-md-12" style="height: 15px;"></div>

                    <div class="offer-getcode">
                        <a href="javascript:;" class="btn btn-cd btn-coupon" data-original-title="" title="">View Details</a>
                    </div>

                    <div class="vendor-offer-count trim-content">
                        <a href="javascript:;">Grameenphone (22 offers)</a>
                    </div>
                </div>
            </div>

            <div style="width:100%;">
                <div class="offer-small offer">
                    <div class="vendor-image">
                        <a title="Flat" href="javascript:;">
                          <img alt="Bay" src="http://savetk.com/assets/uploads/cache/coupons/ad444982d291c272b2fa9e0ed7cd9427-260x142.png" class="img-responsive">
                         </a>
                    </div>
                    <div class="offer-title">
                        <a href="javascript:;">
                            Flat 10% discount on any food bill. (without party)
                        </a>
                        <div class="offer-location trim-content"><i class="fa fa-map-marker"></i> Mirpur</div>
                        <div class="offer-ends trim-content"><i class="fa fa-clock-o"></i> 36 days, 1 hours, 30 mins.</div>
                    </div>
                    <div class="col-md-12" style="height: 15px;"></div>
                    <div class="offer-getcode">
                        <button class="btn btn-cd btn-sms" data-toggle="modal" data-target="#myModal_1116" data-original-title="" title="">Get Sms</button>
                    </div>
                    <div class="vendor-offer-count trim-content">
                        <a href="javascript:;">Bay Leaf Restaurant (1 offer)</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection



