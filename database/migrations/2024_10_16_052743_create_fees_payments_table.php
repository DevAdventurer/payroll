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
        Schema::create('fees_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('month'); // For storing the month as a string (January, February, etc.)
            $table->year('year'); // Storing the year
            $table->decimal('fee_amount', 10, 2); // Fee amount, using decimal to store currency
            $table->enum('payment_type', ['fees', 'payment']); // Payment type (fees or payment)
            $table->timestamps();

            // Setting up the foreign key constraint
            $table->foreign('company_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_payments');
    }
};
