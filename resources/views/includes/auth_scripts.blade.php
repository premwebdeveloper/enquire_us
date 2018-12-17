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
            console.log(latcurr + "-- ######## --" + longcurr);

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
                    console.log(results[0]);
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
                        console.log(data);
                    }
                });
            }else{

                $('#selectCategory').html('');
                $('#selectCategory').html('<option value="">Select Category</option>');
            }

        });

    });
</script>