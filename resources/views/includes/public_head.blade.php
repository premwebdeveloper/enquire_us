<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="">
    <title><?php if(!empty($title)){ echo $title;} ?></title>
    <meta name="description" content="<?php if(!empty($meta_description)){ echo $meta_description; } ?>" />
    <meta name="keywords" content="<?php if(!empty($meta_keywords)){ echo $meta_keywords; } ?>" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('resources/frontend_assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('resources/frontend_assets/js/bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('resources/frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend_assets/js/nivo-slider/nivo-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/nivo-slider/themes/default/default.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend_assets/css/bootstrap-social.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/custom_new.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset ('resources/frontend_assets/css/validationEngine.jquery.css') }}" rel="stylesheet" />

    <style type="text/css">
        /*.theme-default .nivoSlider img {
            position: absolute;
            top: 0px;
            left: 0px;
            display: block;
        }*/
    </style>

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

							console.log(response);

							if(response == 0)
							{
								alert('Result not found!');
							}
							else
							{
								// all is well
								var encoded = makeid()+'-'+filter_title_alt;
								// encode parameter
								encoded = encodeURIComponent(window.btoa(encoded));

								window.location.href = "{{url('filter')}}"+"/"+loc_name+"/" +response+"/" +encoded;
							}
                        },
                        error: function(data){
                            console.log(data);
                        },
                    });

                }
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
