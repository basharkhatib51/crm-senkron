<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_keys', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('key');
            $table->string('ip_address')->index();
            $table->enum('status', ['active', 'blocked']);
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
        Schema::dropIfExists('users');
    }
}
