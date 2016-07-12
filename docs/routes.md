# Routes

I'm considering changing the URL structure:

1. `/p/*`: products 
2. `/o/*`: organization
3. `/u/*`: users
4. `/w/*`: wishlist/wish

## General

| URL | Method | Description | Code |
| ---- | ---- | ---- | ---- |
| / | get | Get home page | `Route::get('/home', 'HomeController@index');` |

.. and the default auth methods

## Products

| URL | Method | Description | Code |
| ---- | ---- | ---- | ---- |
| /product/search | get | Get product search page | `Route::get('/product/search', 'ProductController@getSearchPage');` |
| /product/search | post | Get product search results | `Route::post('/product/search', 'ProductController@getSearchResults');` |
| /product/name/{product_name} | get | Get product by name (single) | `Route::get('/product/search', 'ProductController@getProductByName');` |
| /product/id/{product_asin} | get | Get product by ASIN (single) | `Route::get('/product/search', 'ProductController@getProductByASIN');` |
| /product/category/{category_name}/{page} | get | Get product search result by category | `Route::get('/product/search', 'ProductController@searchByCatgory');` |

## Wishlists

| URL | Method | Description | Code |
| ---- | ---- | ---- | ---- |
| /wish/{wish_id} | get | Get wish | `Route::get('/wish/{wish_id}', 'WishController@getWish');` |
| /wish/new | get | New wish | `Route::get('/wish/new', 'WishController@newWish');` |
| /wish/edit | get | Edit wish | `Route::get('/wish/edit', 'WishController@editWish');` |
| /wishlist/{organization_name}/{wishlist_name} | get | Get wishlist | `Route::get('/wishlist/{organization_name}/{wishlist_name}', 'WishlistController@getWishlist');` |
| /wishlist/{wishlist_id} | get | Get wishlist | `Route::get('/wishlist/{organization_name}/{wishlist_name}', 'WishlistController@getWishlist');` |

## Organizations

| URL | Method | Description | Code |
| ---- | ---- | ---- | ---- |
| /organization/search | get | Get organization search page | `Route::get('/product/search', 'OrganizationController@search');` |
| /organization/admin/

## Users

