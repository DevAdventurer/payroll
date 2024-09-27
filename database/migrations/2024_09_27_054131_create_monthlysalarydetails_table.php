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
        Schema::create('monthlysalarydetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Foreign key to the Admins table
           
            $table->string('year');
            $table->string('month');
            $table->integer('working_days');
            
            // Salary components
            $table->decimal('basic', 10, 2);
            $table->decimal('pf_basic', 10, 2);
            $table->decimal('hra', 10, 2);
            $table->decimal('conveyance', 10, 2);
            $table->decimal('other_allowance', 10, 2);

            // Amounts
            $table->decimal('basic_amount', 10, 2);
            $table->decimal('pf_basic_amount', 10, 2);
            $table->decimal('hra_amount', 10, 2);
            $table->decimal('conveyance_amount', 10, 2);
            $table->decimal('other_allowance_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);

            // Deductions
            $table->decimal('epf_employee', 10, 2);
            $table->decimal('epf_employer', 10, 2);
            $table->decimal('eps_employer', 10, 2);
            $table->decimal('esi_employee', 10, 2);
            $table->decimal('esi_employer', 10, 2);
            $table->decimal('psdt_amount', 10, 2);
            $table->decimal('tds_amount', 10, 2);
            $table->decimal('lwf_employer', 10, 2);
            $table->decimal('lwf_employee', 10, 2);
            $table->decimal('other_if_any', 10, 2)->nullable();

            // Additional fields
            $table->decimal('total_deductions', 10, 2);
            $table->decimal('net_payable', 10, 2);
            $table->decimal('advance', 10, 2)->nullable();

            $table->timestamps(); // Created at & Updated at

            // Indexes and foreign keys
            $table->foreign('employee_id')->references('id')->on('admins')->onDelete('cascade'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthlysalarydetails');
    }
};
