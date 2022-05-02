<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->index();
            $table->foreignId('image_id')->nullable()->constrained('uploads');
            $table->foreignId('section_id')->nullable()->constrained('sections');
            $table->enum('pack', ['fas', 'fab', 'far', 'feather'])->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->foreignId('page_id')->nullable()->constrained('pages');
            $table->audiTable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements');
    }
}
