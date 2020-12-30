<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->string('plaid_transaction_id');
            $table->string('plaid_category_id');
            $table->string('category');
            $table->string('subcategory');
            $table->string('type');
            $table->string('name');
            $table->double('amount');
            $table->string('iso_currency_code');
            $table->string('unofficial_currency_code');
            $table->date('date');
            $table->boolean('pending');
            $table->string('account_owner');
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
        Schema::dropIfExists('transactions');
    }
}
