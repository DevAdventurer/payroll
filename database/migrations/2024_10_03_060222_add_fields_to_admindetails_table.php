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
        Schema::table('admin_details', function (Blueprint $table) {
            $table->string('designation', 255);
            $table->decimal('basic', 10, 2);
            $table->decimal('pf_basic', 10, 2);
            $table->decimal('hra', 10, 2);
            $table->decimal('allowance', 10, 2);
            $table->decimal('lwf', 10, 2);
            
            // Deduction as enum
            $table->enum('deduction', ['PF', 'ESI', 'PF+ESI', 'PDST', 'NONE'])->default('NONE');

            $table->string('conveyance', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_details', function (Blueprint $table) {
            //
        });
    }
};
