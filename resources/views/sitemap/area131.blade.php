<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($cat_areas as $url)
        <url>
            <loc>
                @php
                    if(!empty($url->category) || !empty($url->business_page)){
                            
                        echo $base_url . $url->name .'/'. $url->page_url .'/'. $url->encoded_params;
                    }else{

                        if($url->page_url == '/'){

                            echo $base_url;
                        }else{
                            
                            echo $base_url . $url->page_url;
                        }
                    }

                @endphp
            </loc>
        </url>
    @endforeach    
    @foreach ($subcat_areas as $url)
        <url>
            <loc>
                @php
                    if(!empty($url->category) || !empty($url->business_page)){
                            
                        echo $base_url . $url->name .'/'. $url->page_url .'/'. $url->encoded_params;
                    }else{

                        if($url->page_url == '/'){

                            echo $base_url;
                        }else{
                            
                            echo $base_url . $url->page_url;
                        }
                    }

                @endphp
            </loc>
        </url>
    @endforeach
</urlset>