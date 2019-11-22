<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarkPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmark_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bookmark_id')->unsigned();
            $table->foreign('bookmark_id')->references('id')->on('main_bookmarks');
            $table->string('place');
            $table->string('place_detail');
            $table->integer('photo_id')->unsigned();
            $table->foreign('photo_id')->references('id')->on('photos');
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
        Schema::dropIfExists('bookmark_places');
    }
}
