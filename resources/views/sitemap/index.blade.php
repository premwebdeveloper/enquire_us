<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <sitemap>

        <loc>@php echo $base_url .'sitemap/'. $category @endphp</loc>

    </sitemap>

    <sitemap>

        <loc>@php echo $base_url .'sitemap/'. $subcategory @endphp</loc>

    </sitemap>

    @foreach ($area_info as $key => $area)



    <sitemap>

        <loc>@php echo $base_url .'sitemap/sitemap'.$area->id @endphp</loc>

    </sitemap>  

    @endforeach

</sitemapindex>