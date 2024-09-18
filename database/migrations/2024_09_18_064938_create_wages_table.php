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
        Schema::create('wages', function (Blueprint $table) {
            
                $table->id();
                $table->enum('skill_level', ['UNSKILLED', 'SEMI-SKILLED', 'SKILLED']);
                $table->decimal('amount', 8, 2); // wage amount
                $table->boolean('is_active')->default(true); // status
                $table->timestamps(); // created_at, updated_at
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wages');
    }
};
