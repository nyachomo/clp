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
        Schema::table('practicalanswers', function (Blueprint $table) {
            $table->longText('comment')->nullable()->after('student_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practicalanswers', function (Blueprint $table) {
            $table->dropColumn('comment');
        });
    }
};
