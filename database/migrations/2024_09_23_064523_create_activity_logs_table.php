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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('model_type');
            $table->string('model_id');
            $table->string('dv_no')->nullable();
            $table->string('user_name');
            $table->string('dswd_id');
            $table->string('action');
            $table->text('details');
            $table->timestamps();

            // Optional: Add foreign key constraint if you have a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
