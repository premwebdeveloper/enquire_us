<!-- Mainly scripts -->

    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/peity-demo.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <!-- <script src="{{ asset('resources/assets/js/inspinia.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/plugins/pace/pace.min.js') }}"></script>

    <!-- <script src="{{ asset('resources/assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/sparkline-demo.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/summernote/summernote.min.js') }}"></script>
  
    <!-- Google api for get current location -->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCD12UaZxo_4B0ScJAkuwx7PgkUeV6DsFE&libraries=places&callback=initMap" async defer></script>

    <!-- confirmation and popper js -->
    <script src="{{ asset('resources/assets/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ asset('resources/assets/js/popper.min.js') }}"></script>

    <!-- Date time picker js -->
    <script src="{{ asset('resources/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    @include('includes.auth_scripts')

    <script type="text/javascript" charset="utf-8">

        $(document).ready(function() {

            /* ******************************************************************* */
            // Confirmation js
            $('.element').confirmation();

            /* ******************************************************************* */
            // Editor js
            $('.summernote').summernote({
                minHeight: 200
            });

            /* ******************************************************************* */
            // Get current location of user
            var currgeocoder;

            //Set geo location lat and long
            navigator.geolocation.getCurrentPosition(function(position, html5Error) {

                geo_loc = processGeolocationResult(position);
                currLatLong = geo_loc.split(",");
                initializeCurrent(currLatLong[0], currLatLong[1]);
            });

            //Get geo location result
            function processGeolocationResult(position) {
                html5Lat = position.coords.latitude; //Get latitude
                html5Lon = position.coords.longitude; //Get longitude
                html5TimeStamp = position.timestamp; //Get timestamp
                html5Accuracy = position.coords.accuracy; //Get accuracy in meters
                return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
            }

            //Check value is present or not & call google api function
            function initializeCurrent(latcurr, longcurr) {
                currgeocoder = new google.maps.Geocoder();
                console.log(latcurr + "-- ######## --" + longcurr);

                if (latcurr != '' && longcurr != '') {
                    var myLatlng = new google.maps.LatLng(latcurr, longcurr);
                    return getCurrentAddress(myLatlng);
                }
            }

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

            /* ******************************************************************* */
            // Date and time picker
            $(".form_datetime1").datetimepicker({format: 'yyyy-mm-dd hh:ii', forceParse: true});

        });
    </script>  
</body>
</html>