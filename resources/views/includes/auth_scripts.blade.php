<script type="text/javascript">

    $(document).ready(function(){

        /* ****************************************************************************** */
        // Meeting assign to sales by support executive
        $(document).on('click', '.assignToSales', function(){
            
            var id = $(this).attr('id');
            $('#meeting_client_uid').val(id);
            
            $('#assignToSalesModal').modal('show');
        });

        /* ****************************************************************************** */
        // data table script for dataTables-example class
        var oTable = $('.dataTables-example').DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });

        /* ****************************************************************************** */
        // data table script for dataTables class
        $('.dataTables').DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });

        /* ****************************************************************************** */
        // Confirmation js
        $('.element').confirmation();

        /* ****************************************************************************** */
        // Editor js
        $('.summernote').summernote({
            minHeight: 200
        });

        /* ****************************************************************************** */
        // Get current location of user
        var currgeocoder;

        /* ****************************************************************************** */
        //Set geo location lat and long
        navigator.geolocation.getCurrentPosition(function(position, html5Error) {

            geo_loc = processGeolocationResult(position);
            currLatLong = geo_loc.split(",");
            initializeCurrent(currLatLong[0], currLatLong[1]);
        });

        /* ****************************************************************************** */
        //Get geo location result
        function processGeolocationResult(position) {
            html5Lat = position.coords.latitude; //Get latitude
            html5Lon = position.coords.longitude; //Get longitude
            html5TimeStamp = position.timestamp; //Get timestamp
            html5Accuracy = position.coords.accuracy; //Get accuracy in meters
            return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
        }

        /* ****************************************************************************** */
        //Check value is present or not & call google api function
        function initializeCurrent(latcurr, longcurr) {
            currgeocoder = new google.maps.Geocoder();
            //console.log(latcurr + "-- ######## --" + longcurr);

            if (latcurr != '' && longcurr != '') {
                var myLatlng = new google.maps.LatLng(latcurr, longcurr);
                return getCurrentAddress(myLatlng);
            }
        }

        /* ****************************************************************************** */
        //Get current address
        function getCurrentAddress(location) {
            //alert(location);
            currgeocoder.geocode({
                'location': location
            }, function(results, status) {               
                if (status == google.maps.GeocoderStatus.OK) {
                    //console.log(results[0]);
                    $("#current_location").val(results[0].formatted_address);
                    //alert(results[0].formatted_address);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        /* ****************************************************************************** */
        // Date and time picker
        $(".form_datetime1").datetimepicker({format: 'yyyy-mm-dd hh:ii', forceParse: true});

        /* ****************************************************************************** */
        // Edit suggested category
        $(document).on('click', '.edit_category', function(){

            var cat_id = $(this).attr('id');

            var temp = cat_id.split('-');

            $('#suggested_cate_id').val(temp[1]);
            $('#suggested_category').val(temp[2]);

            $('#editSuggestedCategoryModal').modal('show');
           
        });

        /* ****************************************************************************** */
        // Approve suggested category
        $(document).on('click', '.approve_category', function(){

            var cat_id = $(this).attr('id');

            var temp = cat_id.split('-');

            $('#approve_suggested_cate_id').val(temp[1]);
            $('#approve_suggested_cat_name').val(temp[2]);
            $('#approve_suggested_cate_title').append(' ( '+temp[2]+' )');

            $('#approveSuggestedCategoryModal').modal('show');
        });

        /* ****************************************************************************** */
        // Get categories according to super category
        $(document).on('change', '.getCatsBySuperCat', function(){

            var super_cat = $(this).val();

            if(super_cat != '' && super_cat != null){

                $.ajax({
                    url : 'getCatsAccordingToSuperCat',
                    type : 'post',
                    data : { "_token": "{{ csrf_token() }}", 'super_cat' : super_cat},
                    success : function(response)
                    {
                        $('#selectCategory').html('');
                        $('#selectCategory').html(response);
                    },
                    error:function(data)
                    {
                        //console.log(data);
                    }
                });
            }else{

                $('#selectCategory').html('');
                $('#selectCategory').html('<option value="">Select Category</option>');
            }

        }); 

        // Autocomplete on search category and firm name
        $(".new_company_name").autocomplete({

            source: function( request, response ) {

                // If request term limit is greater than 2 word
                if(request.term.length < 3) return;

                $.ajax({
                    url: "{{ route('getSimilarCompany') }}",
                    dataType: "json",
                    data: {
                        term : request.term,
                    },
                    success: function(data) {

                        console.log(data);

                        if (data[0] !== '' && data[0] !== null)
                        {
                            var array = $.map(data, function (item) {
                            // Show all similar company name                                
                            return {
                                    label: item.business_name,
                                    value: item.user_id,
                                    data : item
                                }
                            });
                            response(array)
                        }
                    }
                });
            },
            select: function( event, ui ) {

                console.log(ui.item.data);

                // Fill all the information in form
                $('.new_company_name').val(ui.item.data.business_name);
                $('#client_uid').val(ui.item.data.user_id);
                $('#name').val(ui.item.data.name);
                $('#email').val(ui.item.data.email);
                $('#email').prop('disabled', true);
                $('#phone').val(ui.item.data.phone);
                $('#building').val(ui.item.data.building);
                $('#street').val(ui.item.data.street);
                $('#landmark').val(ui.item.data.landmark);                
                $('#city option[value="'+ui.item.data.city+'"]').attr('selected', 'selected');
                $('#area option[value="'+ui.item.data.area+'"]').attr('selected', 'selected');
                $('#pin_code').val(ui.item.data.pincode);                
                $('#mobile').val(ui.item.data.mobile);
                $('#whatsapp').val(ui.item.data.whatsapp);
                $('#toll_free1').val(ui.item.data.toll_free1);
                $('#landline').val(ui.item.data.landline);
                $('#website').val(ui.item.data.website);

                $('#about_company').text(ui.item.data.about_company);
                $('.note-editable').text(ui.item.data.about_company);

                // disable password fields
                $('#password').prop('disabled', true);
                $('#password-confirm').prop('disabled', true);

                // Check hostname if hostname is localhost
                var url = window.location.href;
                var localhost = url.search('localhost');
                // server name is not localhost
                if(localhost == '-1'){

                    var form_action = 'https://www.enquireus.com/update_admin_user';
                }else{

                    var form_action = 'http://localhost/enquire_us/trunk/update_admin_user';
                }
                
                // change form action
                $('#addUserForm').attr('action', form_action);

                // Make next button enable after make this form as edit form
                $('#addUserBasicInformationButton').prop('disabled', false);

                // Get this user assigned keywords
                var client_uid = ui.item.data.user_id;

                // Get already assigned keyword with this user
                $.ajax({
                    url : '{{ route("getSavedKeywords_By_Admin") }}',
                    type : 'post',
                    data : { "_token": "{{ csrf_token() }}", 'user_id' : client_uid},
                    success : function(response)
                    {
                        $('#showKeywordsByAutocomplereSearch').show();
                        $('#showKeywordsByAutocomplereSearch').append(response);
                        //console.log(response);
                    },
                    error:function(data)
                    {
                        //console.log(data);
                    }
                });

                return false;
            }
        });

        // Search Keywords using jquery auto complete on page add users basic information
        $("#search_keywords").autocomplete({
            source: function( request, response ) {

                // If request term limit is greater than 2 word
                if(request.term.length < 3) return;

                $.ajax({
                    url: "{{ route('searchajax') }}",
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
                
                // console.log(ui.item);

                $('#search_keywords').val(ui.item.data.category);
                var category = ui.item.data.category;
                var cat_id   = ui.item.data.cat_id;
                var status   = ui.item.data.status;

                // Show searched data in "searched_result" section
                $.ajax({
                    method : 'post',
                    url : '{{ route("getRelatedCategoryAndSubCatregories") }}',
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'cat_id': cat_id, 'category': category, 'status': status},
                    success:function(response){;

                        // Searched entry
                        var html = '<p style="margin:0px;"><input type="checkbox" name="keyword[]" value="'+cat_id+'-'+status+'" class="status_'+status+'" checked> '+category+' </p>';

                        $.each(response, function (key, val) {
                            html += '<p style="margin:0px;"><input type="checkbox" name="keyword[]" value="'+val.id+'-'+val.status+'" class="status_'+val.status+'"> '+val.category+' </p>';
                        });

                        // Fill all the information in related box
                        $("#keyword_searched_result").html(html);

                        // Make next button enable now
                        $("#addUserBasicInformationButton").removeAttr('disabled');
                    },
                    error: function(data){
                        //console.log(data);
                    },
                });
                return false;
            }
        });

        // Add keyword section show
        $(".add_keyword").click(function() {
            $("#add_keyword").show();
            $("#hide_add_button").hide();
        });

        // Suggest for new category
        $(document).on('click', '#suggestCategory', function(){

            var category = $('#suggest_category').val();

            if(category != '' && category != null){

                $.ajax({
                    url : '{{ route("suggestForNewKeyword") }}',
                    type : 'post',
                    data : { "_token": "{{ csrf_token() }}", 'category' : category},
                    success : function(response)
                    {
                        if(response == 1){

                            $('#suggest_category').val('');
                            alert('Keyword suggested successfully.');
                            $('#categorySuggestionModal').modal('hide');

                        }else{

                            alert('Something went wrong!');
                        }
                    },
                    error:function(data)
                    {
                        //console.log(data);
                    }
                });
            }else{
                alert('Type something!');
            }
        });

        // If user suggest keyword then disable search keyword and enable next button
        $(document).on('keyup', '#first_keyword_suggest', function(){

            var length = $(this).val().length;

            // If the length greater than 1
            if(length > 1){
                                
                // Make next button enable now
                $("#addUserBasicInformationButton").removeAttr('disabled');
            }else{
                
                // Make next button enable now
                $("#addUserBasicInformationButton").prop('disabled', true);
            }
        });

        // Add more suggest keyword box
        $(document).on('click', '.add_more_suggest_keyword', function(){

            var first_suggested_keyword = $('#first_keyword_suggest').val();

            if(first_suggested_keyword != ''){

                var html = '<div class="suggest_keyword_parent"><div class="col-md-10"><input class="form-control suggest_keyword" name="suggest_keyword[]" type="text" placeholder="Suggest Keyword"></div><div class="col-md-2"><a href="javascript:;" class="btn btn-danger btn-sm remove_suggest_keyword" title="Remove"><i class="fa fa-times"></i></a></div></div>';

                $('#append_more_keyword_suggestion').append(html);
            }else{
                
                alert('First use default collumn to suggest new keyword!');
            }
        });

        // Remove suggest keyword box
        $(document).on('click', '.remove_suggest_keyword', function(){

            $(this).parent().parent().remove();
        });

        // Show changes and previous record in pop up to compare
        $(document).on('click', '.changes_for_approval', function(){

            var id = $(this).attr('id');

            $.ajax({
                url : '{{ route("compareClientInformation") }}',
                type : 'post',
                data : { "_token": "{{ csrf_token() }}", 'id' : id},
                success : function(response)
                {
                    console.log(response);
                    $('#showComparedChanges').html(response);
                    $('#compareChangesModal').modal('show');
                },
                error:function(data)
                {
                    //console.log(data);
                }
            });
        });

    });
</script>