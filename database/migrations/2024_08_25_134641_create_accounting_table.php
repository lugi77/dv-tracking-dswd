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
            $table->date('date_received')->nullable();
            $table->integer('dv_no')->nullable();
            $table->integer('dv_no2')->nullable();
            $table->string('ap_no')->nullable();
            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('other_deduction', 15, 2)->nullable();
            $table->decimal('net_amount', 15, 2)->nullable();
            $table->decimal('final_gross_amount', 15, 2)->nullable();
            $table->decimal('final_net_amount', 15, 2)->nullable();
            $table->string('program_unit')->nullable();
            $table->date('date_returned_to_end_user')->nullable();
            $table->date('date_complied_to_end_user')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->string('outgoing_processor')->nullable();
            $table->string('outgoing_certifier')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('accounting');
    }
};
