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
        Schema::create('dv_inventory_unprocessed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_no')->nullable();
            $table->foreign('transaction_no')->references('transaction_no')->on('budget')->onDelete('cascade');
            $table->string('program')->nullable();
            $table->integer('no_of_unprocessed_dv')->nullable();
            $table->decimal('total_amount_unprocessed', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dv_inventory_unprocessed');
    }
};
