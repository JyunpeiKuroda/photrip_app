<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guide_id');
            $table->string('overview');
            $table->string('content');
            $table->timestamps();

            // $table->foreign('guide_id')->references('id')->on('guides');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overviews');
    }
}
