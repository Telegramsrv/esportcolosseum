<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->integer('coins')->unsigned();
            $table->enum('game_type', ['solo', 'team']);
            $table->enum('challenge_type', ['captain-pick', 'team']);
            $table->enum('is_accepted', ['no', 'yes']);
            $table->enum('challenge_status', ['created', 'accepted', 'cancelled', 'completed']);
            $table->timestamp('valid_upto');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
