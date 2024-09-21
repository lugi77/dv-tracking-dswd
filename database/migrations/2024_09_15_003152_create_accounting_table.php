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
        Schema::create('accounting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_no');
            $table->foreign('transaction_no')->references('transaction_no')->on('budget')->onDelete('cascade');
            $table->date('date_received')->nullable();
            $table->string('dv_no')->nullable();
            $table->string('ap_no')->nullable();
            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->decimal('tax', 15)->nullable();
            $table->decimal('other_deduction', 15)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->string('program')->nullable();
            $table->date('date_returned_to_end_user')->nullable();
            $table->date('date_complied_to_end_user')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->string('outgoing_processor')->nullable();
            $table->string('outgoing_certifier')->nullable();
            $table->text('remarks')->nullable();
            $table->date('outgoing_date')->nullable();
            $table->string('status')->nullable();
            $table->string('payee', 150)->nullable(); 
            $table->string('appropriation', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting');
    }
};
