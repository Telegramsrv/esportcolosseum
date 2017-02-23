<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEscChallengeFieldsToChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->integer('esc_challenge_template_id')->unsigned()->nullable()->after('region_id');
            $table->integer('win_coins')->unsigned()->nullable()->after('coins');

            $table->foreign('esc_challenge_template_id')
                ->references('id')
                ->on('esc_challenge_template')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenges', function (Blueprint $table) {
             $table->dropColumn(['esc_challenge_template_id', 'win_coins']);
        });
    }
}
