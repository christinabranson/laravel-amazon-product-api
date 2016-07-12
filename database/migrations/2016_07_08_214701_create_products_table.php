<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
     /*
     
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
    
    */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('ASIN')->unique();
            $table->string('name');
            $table->mediumtext('description');
            $table->decimal('retail_price');
            $table->decimal('offer_price');
            $table->string('brand');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
