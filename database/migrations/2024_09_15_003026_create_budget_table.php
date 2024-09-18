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
        Schema::create('budget', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_no', 6)->primary();
            $table->string('drn_no')->unique()->nullable();
            $table->date('incomingDate')->nullable(); 
            $table->string('payee', 150)->nullable(); 
            $table->string('particulars', 250)->nullable();  
            $table->string('program', 30)->nullable(); 
            $table->string('budget_controller', 75)->nullable(); 
            $table->decimal('gross_amount', 15, 2)->nullable(); 
            $table->decimal('final_amount_norsa', 15, 2)->nullable();
            $table->string('fund_cluster', 50)->nullable(); 
            $table->string('appropriation', 50)->nullable(); 
            $table->string('remarks', 250)->nullable()->nullable(); 
            $table->string('orsNum', 50)->nullable();
            $table->date('outgoingDate')->nullable();
            $table->string('status', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget');
    }
};
