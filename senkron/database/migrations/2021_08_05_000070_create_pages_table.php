<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->index();
            $table->foreignId('image')->nullable()->constrained('uploads');
            $table->foreignId('background')->nullable()->constrained('uploads');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->enum('type', ['normal', 'service'])->nullable()->default('normal');
            $table->enum('layout', ['full', 'without_menu'])->nullable()->default('full');
            $table->enum('status', ['published', 'waiting_for_review'])->default('published')->index();
            $table->audiTable();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('service_category_id')->nullable()->constrained('service_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
