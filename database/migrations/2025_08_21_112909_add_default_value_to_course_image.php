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
        // Update existing NULL values first
        DB::table('courses')
            ->whereNull('course_image')
            ->update(['course_image' => 'course_1.jpg']);
        
        // Modify the column to add default value
        Schema::table('courses', function (Blueprint $table) {
            $table->text('course_image')
                  ->default('course_1.jpg')
                  ->nullable()
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('course_image')
                  ->default(null)
                  ->nullable()
                  ->change();
        });
        
        // Revert existing values that were updated
        DB::table('courses')
            ->where('course_image', 'course_1.jpg')
            ->update(['course_image' => null]);
    }
};
