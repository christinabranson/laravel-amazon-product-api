<?php

return [
    
	// Amazon access key
	'access_key' => env('AMAZON_ACCESS_KEY', ''),
	
	// Amazon secret key
	'secret_key' => env('AMAZON_SECRET_KEY', ''),
	
	// Associate tag
	'associate_tag' => env('AMAZON_ASSOCIATE_TAG', ''),
	
	// Locale
	// Options: 'co.uk', 'com', 'ca', 'com.br', 'de', 'es', 'fr', 'in', 'it', 'co.jp', 'com.mx'
	'locale' => 'com',
	
	// Available Locales
	'available_locales' => [
		'co.uk',
		'com',
		'ca',
		'com.br',
		'de',
		'es',
		'fr',
		'in',
		'it',
		'co.jp',
		'com.mx'
		],
			
	// Default response group
	'response_group' => env('AMAZON_RESPONSE_GROUP', 'BrowseNodes,Images,ItemAttributes,OfferSummary'),
	
	// Amazon categories
	'categories' => [
		"All", 
		"Appliances", 
		"ArtsAndCrafts", 
		"Automotive", 
		"Baby", 
		"Beauty", 
		"Books", 
		""
		
		],
	
	
	
];