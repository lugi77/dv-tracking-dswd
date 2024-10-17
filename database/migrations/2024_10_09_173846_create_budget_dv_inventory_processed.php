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
        Schema::create('budget_dv_inventory_processed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_no')->nullable();
            $table->foreign('transaction_no')->references('transaction_no')->on('budget')->onDelete('cascade');
            $table->string('program', 20)->nullable();
            $table->integer('no_of_processed_dv')->nullable();
            $table->decimal('total_amount_processed', 15, 2)->nullable(); // 15 total digits, 2 decimal places
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_dv_inventory_processed');
    }
};
