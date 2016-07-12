# Database Plan/Dictionary

## Users & Organizations

### users
| Column | Properties | Description |
| ---- | ---- | ---- |
| user_id | increments | ID of user |
| name | string | User name |
| email | string | User email |
| password |string | User password, associated with password_resets table |
| token | --|  |
| timestamps |--| Created and modified |

Relationships:
* Users can belong to many organizations
 

### organizations

| Column | Properties | Description |
| ---- | ---- | ---- |
| organization_id | increments | ID of organization |
| name | string | Name of organization |
| description | mediumtext | Description of organization |
| timestamps | -- | Created and modified |

Relationships:
* Organizations can have many users
 

### organization_permission_users

Relationship table to match organizations and users

| Column | Properties | Description |
| ---- | ---- | ---- |
| id | increments | ID of relationship |
| organization_id | integer | ID of organization |
| user_id | integer | ID of user |
| permission_id | integer | ID of permission |
| primary | bool | Is primary organization of user? |

### permissions

Lookup table for permissions

| Column | Properties | Description |
| ---- | ---- | ---- |
| permission_id | increments | ID of permission |
| name | string | Name of permission |
| description | mediumtext | Description of permission |

Possible permission values

| permission_id | name | description |
| ---- | ---- | ---- |
| 1 | Organization Admin | Users |
| 2 | string | Name of permission |
| 3 | Organization Wisher | User can add wishes |

## Wishlists

### wishlists

| Column | Properties | Description |
| ---- | ---- | ---- |
| wishlist_id | increments | ID of wishlist |
| name | string | Name of permission |
| description | mediumtext | Description of permission |

### wishes

| Column | Properties | Description |
| ---- | ---- | ---- |
| wish_id | increments | Id of wish |
| name | string | Name of wish (default product name) |
| user_description | mediun | User description of wish |
| amount_raised | decimal | Amount of wish raised |

### products

| Column | Properties | Description |
| ---- | ---- | ---- |
| product_id | increments | Id of product |
| ASIN | string | Amazon ASIN of product |
| name | string | Name of product |
| description | mediumtext | Description of product |
| retail_price | decimal | Retail price of product |
| offer_price | decimal | Offer price of product |
| brand | string | Brand of product |
| category | string | Amazon category of product |

### product_wishes

Lookup table for wishes and products

| Column | Properties | Description |
| ---- | ---- | ---- |
| product_id | integer | Id of product |
| wish_id | integer | Id of wish |

Relationships:

* Eash wish has one product

### product_images

Table to store product images

| Column | Properties | Description |
| ---- | ---- | ---- |
| image_id | increments | Id of image |
| product_id | integer | ID of product |
| image_url | string | Url of image |
| image_width | decimal | Width of image |
| image_height | decimal | Height of image |

### product_options

Table to store product options

| Column | Properties | Description |
| ---- | ---- | ---- |
| image_id | increments | Id of image |
| product_id | integer | ID of product |
| option | mediumtext | Product option JSON |


## Commerce

### carts

Table to store shopping cart information

| Column | Properties | Description |
| ---- | ---- | ---- |
| cart_id | increments | Id of image |
| user_id | integer | Id of user |
| wish_id | integer | ID of product |
| amount | decimal | Amount donation |
| timestamps | | |

Relationships:
* A user can have many cart items
* Each cart item can only belong to one user

## orders

| Column | Properties | Description |
| ---- | ---- | ---- |
| order_id | increments | Id of order |
| user_id | integer | Id of user |
| wish_id | integer | ID of wish |
| amount | decimal | Amount donation |
| timestamps | | |
 

