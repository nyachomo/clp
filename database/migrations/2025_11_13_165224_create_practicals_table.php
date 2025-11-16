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
        Schema::create('practicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clas_id')->nullable();
            $table->foreign('clas_id')->references('id')->on('clas')->onDelete('cascade');
            $table->longText('name')->nullable();
            $table->longText('question')->nullable();
            $table->longText('marks')->nullable();
            $table->longText('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicals');
    }
};
