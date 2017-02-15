<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBankDetailsFromUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn(array('paypal_id', 'account_no', 'account_name', 'account_swift_code'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('paypal_id')->after('winning_coins')->nullable();
        	$table->string('account_no')->after('paypal_id')->nullable();
        	$table->string('account_name')->after('account_no')->nullable();
        	$table->string('account_swift_code')->after('account_name')->nullable();
        });
    }
}
