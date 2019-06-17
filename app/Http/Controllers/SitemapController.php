<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserValidation;
use App\User;
use Illuminate\Http\Request;
use DB;
use Storage;
use Auth;


class SitemapController extends Controller
{
    public function index()
    {
        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        $category = "sitemapcat";
        $subcategory = "sitemapsubcat";

        $area_info = DB::table('areas')->where('status', 1)->get();
        //$area_name = $area_info->id;

        return response()->view('sitemap.index', [
            'category' => $category,
            'subcategory' => $subcategory,
            'area_info' => $area_info,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }

    public function sitemapcat()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $categories = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', null)
                ->where('websites_page_head_titles.area', null)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.category', [
            'categories' => $categories,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }

    public function sitemapsubcat()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $subcategory = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', null)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.subcategory', [
            'subcategory' => $subcategory,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap1()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 1)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 1)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap2()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 2)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 2)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area1', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap3()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 3)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 3)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area2', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap4()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 4)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 4)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area3', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap5()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 5)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 5)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area4', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap6()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 6)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 6)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area5', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap7()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 7)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 7)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area6', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap8()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 8)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 8)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area7', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap9()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 9)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 9)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area8', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap10()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 10)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 10)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area9', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap11()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 11)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 11)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area10', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap12()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 12)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 12)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area11', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap13()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 13)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 13)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area12', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap14()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 14)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 14)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area13', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap15()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 15)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 15)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area14', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap16()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 16)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 16)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area15', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap17()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 17)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 17)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area16', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap18()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 18)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 18)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area17', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap20()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 20)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 20)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area19', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap21()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 21)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 21)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area20', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap22()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 22)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 22)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area21', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap23()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 23)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 23)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area22', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap24()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 24)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 24)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area23', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap25()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 25)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 25)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area24', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap26()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 26)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 26)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area25', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap27()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 27)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 27)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area26', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap28()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 28)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 28)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area27', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap29()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 29)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 29)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area28', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap30()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 30)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 30)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area29', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap31()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 31)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 31)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area30', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap32()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 32)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 32)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area31', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap33()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 33)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 33)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area32', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap34()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 34)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 34)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area33', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap35()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 35)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 35)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area34', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap36()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 36)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 36)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area35', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap37()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 37)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 37)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area36', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap38()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 38)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 38)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area37', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap39()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 39)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 39)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area38', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap40()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 40)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 40)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area39', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap41()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 41)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 41)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area40', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap42()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 42)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 42)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area41', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap43()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 43)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 43)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area42', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap44()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 44)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 44)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area43', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap45()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 45)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 45)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area44', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap46()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 46)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 46)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area45', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap47()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 47)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 47)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area46', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }
    public function sitemap48()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 48)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 48)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area47', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap49()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 49)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 49)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area48', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap50()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 50)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 50)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area49', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap51()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 51)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 51)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area50', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap52()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 52)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 52)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area51', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap53()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 53)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 53)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area52', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap54()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 54)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 54)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area53', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap55()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 55)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 55)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area54', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap56()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 56)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 56)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area55', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap57()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 57)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 57)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area56', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap58()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 58)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 58)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area57', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap59()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 59)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 59)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area58', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap60()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 60)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 60)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area59', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap61()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 61)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 61)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area60', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap62()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 62)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 62)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area61', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap63()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 63)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 63)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area62', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap64()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 64)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 64)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area63', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap65()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 65)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 65)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area64', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap66()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 66)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 66)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area65', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap67()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 67)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 67)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area66', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap68()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 68)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 68)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area67', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap69()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 69)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 69)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area68', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap70()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 70)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 70)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area69', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap71()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 71)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 71)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area70', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap72()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 72)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 72)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area71', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap73()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 73)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 73)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area72', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap74()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 74)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 74)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area73', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap75()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 75)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 75)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area74', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap76()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 76)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 76)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area75', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap77()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 77)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 77)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area76', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap78()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 78)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 78)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area77', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap79()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 79)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 79)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area78', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap80()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 80)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 80)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area79', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap81()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 81)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 81)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area80', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap82()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 82)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 82)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area81', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap83()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 83)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 83)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area82', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap84()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 84)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 84)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area83', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap85()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 85)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 85)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area84', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap86()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 86)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 86)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area85', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap87()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 87)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 87)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area86', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap88()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 88)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 88)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area87', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap89()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 89)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 89)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area88', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap90()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 90)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 90)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area89', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap91()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 91)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 91)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area90', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap92()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 92)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 92)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area91', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap93()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 93)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 93)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area92', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap94()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 94)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 94)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area93', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap95()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 95)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 95)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area94', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap96()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 96)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 96)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area95', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap97()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 97)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 97)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area96', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap98()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 98)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 98)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area97', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap99()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 99)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 99)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area98', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap100()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 100)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 100)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area99', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap101()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 101)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 101)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area100', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap102()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 102)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 102)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area101', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap103()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 103)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 103)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area102', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap104()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 104)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 104)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area103', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap105()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 105)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 105)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area104', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap106()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 106)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 106)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area105', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap107()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 107)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 107)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area106', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap108()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 108)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 108)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area107', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap109()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 109)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 109)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area108', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap110()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 110)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 110)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area109', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap111()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 111)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 111)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area110', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap112()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 112)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 112)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area111', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap113()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 113)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 113)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area112', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap114()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 114)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 114)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area113', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap115()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 115)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 48)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area114', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }   
    public function sitemap116()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 116)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 116)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area115', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap117()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 117)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 117)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area116', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap118()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 118)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 118)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area117', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap119()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 119)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 119)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area118', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap120()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 120)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 120)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area119', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap121()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 121)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 121)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area120', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap122()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 122)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 122)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area121', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap123()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 123)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 123)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area122', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap124()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 124)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 124)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area123', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap125()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 125)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 125)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area124', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap126()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 126)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 126)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area125', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap127()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 127)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 127)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area126', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap128()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 128)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 128)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area127', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap129()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 129)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 129)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area128', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap130()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 130)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 130)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area129', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap131()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 131)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 131)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area130', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
    public function sitemap132()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 132)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 132)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area131', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }     
    public function sitemap133()
    {

        $hostname =  'https://'.$_SERVER['HTTP_HOST']; 

        if (strpos($hostname, 'localhost') !== false) {
            $base_url = $hostname."/enquire_us/trunk/";
        }else{
            $base_url = $hostname."/";
        }

        // get all page urls from database table
        $cat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '=', null)
                ->where('websites_page_head_titles.area', '=', 133)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        // get all page urls from database table
        $subcat_areas = DB::table('websites_page_head_titles')
                ->leftjoin('cities', 'cities.id', '=', 'websites_page_head_titles.city')
                ->where('websites_page_head_titles.status', 1)
                ->where('websites_page_head_titles.update_status', 1)
                ->where('websites_page_head_titles.category', '!=', null)
                ->where('websites_page_head_titles.subcategory', '!=', null)
                ->where('websites_page_head_titles.area', '=', 133)
                ->select('websites_page_head_titles.*', 'cities.name')
                ->get();

        return response()->view('sitemap.area132', [
            'cat_areas' => $cat_areas,
            'subcat_areas' => $subcat_areas,
            'base_url' => $base_url

        ])->header('Content-Type', 'text/xml');
    }    
}
