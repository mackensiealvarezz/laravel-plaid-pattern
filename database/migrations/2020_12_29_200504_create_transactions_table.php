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
            $table->string('plaid_category_id')->nullable();
            $table->string('category')->nullable();
            $table->string('subcategory')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->double('amount')->nullable();
            $table->string('iso_currency_code')->nullable();
            $table->string('unofficial_currency_code')->nullable();
            $table->date('date')->nullable();
            $table->boolean('pending')->nullable();
            $table->string('account_owner')->nullable();
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
