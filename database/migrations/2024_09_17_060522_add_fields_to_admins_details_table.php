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
            $table->string('father_or_husband_name')->after('address');
        $table->date('date_of_joining')->nullable()->after('father_or_husband_name');
        $table->date('date_of_relieving')->nullable()->after('date_of_joining');
        $table->string('location')->nullable()->after('date_of_relieving');
        $table->string('nationality')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_details', function (Blueprint $table) {
            $table->dropColumn([
                'father_or_husband_name',
                'date_of_joining',
                'date_of_relieving',
                'location',
                'nationality'
            ]);
        });
    }
};
