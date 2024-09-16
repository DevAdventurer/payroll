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
            $table->string('type')->after('dob')->nullable();
            $table->string('owner_name')->after('type')->nullable();
            $table->string('city')->after('owner_name')->nullable();
            $table->string('distt')->after('city')->nullable();
            $table->string('state')->after('distt')->nullable();
            $table->string('gst_no')->after('state')->nullable()->unique(); // Unique constraint
            $table->string('pan_no')->after('gst_no')->nullable()->unique(); // Unique constraint
            $table->string('aadhar_no')->after('pan_no')->nullable()->unique(); // Unique constraint
            $table->string('udyam_no')->after('aadhar_no')->nullable();
            $table->string('cin_no')->after('udyam_no')->nullable();
            $table->string('epf_no')->after('cin_no')->nullable();
            $table->string('esic_no')->after('epf_no')->nullable();
            $table->string('bank_name')->after('esic_no')->nullable();
            $table->string('ac_no')->after('bank_name')->nullable();
            $table->string('ifs_code')->after('ac_no')->nullable();
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
