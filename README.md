# laravel-amazon-product-api

This is an example implementation of the [Amazon Product API](http://aws.amazon.com/archives/Product%20Advertising%20API/) within the Laravel framework.

## File structure

The following table shows the file structure to make everything work within Laravel:

| File Location | Description | 
| ----- | ----- |
| `app/Classes/Amazon.php` | Main class file for implementing the Product Search API |
| `app/Facades/Amazon.php` | Add amazon facade |
| `app/Http/Controllers/ProductController.php` | Example controller to access the Amazon class |
| `app/Http/routes.php` | Example routes to implement the product search functionality |
| `app/Providers/AmazonServiceProvider.php` | Add Amazon service provider |
| `app/Product.php` | Example model to save and access stored Product information |
| `config/amazon.php` | Amazon config file where information like access key, secret key, and locales are stored |
| `config/app.php` | Add service provider and class alias |
| `database/migrations/*` | Example migrations to create product tables in the database |
| `composer.json` | Needed to add guzzleHttp dependency |

## Amazon class

The Amazon class in `app/Classes/Amazon.php` performs the following functions:

| Function | Inputs | Returns | Description | Example |
| ----- | ----- | ----- |----- | ----- |
| `__construct()` | - | - | Constructor for Amazon class. Applies config files from `/config/amazon.php`. | |
| `itemSearch()` | keyword, category, page, sort | Http response | Performs basic itemSearch query based on keywords, with optional category, page number, or sorting options | `$response = Amazon::itemSearch("hello kitty", "All",1);` |
| `itemLookup()` | ASIN | Http response | Performs basic itemLookup by Amazon ASIN identifier | `$response = Amazon::itemSearch("hello kitty", "All",1);` |
| `product()` | - | Product | Converts the HTTP response for a single product lookup to a Product object | `$product = Amazon::itemLookup($ASIN)->product();` |
| `products()` | - | Array of Products | Converts the HTTP response for a search to an array of Product objects | `$products = Amazon::itemSearch("hello kitty", "All",1)->products();` |
| `xmlToProduct()` | XML | Product | Performs the actual XML to Product conversion | `$product = $this->xmlToProduct($xml);` |
| `json()` | - | JSON | Converts HTTP response to JSON | `$products = Amazon::itemSearch("hello kitty", "All",1)->json();` |
| `xml()` | - | XML | Converts HTTP response to XML | `$products = Amazon::itemSearch("hello kitty", "All",1)->xml();` |
| `makeUrl()` | Array of parameters | String URL | Creates the signed URL of request parameters | `$url = $this->makeUrl($params);` |

### Product

For the application that I'm developing, I'm storing some product information in a products table in the database. The `product()` 
and `products()` functions are designed to export the corresponding Product object.

## To Do

- [x] Add Amazon classes, facades, service providers, and configs
- [x] Add documentation
- [ ] Write item lookup function
- [ ] Write similar item lookup function
- [ ] Update documentation
