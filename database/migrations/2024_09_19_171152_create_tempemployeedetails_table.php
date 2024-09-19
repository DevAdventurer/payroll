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
        Schema::create('tempemployeedetails', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('father_or_husband_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('aadhar_no')->unique();
            $table->string('mobile', 15)->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('esic_no')->nullable();
            $table->string('pf_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->date('date_of_relieving')->nullable();
            $table->string('location')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('designation')->nullable();
            $table->decimal('basic', 10, 2)->nullable();
            $table->decimal('pf_basic', 10, 2)->nullable();
            $table->decimal('hra', 10, 2)->nullable();
            $table->decimal('allowance', 10, 2)->nullable();
            $table->decimal('lwf', 10, 2)->nullable();
            $table->decimal('deduction', 10, 2)->nullable();
            $table->decimal('conveyance', 10, 2)->nullable();
            $table->string('skill_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempemployeedetails');
    }
};
