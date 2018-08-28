@include('includes.public_head')

@include('includes.public_header')

    @yield('content')

    <!-- Get all categories to show in footer alphabetically -->
    @php

		$foot_categories = DB::table('category')->where('status', 1)->orderBy('category')->get();

    @endphp

@include('includes.public_footer')