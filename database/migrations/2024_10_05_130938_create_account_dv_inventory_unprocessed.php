<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_dv_inventory_unprocessed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_no')->nullable();
            $table->string('payee', 30)->nullable();
            $table->integer('no_unprocessed_account_dv')->nullable();
            $table->decimal('total_unprocessed_account_dv', 15, 2)->nullable();

            $table->foreign('transaction_no')->references('transaction_no')->on('budget')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_dv_inventory_unprocessed');
    }
};
