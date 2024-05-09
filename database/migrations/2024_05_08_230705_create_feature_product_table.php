<?php

// database/migrations/YYYY_MM_DD_create_feature_product_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureProductTable extends Migration
{
    public function up()
    {
        Schema::create('feature_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id'); // Adding category_id
            $table->timestamps();

            $table->unique(['feature_id', 'product_id']);

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Foreign key constraint for category_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_product');
    }
}

