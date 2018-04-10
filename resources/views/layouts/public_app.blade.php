@include('includes.public_head')

<!-- get areas according to city -->
<?php
$city = '3378';

// Get all cities of rajasthan state
$areas = DB::table('areas')->where('city', $city)->get();

?>
@include('includes.public_header')

    @yield('content')

@include('includes.public_footer')