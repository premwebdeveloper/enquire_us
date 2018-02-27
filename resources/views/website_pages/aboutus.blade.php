@extends('layouts.public_app')
@section('content')
<div id="main" class="site-main">
    <div class="container">
        <div id="message"></div>
        <div class="row top15 bottom40">
            <div class="col-md-3">
                <div class="about-catagories">
                    <ul>
                        <li><a href="http://savetk.com/about-us">About us</a></li>
                        <li><a href="http://savetk.com/our-company">our company</a></li>
                        <li><a href="http://savetk.com/our-team">our team</a></li>
                        <li><a href="http://savetk.com/careers">careers</a></li>
                        <li><a href="http://savetk.com/press">Press</a></li>
                        <li><a href="http://savetk.com/faq" class="active">FAQ's</a></li>
                        <li><a href="http://savetk.com/how-it-works">How it works</a></li>
                        <li><a href="http://savetk.com/privacy-policay">Privacy Policy</a></li>
                        <li><a href="http://savetk.com/terms-condition">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                $('.about-catagories ul li a').each(function(){
                    if($($(this))[0].href==String(window.location))
                    //$(this).parent().addClass('active');
                    $(this).addClass('active');
                });
            </script>
    
    
<div class="col-md-9">
     
    <div class="about-head">
         <h2 class="cat-title">FAQ's</h2>
         <p>Welcome to savetk.com. If you are reading this, you are a new user at savetk.com and would like to know more about the site and how to find things around here!</p>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">GENERAL</a></h4>
</div>
<div id="collapseOne" class="panel-collapse collapse in">
<div class="panel-body">
<h4>1.What is savetk.com?</h4>
<p>Savetk is an interactive online marketing platform in Bangladesh, which connects merchants and consumers through channels on the web. Every 24 hours, Savetk broadcasts an electronic discount deal for a restaurant or store in your city, recommending and providing local service while also offering you a 5{bc801117a9eb3e9a755fc8b7ffbf76dd8ce7c6aac79d747131e160138ef41717} to 80{bc801117a9eb3e9a755fc8b7ffbf76dd8ce7c6aac79d747131e160138ef41717} discount if you purchase that service.</p>
</div>
<div class="panel-body">
<h4>2.What does Savetk do?</h4>
<p>We provide you with your city's hottest shopping deals, discounts and offers on restaurants, grocery items, entertainment, travel, body-art, spa’s and salons, gym and other categories. Get deals through the Internet, on your web or via new mobile app. whatever the platform, if there is a new deal, Savetk is the place to know.</p>
</div>
<div class="panel-body">
<h4>3.Do you sell product?</h4>
<p>No, savetk.com does not sell items. Savetk will have engaged betwwen Merchant and Customer</p>
</div>
<div class="panel-body">
<h4>4.Do I need a separate account to be a Merchant or a Customer?</h4>
<p>Yes. You need a separate account in order to be Merchants and Customers.</p>
<ul>
<li>Make sure that if you do not have a Savetk account, you can go to our [Sign-up page] and complete the registration process to become a member.</li>
<li>If you are having further difficulties, you can contact us via our [Contact Us] page for further inquiries.</li>
<li>Click on Sign-up page and choose your option for Merchant or Customer (User) account.</li>
<li>Make sure you have filled out all required field on the registration page. Once the registration form is filled and submitted, a confirmation email will be send to your email account. For Merchant, you have to wait for admin verification to activate the account.</li>
</ul>
</div>
<div class="panel-body">
<h4>5.How Do I Join Savetk?</h4>
<p>Join Savetk by signing up here or using social media login. You simply need an email address, which you will need to verify your account and enjoy a wide array of deals and discounts delivered to your e-mail address via our Newsletter.</p>
</div>
<div class="panel-body">
<h4>6.Will I receive confirmation of my registration?</h4>
<p>Yes. After you register online, you will receive an automated email confirming your sign up.</p>
</div>
<div class="panel-body">
<h4>7.Why Is Savetk So Popular?</h4>
<p>Savetk is very popular for two reasons: Firstly, its subscribers are modern consumers who like a good deal as well as to spend money wisely, especially when there is a discount or a perceived bargain. Savetk works because it provides affordable and good bargains for its dedicated consumers.</p>
<p>Secondly, Savetk can easily become viral and its daily discounts can spread quickly through email and word-of-mouth. Savetk subscribers can also forward the deal-of-the-day as recommendation links to their friend. Thus, motivating others to look at this unique website and scour its vast quantity of deals and bargains to scoop up for themselves.</p>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">ACCOUNT TROUBLESHOOTING</a></h4>
</div>
<div id="collapseTwo" class="panel-collapse collapse">
<div class="panel-body">
<h4>1.I forgot my password. Can I reset it?</h4>
<p>To retrieve your password, click [here] or go to our Login page and click on “Forgot Password?” You will be required to submit your email address. After doing so, you will receive an email and following the instructions in that e-mail, you will be able to reset your password.</p>
</div>
<div class="panel-body">
<h4>2.Can I cancel my subscription at any time?</h4>
<p>Yes, you can login to your account and cancel your account subscription at any time.</p>
</div>
<div class="panel-body">
<h4>3.Can I change my address?</h4>
<p>Yes. You can.</p>
<p>You need to login to Savetk account and click on “Edit Profile” then you can change as your address as you see fit. Finally click on “Save/Update” button. You have completed changing your address.</p>
<p>If you continue to experience problems, please send an email including your phone number to support@savetk.com. We will call you back as soon as possible and walk you through the registration process.</p>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">HOW IT WORKS</a></h4>
</div>
<div id="collapseThree" class="panel-collapse collapse">
<div class="panel-body">
<h4>1.There is the deal I like. What do I do?</h4>
<p>A great deal is like the cute girl in your class. It will not wait around forever. So enjoy your favorite deal before the offer ends and you will find a voucher/sms/code in your e-mail or your phone.</p>
</div>
<div class="panel-body">
<h4>2.What is a coupon deal?</h4>
<p>Every day we match hundreds of new coupons with sales and promotions to bring you the very best deals! Whether shopping online or in the stores, SaveTk is your best source for all kinds of deals. Let us help you by showing a better way to shop.</p>
</div>
<div class="panel-body">
<h4>3.How many types of deals SaveTk have?</h4>
<p>SaveTk offers five types of deals:</p>
<ul>
<li>Buy Voucher</li>
<li>Get Sms</li>
<li>Get Code</li>
<li>Activate deal</li>
<li>View Details(Promotion)</li>
</ul>
</div>
<div class="panel-body">
<h4>4.Do I need to register to buy the deal?</h4>
<p>Yes, you should register to “buy voucher” and pay through your SaveTk account or get SMS/Code as a guest. At SaveTk.com, the customer is king.</p>
<p>At SaveTk.com, the customer is king. You should register to buy voucher deals and pay through savtk.com account and other deals can get (SMS/Code/Activate deal/Promotion) as a guest customer.</p>
</div>
<div class="panel-body">
<h4>5.How do I use a “Buy Voucher” deal?</h4>
<p>Click on “Buy Voucher” button and the process will automatically take you to complete the payment process and after successful completion of said payment process, you will find a voucher in your e-mail inbox or your phone. Afterwards, you can enjoy your chosen deals in selected shops offering those deals according to deal terms and conditions.</p>
</div>
<div class="panel-body">
<h4>6.How do I use a “Get Sms” deal?</h4>
<p>Click on “Get Sms” and a Pop-up window will appear in front of you. You will have to enter your mobile number inside the box and afterwards, clicking on the “Send” button, will send the SMS in your phone. You can then show this SMS in the store which launched the offer and purchase your desired product.</p>
</div>
<div class="panel-body">
<h4>7.How do I use a “Get Code” &amp; ”Activate Deal”?</h4>
<p>Click on the “Get Code” button and a Pop-up window will appear with the code already there for you to copy. By clicking the “Copy” button, our server will automatically copy the code for you and open the merchant’s website in a separate tab from whom you want to purchase your product. During the completion of the checkout process, you will paste the code in their “Promotional Code” section and you will get your discount on the price of your chosen item.<br><br>Click on "Activate Deal" button and it will redirect you to merchant's website to enjoy discount at cart checkout process.&nbsp;</p>
</div>
<div class="panel-body">
<h4>8.How do I use a “View Details” deal?</h4>
<p>Simply “View Details” is a promotional advertising deal. It creates a huge opportunity to know about your areas big deals.</p>
<p>Click on the “View Details” button and it automatically open its details page with terms and conditions. Please have a read them carefully and choose your deals.</p>
</div>
<div class="panel-body">
<h4>9.Do I need to use the voucher deal the day I get it?</h4>
<p>You do not necessarily have to use your voucher the day you purchase them. However, be sure to use them before the deal expires. Do check the deal terms and expiry date carefully.</p>
</div>
<div class="panel-body">
<h4>10.Can I use the SMS with the voucher details?</h4>
<p>Definitely! Just show the SMS with voucher details to enjoy your deal. We suggest you read the terms of the deal bought by you.</p>
</div>
<div class="panel-body">
<h4>11.What if I wish to refund or exchange products or services bought from SaveTk?</h4>
<p>Refunds or exchanges will be available according to shop terms and condition only when there are reports found of faulty or damaged online products delivered to the customers. Inform us of the same by sending an e-mail to support@savetk.com within three (3) days of receiving the product(s).</p>
<p>Damaged goods must be returned in their original condition and packaging with intact product tags. Refund or replacement for goods/merchandise is subject to inspection by ‘SaveTk’ team. Damages due to negligent behavior and improper usage will not cover our refund and exchange policy.</p>
</div>
<div class="panel-body">
<h4>12.Can I change my mind after I have bought a deal?</h4>
<p>No. Cancellations affect the quality of future deals with the merchant(s). So please enable us to continue bringing you awesome deals by honoring your commitment to purchase.</p>
</div>
<div class="panel-body">
<h4>13.Are there any terms &amp; conditions for purchasing deals?</h4>
<p>Yes, you will find them under terms and conditions. Please have a read</p>
</div>
<div class="panel-body">
<h4>14.I deleted the e-mail with the voucher by mistake! :(</h4>
<p>You do not need to worry. It is just an e-mail. We will send you another e-mail. Mail us about the difficulty you are having or call our customer care. We are here to serve our valued customers, always.</p>
</div>
<div class="panel-body">
<h4>15.How can I get my business on Savetk?</h4>
<p>Welcome! You can contact us at merchatsupport@savetk.com</p>
<p>So what are you waiting for? A larger market share , a higher brand recall and repeat customer ,all are you waiting for you.</p>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">PAYMENTS</a></h4>
</div>
<div id="collapseFour" class="panel-collapse collapse">
<div class="panel-body">
<h4>1.What payment options do I have?</h4>
<p>MasterCard/Visa Credit cards, all debit cards, online banking, bKash, and cash on delivery and/or direct payment via your Mobile account on the WAP site. We have them all.</p>
</div>
<div class="panel-body">
<h4>2.Am I billed as soon as I buy anything on Savetk?</h4>
<p>Yes, you are charged as soon as you purchase a deal.</p>
</div>
<div class="panel-body">
<h4>3.Can I order by phone?</h4>
<p>Yes! Please call our customer care at +88-02-8991248.</p>
</div>
<div class="panel-body">
<h4>4.Is Savetk safe?</h4>
<p>VeriSign SSL transmits your credit card number directly to our secure payment gateways. At no time is your credit card information stored in our servers.</p>
</div>
<div class="panel-body">
<h4>5.Are there any excess VAT involved?</h4>
<p>Always check terms and conditions. Usually, most of our deals are inclusive of taxes.</p>
</div>
<div class="panel-body">
<h4>6.I purchased a deal. Can I cancel it before the deal expires?</h4>
<p>No. If you have already purchased a deal, it belongs to your name. If you do not want it, you can always donate your deal to a friend.</p>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">SUPPORT</a></h4>
</div>
<div id="collapseFive" class="panel-collapse collapse">
<div class="panel-body">
<h4>1.How do I contact the customer care team?</h4>
<p>Email us at support@savetk.com, chat with us or call us at 88-02-8991248 from Saturday to Friday, 9:00 AM to 8:00 PM.</p>
</div>
<div class="panel-body">
<h4>2.How to write in Bangla?</h4>
<p>Some of the method you can use, if having problem to type in Bangla.</p>
<ul>
<li>Download typing software, such as Avro Keyboard or Google Input Tools</li>
<li>Use an online keyboard, such as Google Transliteration, and then copy-paste the Bangla text over to savetk.com.</li>
<li>For some mobile phone users, it may be possible to use an online converter, such as Write Bangla, or to obtain a Bangla keyboard through a smartphone app.</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>      </div>
    </div>          
 </div>          
</div>
</div>

@endsection