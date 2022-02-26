<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_searches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('city')->nullable();
            $table->string('type')->nullable();
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('date')->nullable();
            $table->string('children')->nullable();
            $table->string('adult')->nullable();
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
        Schema::dropIfExists('saved_searches');
    }
}
