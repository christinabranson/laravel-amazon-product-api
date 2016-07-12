<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Amazon;
use Log;

class ProductController extends Controller {
    // Get search page view
    public function getSearchPage(Request $request) {
        
        Log::info("getSearchPage()");
        
        // return view
        return view('products.index', [
            //'sprites' => array($request),
        ]);
        
    } // getSearchPage
    
    // Search for products based on URL parameters
    // Route::get('/product/search/{keywords}/{category}/{page}/{sort}', 'ProductController@search');
    public function search($keywords, $category = "All", $page = "1", $sort = "price") {
        Log::info("search($keywords, $category, $page, $sort)");
        Log::info("Keywords:\t" .  $keywords);
        Log::info("Category:\t" .  $category);
        Log::info("Page:\t" .  $page);
        Log::info("Sort:\t" .  $sort);
        
        $products = Amazon::itemSearch($keywords, $category, $page, $sort)->products();
        foreach($products as $product)
            var_dump($product);
        
    } // search
    
    // Search for products based on form submission
    public function formSearch(Request $request) {
        
        $keywords = $request->keywords;
        $category = $request->category;
        $page = $request->page;
        $sort = $request->sort;
        
        Log::info("formSearch()");
        Log::info("Keywords:\t" .  $keywords);
        Log::info("Category:\t" .  $category);
        Log::info("Page:\t" .  $page);
        Log::info("Sort:\t" .  $sort);
        
        $products = Amazon::itemSearch($keywords, $category, $page, $sort)->json();
        var_dump($products);
        
    } // formSearch
    
    
    
}
