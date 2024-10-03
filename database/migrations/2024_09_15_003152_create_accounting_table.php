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
            $table->string('dv_no', 20)->nullable();
            $table->string('ap_no', 20)->nullable();
            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->decimal('tax', 15)->nullable();
            $table->decimal('other_deduction', 15, 2)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->string('program',30)->nullable();
            $table->date('date_returned_to_end_user')->nullable();
            $table->date('date_complied_to_end_user')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->string('outgoing_processor', 30)->nullable();
            $table->string('outgoing_certifier', 30)->nullable();
            $table->text('remarks')->nullable();
            $table->date('outgoing_date')->nullable();
            $table->string('orsNum', 20)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('particulars', 250)->nullable();
            $table->string('payee', 30)->nullable(); 
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
