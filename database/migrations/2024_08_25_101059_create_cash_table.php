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
            $table->integer('dv_no')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('check_ada_no')->nullable();
            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->decimal('final_net_amount', 15, 2)->nullable();
            $table->date('date_received')->nullable();
            $table->date('date_issued')->nullable();
            $table->string('receipt_no')->nullable();
            $table->text('remarks')->nullable();
            $table->string('payee')->nullable();
            $table->string('particulars')->nullable();
            $table->date('outgoing_date')->nullable();
            $table->string('action')->nullable();
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
