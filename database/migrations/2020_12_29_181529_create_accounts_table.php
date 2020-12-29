<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->string('plaid_account_id');
            $table->string('name');
            $table->string('mask');
            $table->string('official_name');
            $table->double('current_balance');
            $table->double('available_balance');
            $table->string('iso_currency_code');
            $table->string('unofficial_currency_code');
            $table->string('type');
            $table->string('subtype');
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
        Schema::dropIfExists('accounts');
    }
}
