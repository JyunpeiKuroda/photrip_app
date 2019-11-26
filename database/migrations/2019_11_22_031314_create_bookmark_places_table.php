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
        // Schema::create('bookmark_places', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->bigIncrements('main_bookmark_id')->unsigned();
            // $table->string('place');
            // $table->string('place_detail')->nullable();
            // $table->timestamps();

            // $table->foreign('main_bookmark_id')
            //       ->references('id')
            //       ->on('main_bookmarks');
        // });
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
