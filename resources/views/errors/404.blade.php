<style>
	body{
		margin:0px;
	}
</style>
    <!-- redirect url -->
    @if(Request::url() == 'https://www.enquireus.com/Jaipur')
        <script>window.location.href = "https://www.enquireus.com/";</script>
    @endif
<div id="main" class="site-main" style="background: url('http://localhost/enquire_us/trunk/storage/app/uploads/errors/bg.png');background-repeat: no-repeat;background-size: cover;height: 100%;">
    <div class="container">
        <div class="row top15 bottom40">
            <div class="col-md-12" style="text-align: center;">

				<h1 style="font-size: 3em;color: rgb(99, 44, 37);font-weight: bold;padding-top: 100px;">Enquire Us</h1>

            	<img src="{{ asset('http://localhost/enquire_us/trunk/storage/app/uploads/errors/banner.png') }}" alt="">

            	<h2 style="font-size: 3em;color: rgb(99, 44, 37);font-weight: bold;">Dude,,we can't find that page!</h2>

            	<p>Click <a href="{{  asset('/') }}">Here</a> to go to Enquire us</p>

            </div>
        </div>
    </div>
</div>