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
        Schema::create('dv_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('program')->nullable();
            $table->integer('no_of_dv')->nullable();
            $table->decimal('total_amount_program')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dv_inventory');
    }
};
