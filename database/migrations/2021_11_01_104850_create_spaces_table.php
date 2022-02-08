<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('slug',255)->charset('utf8')->index()->nullable();
            $table->text('content')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('type_id')->unsigned();
            $table->text('image')->nullable();
            $table->string('video')->nullable();
            $table->text('address')->nullable();
            $table->double('price');
            $table->double('sale_price');
            $table->Integer('number');
            $table->Integer('bed');
            $table->Integer('bathroom');
            $table->Integer('max_guest');
            $table->decimal('size');
            
            $table->integer('country_id')->nullable();
            $table->string('star_rate')->nullable();
            $table->tinyInteger('on_sale')->default(0);
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
        Schema::dropIfExists('spaces');
    }
}
