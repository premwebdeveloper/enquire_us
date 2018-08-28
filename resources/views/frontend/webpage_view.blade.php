@extends('layouts.public_app')
@section('content')

<!-- #header -->
<script type="text/javascript">
    $('.about-catagories ul li a').each(function(){
        if($($(this))[0].href==String(window.location))
            $(this).addClass('active');
    });
</script>

<div id="main" class="site-main">
    <div class="container">
        <div class="col-md-12">
            <div class="about-head">
                <h2 class="cat-title">{{ $webpages->page_title }}</h2>
                <p>{{ $webpages->page_description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection



