<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
     /*
     
     ### product_images

    Table to store product images
    
    | Column | Properties | Description |
    | ---- | ---- | ---- |
    | image_id | increments | Id of image |
    | product_id | integer | ID of product |
    | image_url | string | Url of image |
    | image_width | decimal | Width of image |
    | image_height | decimal | Height of image |
     
     */
     
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('image)id');
            $table->integer('product_id');
            $table->string('image_url');
            $table->decimal('image_width');
            $table->decimal('image_height');
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
        Schema::drop('product_images');
    }
}
