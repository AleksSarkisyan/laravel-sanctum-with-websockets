<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->float('price', 8, 2);
            $table->float('promo_price', 8, 2);
            $table->string('image_url')->nullable();
            $table->string('slug')->nullable();
            $table->string('weight');
            $table->tinyInteger('is_promo')->nullable();
            $table->tinyInteger('is_active');
            $table->timestamps();

            $table->unique(['name', 'user_id', 'price', 'weight']);
            $table->foreign('user_id')->references('id')->on('restaurant_users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
