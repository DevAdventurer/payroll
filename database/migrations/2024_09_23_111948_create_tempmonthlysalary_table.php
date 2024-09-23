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
        Schema::create('tempmonthlysalary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedInteger('month'); // Store month as an integer (1-12)
            $table->unsignedInteger('year');  // Store year as a four-digit integer
            $table->unsignedInteger('working_days');
            $table->decimal('basic', 10, 2)->default(0); // Basic salary
            $table->decimal('pf_basic', 10, 2)->default(0); // PF Basic
            $table->decimal('hra', 10, 2)->default(0); // HRA
            $table->decimal('conveyance', 10, 2)->default(0); // Conveyance
            $table->decimal('other_allowance', 10, 2)->default(0); // Other Allowance
            $table->decimal('basic_amount', 10, 2)->default(0); // Calculated Basic amount based on working days
            $table->decimal('pf_basic_amount', 10, 2)->default(0); // Calculated PF Basic amount based on working days
            $table->decimal('hra_amount', 10, 2)->default(0); // Calculated HRA amount based on working days
            $table->decimal('conveyance_amount', 10, 2)->default(0); // Calculated Conveyance amount based on working days
            $table->decimal('other_allowance_amount', 10, 2)->default(0); // Calculated Other Allowance amount
            $table->decimal('total_amount', 10, 2)->default(0); // Total salary
            $table->decimal('epf_employee', 10, 2)->default(0); // EPF Amount (Employee)
            $table->decimal('epf_employer', 10, 2)->default(0); // EPF Amount (Employer)
            $table->decimal('eps_employer', 10, 2)->default(0); // EPS Amount (Employer)
            $table->decimal('esi_employee', 10, 2)->default(0); // ESI Amount (Employee)
            $table->decimal('esi_employer', 10, 2)->default(0); // ESI Amount (Employer)
            $table->decimal('advance', 10, 2)->default(0); // Advance payment deduction
            $table->decimal('total_deductions', 10, 2)->default(0); // Total Deductions
            $table->decimal('net_payable', 10, 2)->default(0); // Net Payable salary after deductions
            $table->timestamps();

            // Foreign key linking to the 'admins' table (optional: if you need a foreign key constraint)
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempmonthlysalary');
    }
};
