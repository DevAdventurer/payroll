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
        Schema::table('admins', function (Blueprint $table) {
            Schema::table('admins', function (Blueprint $table) {
                // Adding company_id as an unsignedBigInteger and referencing id from the same table
                $table->unsignedBigInteger('company_id')->nullable()->after('id');
    
                // Adding the self-referencing foreign key
                $table->foreign('company_id')
                      ->references('id')
                      ->on('admins')
                      ->onDelete('set null')
                      ->onUpdate('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
