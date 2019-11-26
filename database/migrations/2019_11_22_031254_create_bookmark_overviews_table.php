<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarkOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('bookmark_overviews', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->bigIncrements('main_bookmark_id')->unsigned();
            // $table->foreign('main_bookmark_id')->references('id')->on('main_bookmarks');
            // $table->string('overview');
            // $table->string('content');
            // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmark_overviews');
    }
}
