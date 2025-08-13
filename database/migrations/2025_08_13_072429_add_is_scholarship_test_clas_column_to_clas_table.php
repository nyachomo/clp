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
        Schema::table('clas', function (Blueprint $table) {
            //
            $table->longText('is_scholarship_test_clas')->default('No')->after('clas_status');
            $table->longText('scholarship_test_category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clas', function (Blueprint $table) {
            //
            $table->dropColumn('is_scholarship_test_clas');
        });
    }
};
