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
            $table->string('join_hash');
            $table->bigInteger('owner_id');
            $table->bigInteger('opponent_id')->nullable();
            $table->bigInteger('turn')->comment('ID of user whose turn is now');
            $table->json('owner_ships')->nullable()->comment('Coordinates of the ships of owner');
            $table->json('opponent_ships')->nullable()->comment('Coordinates of the ships of opponent');
            $table->json('owner_fires')->nullable()->comment('Coordinates where the owner shot');
            $table->json('opponent_fires')->nullable()->comment('Coordinates where the opponent shot');
            $table->json('owner_succeeds')->nullable()->comment('Coordinates where the owner shot and succeed');
            $table->json('opponent_succeeds')->nullable()->comment('Coordinates where the opponent shot and succeed');
            $table->integer('owner_shots')->default(0)->comment('How many times did the owner hit the opponent ships');
            $table->integer('opponent_shots')->default(0)->comment('How many times did the opponent hit the owner ships');
            $table->timestamp('started_at', 0)->nullable()->comment('When does the owner clicked play');
            $table->boolean('ready')->default(0);
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
