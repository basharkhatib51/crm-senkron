<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_elements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->foreignId('image_id')->nullable()->constrained('uploads');
            $table->foreignId('background_id')->nullable()->constrained('uploads');
//            $table->string('bg_color')->nullable();
//            $table->string('bg_gradient')->nullable();
            $table->text('content')->nullable();
            $table->enum('content_position', ['center', 'start', 'end'])->nullable()->default('center');
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
        Schema::dropIfExists('slider_elements');
    }
}
