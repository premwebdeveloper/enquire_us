<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php if(!empty($title)){ echo $title;} ?></title>
    <meta name="description" content="<?php if(!empty($meta_description)){ echo $meta_description; } ?>" />
    <meta name="keywords" content="<?php if(!empty($meta_keywords)){ echo $meta_keywords; } ?>" />    
    <meta name="google-site-verification" content="yPFGWADyKYZnyvD_W8DLJL9W-q7dD-AzPTE5ekLte7Y" />
    <meta name="Author" content=" enquireus.com " />
    <meta name="copyright" content="Copyright 2016, Enquire us" />
    <meta content="Global" name="Distribution">
    <meta name="googlebot" content=" index, follow " />
    <meta name="revisit-after" content="3 days" />  
    <meta name="distribution" content="global" />
    <meta name="Rating" content="General" />
    <meta name="Expires" content="never" />
    <meta name="robots" content="index,follow">
    <meta name="geo.region" content="IN-RJ">
    <meta name="twitter:site" content="@Enquire_us" />
    <meta name="twitter:title" content="<?php if(!empty($title)){ echo $title;} ?>" />
    <meta name="twitter:description" content="<?php if(!empty($meta_description)){ echo $meta_description; } ?>" />
    <meta name="twitter:image" content="<?php if(!empty($client->logo)){ ?> {{url('/')}}/storage/app/uploads/{{ $client->logo}} <?php } ?>" />
    <meta name="twitter:url" content="<?= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
    <meta property="og:url" content="<?= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="<?php if(!empty($title)){ echo $title;} ?>"/>
    <meta property="og:description" content="<?php if(!empty($meta_description)){ echo $meta_description; } ?>" />
    <meta property="og:image" content="<?php if(!empty($client->logo)){ ?> {{url('/')}}/storage/app/uploads/{{ $client->logo}} <?php } ?>">
    <meta property="og:image:width" content="630" />
    <meta property="og:image:height" content="473" />
    <meta property="og:image:secure_url" content="<?php if(!empty($client->logo)){ ?> {{url('/')}}/storage/app/uploads/{{ $client->logo}} <?php } ?>" />
    <meta property="og:site_name" content="Enquireus"/>
    <link rel="canonical" href="<?= $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132864399-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-132864399-1');
    </script>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Enquireus.com",
        "url": "https://www.enquireus.com"
    }
    </script>
    <script type="application/ld+json">
    {
        "@context":"http://schema.org",
        "@type":"Organization",
        "name":"enquireus.com",
        "url":"https://www.enquireus.com",
        "logo":"https://www.enquireus.com/resources/frontend_assets/images/logo.png",
        "sameAs":[
            "https://twitter.com/enquire_us",
            "https://www.facebook.com/enquireusindia/",
            "https://www.instagram.com/enquire_us/",
            "https://www.linkedin.com/company/enquireus/"]
    }
    </script>
    <!-- category company list meta content -->
    <script type="application/ld+json"><?php if(isset($category_company_list_meta_content)){ echo $category_company_list_meta_content;} ?></script>
    <!-- Company information in meta content -->
    <script type="application/ld+json"><?php if(isset($company_meta_content)){ echo $company_meta_content;} ?></script>
    <!-- Page url list items in meta contetn -->
    <script type="application/ld+json"><?php if(isset($list_item_meta_content)){ echo $list_item_meta_content;} ?></script>
    <script type="application/ld+json"><?php if(isset($all_companies_meta_data)){ echo $all_companies_meta_data;} ?></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{url('/')}}/resources/frontend_assets/images/favicon.png">
    <!-- Styles -->
    <link href="{{ asset('resources/frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/bootstrap-social.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/bootstrap-checkbox.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/custom_new.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/theme.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend_assets/js/nivo-slider/nivo-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/nivo-slider/themes/default/default.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend_assets/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('resources/frontend_assets/css/validationEngine.jquery.css') }}" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('resources/frontend_assets/js/bootstrap.min.js') }}"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){

            // Autocomplete on search category and firm name
            $("#filter_title").autocomplete({

                source: function( request, response ) {

                    // If request term limit is greater than 2 word
                    if(request.term.length < 3) return;

					$('#filter_title').removeAttr('alt');

                    $.ajax({
                        url: "{{ route('searchCategoriesAndCompanies') }}",
                        dataType: "json",
                        data: {
                            term : request.term,
                        },
                        success: function(data) {

                            if (data.category !== '' && data.category !== null)
                            {
                                var array = $.map(data, function (item) {
                                return {
                                        label: item.category,
                                        value: item.cat_id,
                                        data : item
                                    }
                                });
                                response(array)
                            }
                        }
                    });
                },
                select: function( event, ui ) {
                    $('#filter_title').val(ui.item.data.category);
                    var category = ui.item.data.category;
                    var cat_id = ui.item.data.cat_id;
                    var status = ui.item.data.status;
                    $('#filter_title').attr('alt', cat_id+'-'+status);

                    $('#search-filter').removeAttr('disabled', 'disabled');

                    return false;
                }
            });

            // Onclick search button
            $(document).on('click', '#search-filter', function(){

                var location = $('#location').val();                    // It has city id
				var loc_name = $('#location option[value="'+location+'"]').text();	// It has location name
                var sub_location = $('#sub_location').val();            // It has area id
                var sub_loc_name = $('#sub_location option[value="'+sub_location+'"]').text(); // It has area name
                var filter_title = $('#filter_title').val();            // It has keyword name
				var filter_title_alt = $('#filter_title').attr('alt');	// It has keyword id and identity

                var original_title = filter_title;

                // space reolace by dash
                loc_name = loc_name.replace(/\s+/g, '-');

                if(filter_title_alt == '' || filter_title_alt == 'undefined' || filter_title_alt == null)
                {
                    alert('Please select any category or company name from suggestions.');
                }
                else
                {
					// If keyword selected from suggestions then get page URL
                    $.ajax({
                        method : 'post',
                        url: "{{ route('getPageUrl') }}",
                        async : true,
                        data : {"_token": "{{ csrf_token() }}", 'filter_title_attr' : filter_title_alt, 'location' : location, 'sub_location' : sub_location},
                        success:function(response){

							//console.log(response);

							if(response == 0)
							{
								alert('Result not found!');
							}
							else
							{
                                var temp = response.split('||');

								// all is well
								// var encoded = makeid()+'-'+filter_title_alt+'-'+location+'-'+sub_location;
                                // encoded = encodeURIComponent(window.btoa(encoded));
                                // encode parameter
								var encoded = temp[1];
                                //console.log(encoded);

                                //window.location.href = "{{url('filter')}}"+"/"+loc_name+"/" +response+"/" +encoded;
								window.location.href = "{{ url('/') }}"+"/"+loc_name+"/" +temp[0]+"/" +encoded;
							}
                        },
                        error: function(data){
                            console.log(data);
                        },
                    });

                }
            });

            // Show all clients after click on category name
            $(document).on('click', '.cat_ies', function(){

                // get category id
                var id = $(this).attr('id');
                var temp = id.split('_');
                var cat_id = temp[1];

                // get location name and location id
                var location = $('#location').val();                                // This is location id
                var loc_name = $('#location option[value="'+location+'"]').text();  // It has location name
                loc_name = loc_name.replace(/\s+/g, '-');                           // space reolace by dash
             
                var cat_id_identity = cat_id+'-1';                                  // Category id with identity

                // Get page url of this category
                $.ajax({
                    method : 'post',
                    url: "{{ route('getPageUrl') }}",
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'filter_title_attr' : cat_id_identity, 'location' : location},
                    success:function(response){

                        console.log(response);

                        if(response == 0)
                        {
                            alert('Result not found!');
                        }
                        else
                        {
                            var temp = response.split('||');
                            // If all is well
                            // var encoded = makeid()+'-'+cat_id_identity+'-'+location;                 // Collect all parameters
                            // encoded = encodeURIComponent(window.btoa(encoded));                 // encode parameter

                            var encoded = temp[1];

                            //window.location.href = "{{url('filter')}}"+"/"+loc_name+"/" +response+"/" +encoded;
                            window.location.href = "{{ url('/') }}"+"/"+loc_name+"/" +temp[0]+"/" +encoded;
                        }
                    },
                    error: function(data){
                        console.log(data);
                    },
                });

            });

            // Category related clients
            $(document).on('click', '.related_links', function(){

                // get category id
                var encoded = $(this).attr('id');
                // page url
                var response = $(this).attr('alt');

                // get location name and location id
                var location = $('#location').val();                                        // This is location id
                var loc_name = $('#location option[value="'+location+'"]').text();          // It has location name
                loc_name = loc_name.replace(/\s+/g, '-');                                   // space reolace by dash
                
                // If all is well
                // var encoded = makeid()+'-'+related_id_identity+'-'+location+'-'+area;                // Collect all parameters
                // encoded = encodeURIComponent(window.btoa(encoded));                         // encode parameter

                window.location.href = "{{ url('/') }}"+"/"+loc_name+"/" +response+"/" +encoded;
            });


            // Show all clients after click on sub category name
            $(document).on('click', '.sub_cat_ies', function(){

                // get category id
                var id = $(this).attr('id');
                var temp = id.split('_');
                var sub_cat_id = temp[2];

                // get location name and location id
                var location = $('#location').val();                                // This is location id
                var loc_name = $('#location option[value="'+location+'"]').text();  // It has location name
                loc_name = loc_name.replace(/\s+/g, '-');                           // space reolace by dash
             
                var sub_cat_id_identity = sub_cat_id+'-2';                          // Sub Category id with identity

                // Get page url of this category
                $.ajax({
                    method : 'post',
                    url: "{{ route('getPageUrl') }}",
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'filter_title_attr' : sub_cat_id_identity, 'location' : location},
                    success:function(response){

                        console.log(response);

                        if(response == 0)
                        {
                            alert('Result not found!');
                        }
                        else
                        {
                            var temp = response.split('||');

                            // If all is well
                            // var encoded = makeid()+'-'+sub_cat_id_identity+'-'+location;                 // Collect all parameters
                            // encoded = encodeURIComponent(window.btoa(encoded));                 // encode parameter

                            var encoded = temp[1];

                            //window.location.href = "{{url('filter')}}"+"/"+loc_name+"/" +response+"/" +encoded;
                            window.location.href = "{{ url('/') }}"+"/"+loc_name+"/" +temp[0]+"/" +encoded;
                        }
                    },
                    error: function(data){
                        console.log(data);
                    },
                });

            });

            // Client view / Show client details on click client namw
            $(document).on('click', '.client_view_details', function(){
                
                // get category id
                var id = $(this).attr('id');
                var temp = id.split('_');
                var client_id = temp[1];

                // get location name and location id
                var location = $('#location').val();                                // This is location id
                var loc_name = $('#location option[value="'+location+'"]').text();  // It has location name
                loc_name = loc_name.replace(/\s+/g, '-'); 
                var sub_location = $('#sub_location').val();                        // It has area id
                var client_id_identity = client_id+"-3";                            // It has client is and identity

                // Get client details by client id
                $.ajax({
                    method : 'post',
                    url: "{{ route('getPageUrl') }}",
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'filter_title_attr' : client_id_identity, 'location' : location},
                    success:function(response){

                        console.log(response);

                        if(response == 0)
                        {
                            alert('Result not found!');
                        }
                        else
                        {
                            var temp = response.split('||');
                            var encoded = temp[1];
                            window.location.href = "{{ url('/') }}"+"/"+loc_name+"/" +temp[0]+"/" +encoded;
                        }
                    },
                    error: function(data){
                        console.log(data);
                    },
                });

            });

        });

        // generate random id
        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 50; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

    </script>

</head>
<body>