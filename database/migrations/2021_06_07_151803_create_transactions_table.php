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
            $table->string('title')
                ->comment('Transaction title for identification');

            $table->decimal('amount', 12)
                ->comment('Transaction amount up to two decimal places');

            $table->enum('type', ['income', 'expense'])
                ->comment('Transaction type for filtering on');

            $table->foreignId('author_id')
                ->comment('References the User ID.')
                ->constrained('users');

            $table->softDeletes();

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
