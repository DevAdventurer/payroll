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
        Schema::create('temp_companydetails', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('type');
            $table->string('owner_name');
            $table->string('contact_no');
            $table->string('city'); // Storing city as a string (name)
            $table->string('distt'); // Storing district as a string (name)
            $table->string('state'); // Storing state as a string (name)
            $table->text('address');
            $table->string('gst_no')->unique();
            $table->string('pan_no')->unique();
            $table->string('aadhar_no')->unique();
            $table->string('udyam_no')->nullable();
            $table->string('cin_no')->nullable();
            $table->string('epf_no')->nullable();
            $table->string('esic_no')->nullable();
            $table->string('bank_name');
            $table->string('ac_no');
            $table->string('ifs_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_companydetails');
    }
};
