<?php

namespace App\Classes;

use Log;
use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Amazon {
    
    // Construct class, set config paramaters in /config/amazon.php
    public function __construct()
	{
		$this->response 		= null;
		$this->access_key 		= config('amazon.access_key');
		$this->secret_key 		= config('amazon.secret_key');
		$this->associate_tag	= config('amazon.associate_tag');
		$this->locale			= config('amazon.locale');
		$this->endpoint         = "webservices.amazon." . $this->locale;
		$this->response_group	= str_replace(' ', '', config('amazon.response_group'));
		$this->client 			= new Client;
	}
	
    // Perform an ItemSearch query
    // example: $product = Amazon::itemSearch("hello kitty", "All",1);
    public function itemSearch($keyword, $category = "All", $page = 1, $sort = "") {

        // TODO: Make function to validate correct product category
        $category = $this->validateCategory($category);

        // Set operation parameters
		$params = array(
            "Operation" => "ItemSearch",
            "SearchIndex" => rawurlencode($category),
            "Keywords" => rawurlencode($keyword),
            "ResponseGroup" => "BrowseNodes,EditorialReview,Images,ItemAttributes,OfferSummary,Reviews",
            "ItemPage" => $page,
        );
        
        // Sort not available on all
        // TODO: Make function to validate correct product sort param
        if ("All" !== $category)
            $params["Sort"] = $sort;
        
        $url = $this->makeUrl($params);

		try {
			$this->response = $this->client->get($url)->getBody()->getContents();
			return $this;
		} catch(ClientException $e) {
		    Log::error("Exception:\t" . $e->getResponse());
		    Log::error("Error code:\t" . $this->client->get($url)->getStatusCode());
			return $e->getResponse();
		}
	} // itemSearch
	
	// Format as product object
	public function product() {
        $xml = simplexml_load_string($this->response);
        $product = $this->xmlToProduct($item);
	    return $product;
	    
	} // product
	
	// Format as product object
	public function products() {
	    $xml = simplexml_load_string($this->response);
	    $products = array();
	    
	    foreach ($xml->Items->Item as $item) {
            $product = $this->xmlToProduct($item);
	        $products[] = $product;
	    }
	    
	    return $products;
	} // products
	
	// XML to product
	public function xmlToProduct($xml) {
	        $product = new Product;

	        Log::info("Title:\t".$xml->ItemAttributes->Title);
	        Log::info("ASIN:\t".$xml->ASIN);
	        Log::info("Offer price:\t".$xml->OfferSummary->LowestNewPrice->FormattedPrice);
	        Log::info("Node:\t".$xml->BrowseNodes->BrowseNode[0]->Name);
	        
            if ($xml->EditorialReviews) {
    	        foreach($xml->EditorialReviews->EditorialReview as $review) {
    	            if ($review->Source == "Product Description" && isset($review->Content))
    	                $product->description = $review->Content;
    	        }
            }
	        
    	    $product->name = (string) $xml->ItemAttributes->Title;
    	    $product->description = "";
    	    $product->offer_price = str_replace('$','',$xml->OfferSummary->LowestNewPrice->FormattedPrice);
    	    $product->ASIN = (string) $xml->ASIN;
    	    $product->category = (string) $xml->BrowseNodes->BrowseNode[0]->Name;
    	    
    	    return $product;
	} // xmlToProduct
	
	// Format JSON
	public function json() {
		$xml  = simplexml_load_string($this->response);
		$json = json_encode($xml);
		$json = json_decode($json, true);
		return $json;
	} // json
	
	// Format XML
	public function xml() {
	    return simplexml_load_string($this->response);
	} // xml
	
	
	// Generate signed URL
	private function makeUrl($params) {
	    
	    // Set default paramaters
	    $params["Service"] = "AWSECommerceService";
	    $params["AWSAccessKeyId"] = $this->access_key;
	    $params["AssociateTag"] = $this->associate_tag;
	    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
	    if (!$params["ResponseGroup"]) {
	        $params["ResponseGroup"] = $this->response_group;
	    }
	    
	    // Sort the parameters by key
        ksort($params);
        
        $pairs = array();
        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }
        
        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);
        
        $uri = "/onca/xml";
        
        // Generate the string to be signed
        $string_to_sign = "GET\n".$this->endpoint."\n".$uri."\n".$canonical_query_string;
        
        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->secret_key, true));
        
        // Generate the signed URL
        $request_url = 'http://'.$this->endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
        
        Log::info("Signed URL: \"".$request_url."\"");
        
        return $request_url;
	} // makeUrl
	
	// Validate that the category is 
	private function validateCategory($category) {
	    
	    return "All";
	} // validateCategory
	
	
	
}