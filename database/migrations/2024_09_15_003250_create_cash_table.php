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
        Schema::create('cash', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_no');
            $table->foreign('transaction_no')->references('transaction_no')->on('budget')->onDelete('cascade');
            $table->string('dv_no', 20)->nullable();
            $table->string('payment_type', 10)->nullable();
            $table->string('check_ada_no',20)->nullable();
            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->string('program', 30)->nullable();
            $table->date('date_received')->nullable();
            $table->date('date_issued')->nullable();
            $table->string('receipt_no', 20)->nullable();
            $table->text('remarks')->nullable();
            $table->string('payee', 30)->nullable();
            $table->string('orsNum', 20)->nullable();
            $table->string('particulars', 250)->nullable();
            $table->string('appropriation', 50)->nullable();
            $table->date('outgoing_date')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash');
    }
};
