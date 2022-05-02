<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->enum('type', ['url', 'page', 'route']);
            $table->text('url')->nullable()->default('#');
            $table->audiTable();
        });
        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('menu_id')->nullable()->constrained('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
