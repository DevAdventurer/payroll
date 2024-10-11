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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // Foreign key to users table
            $table->unsignedBigInteger('user_id');
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Clock-in and clock-out times
            $table->timestamp('clock_in_time')->nullable();
            $table->timestamp('clock_out_time')->nullable();
            // Status: 'on_time', 'late', 'absent'
            $table->enum('status', ['on_time', 'late', 'absent'])->default('absent');
            // Reason for being late
            $table->text('reason')->nullable();
            // IP address from where attendance was marked
            $table->ipAddress('ip_address')->nullable();
            // Duration of attendance (calculated)
            $table->time('duration')->nullable();
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
