<!-- Mainly scripts -->
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/peity-demo.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/pace/pace.min.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script> 
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
    <!-- date renage picket js -->
    <script src="{{ asset('resources/assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('resources/assets/js/inspinia.js') }}"></script>

    <!-- *************************************************************************************** -->
    <!-- Custom scripts -->
    @include('includes.auth_scripts')

</body>
</html>