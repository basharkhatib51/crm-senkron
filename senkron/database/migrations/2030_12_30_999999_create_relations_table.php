<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


//        ------------------products------------------
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories');
        });
        Schema::create('product_tag', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('tag_id')->nullable()->constrained('tags');
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable()->constrained('uploads');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->unique(['product_id', 'image_id']);
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->unique(['product_id', 'created_by']);
        });

//        ------------------products------------------
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('slider_id')->nullable()->constrained('sliders');
        });

        Schema::create('page_tag', function (Blueprint $table) {
            $table->foreignId('page_id')->nullable()->constrained('pages');
            $table->foreignId('tag_id')->nullable()->constrained('tags');
        });
        Schema::table('slider_elements', function (Blueprint $table) {
            $table->foreignId('slider_id')->nullable()->constrained('sliders');
        });
//       ------------------uploads relations------------------
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('avatar_id')->nullable()->constrained('uploads');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
