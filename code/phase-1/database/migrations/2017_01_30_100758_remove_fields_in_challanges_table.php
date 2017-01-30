<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldsInChallangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropColumn(['name', 'challenge_type']);
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
            $table->enum('name', ['open', 'esc'])->after('region_id');
            $table->enum('challenge_type', ['captain-pick', 'team'])->after('game_type');
        });
    }
}
