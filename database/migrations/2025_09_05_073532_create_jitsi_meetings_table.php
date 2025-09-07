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
        Schema::create('jitsi_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clas_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->longText('meeting_name')->nullable();
            $table->longText('jwt_link')->nullable();
            $table->foreign('clas_id')->references('id')->on('clas')->onDelete('set null');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jitsi_meetings');
    }
};
