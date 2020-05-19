<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieTurnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_turn', function (Blueprint $table) {
            $table->primary(['movie_id', 'turn_id']); 	
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('turn_id');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('turn_id')->references('id')->on('turns');
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
        Schema::dropIfExists('movie_turn');
    }
}
