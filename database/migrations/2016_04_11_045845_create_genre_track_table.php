<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_track', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned();
            $table->integer('track_id')->unsigned();

            $table->foreign('genre_id')->references('id')->on('genres')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('track_id')->references('id')->on('tracks')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['genre_id', 'track_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('genre_track');
    }
}
