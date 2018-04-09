@extends('layouts.public_app')
@section('content')
<!-- #header -->
<script type="text/javascript">
    $('.about-catagories ul li a').each(function(){
        if($($(this))[0].href==String(window.location))
            $(this).addClass('active');
    });
    $(document).ready(function(){
        $("#{{$webpages->id}}").addClass('active');
    });
</script>
<div id="main" class="site-main">
    <div class="container">
        <div class="row top15 bottom40">
            <div class="col-md-3">
                <div class="about-catagories">
                    <ul>
                        @foreach($website_pages as $pages)
                        <?php
                            $page_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $pages->page_title);
                        ?>
                            <li><a href="{{ URL::to('webpage',array('webpage'=>$page_name)) }}" id="{{$pages->id}}">{{$pages->page_title}}</a></li>
                        
                        @endforeach
                    </ul>
                </div>
            </div>

    
            <div class="col-md-9">
                <div class="about-head">
                    <h2 class="cat-title">{{ $webpages->page_title }}</h2>
                    <p>{{ $webpages->page_description }}</p>      
                </div>
            </div>          
        </div>          
    </div>
</div>
@endsection



