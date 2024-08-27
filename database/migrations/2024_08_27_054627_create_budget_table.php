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
            $table->id();
            $table->string('dvNum', 10); // DV No. with a max length of 10 characters
            $table->string('accountID', 20); // Account ID with a max length of 20 characters
            $table->integer('programID'); // Program ID as an integer
            $table->integer('controllerID'); // Controller ID as an integer
            $table->string('drnNum', 100); // DRN No. with a max length of 100 characters
            $table->date('incomingDate'); // Incoming Date as a date
            $table->string('payee', 150); // Payee with a max length of 150 characters
            $table->string('particulars', 250); // Particulars with a max length of 250 characters
            $table->string('etal', 250)->nullable(); // Etal with a max length of 250 characters, nullable
            $table->string('program', 30); // Program with a max length of 30 characters
            $table->string('controller', 75); // Controller with a max length of 75 characters
            $table->decimal('gross_amount', 15, 2); // Gross Amount as a decimal with precision 15 and scale 2
            $table->decimal('final_amount_norsa', 15, 2); // Final Amount NORSA as a decimal with precision 15 and scale 2
            $table->string('fund_cluster', 50); // Fund Cluster with a max length of 50 characters
            $table->string('appropriation', 50); // Appropriation with a max length of 50 characters
            $table->string('remarks', 250)->nullable(); // Remarks with a max length of 250 characters, nullable
            $table->string('orsNum', 50); // ORS No. with a max length of 50 characters
            $table->date('outgoingDate'); // Outgoing Date as a date
            $table->string('status', 50); // Status with a max length of 50 characters
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
