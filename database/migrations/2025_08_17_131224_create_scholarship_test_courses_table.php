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
        Schema::create('scholarship_test_courses', function (Blueprint $table) {
            $table->id();
            $table->longText('course_code')->nullable();
            $table->longText('course_name')->nullable();
            $table->longText('course_duration')->nullable();
            $table->longText('course_fee')->nullable();
            $table->longText('course_scholarship_amount')->nullable();
            $table->longText('course_subsidized_fee')->nullable();
            $table->longText('course_monthly_installment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_test_courses');
    }
};
