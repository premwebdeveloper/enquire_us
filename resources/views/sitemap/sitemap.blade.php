{{ header("Content-Type: application/xml; charset=utf-8") }}

{{ '<?xml version="1.0" encoding="UTF-8"?>' }}

<br />
<br />

{{'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'}}

<br />
<br />

@foreach ($urls as $key => $url)
    {{'<url>'}}
        <br />
        {{ '&nbsp;&nbsp;&nbsp;&nbsp;<loc>' }}
            {{ $base_url . $url->page_url }}
        {{'</loc>'}}
        <br />
     {{'</url>'}}

    <br />

@endforeach

<br />

{{'</urlset>'}}