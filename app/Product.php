<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Set primary key
    protected $primaryKey = 'product_id';
    
    // Assignable categories
    protected $fillable = [
        'ASIN', 'name', 'description', 'retail_price', 'offer_price', 'brand', 'category',
    ];
}
