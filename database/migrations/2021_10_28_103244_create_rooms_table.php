<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug',255)->charset('utf8')->index()->nullable();
            $table->text('content')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('hotel_id')->nullable();
            $table->text('image')->nullable();
            $table->string('video')->nullable();
            $table->text('address')->nullable();
            $table->double('price');
            $table->Integer('number');
            $table->Integer('bed');
            $table->decimal('size');
            $table->Integer('child');
            $table->Integer('adult');


            $table->integer('country_id')->nullable();
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->string('star_rate')->nullable();
            $table->tinyInteger('availability')->default(1);

            $table->tinyInteger('status')->default(1);
            $table->softDeletes();

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
        Schema::dropIfExists('rooms');
    }
}
