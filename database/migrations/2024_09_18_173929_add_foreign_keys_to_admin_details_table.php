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
            $table->unsignedBigInteger('city_id')->nullable()->after('city');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');

            // Add state_id column and foreign key constraint
            $table->unsignedBigInteger('state_id')->nullable()->after('state');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');

            // Add district_id column and foreign key constraint
            $table->unsignedBigInteger('district_id')->nullable()->after('distt');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_details', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');

            $table->dropForeign(['state_id']);
            $table->dropColumn('state_id');

            $table->dropForeign(['district_id']);
            $table->dropColumn('district_id');
        });
    }
};
