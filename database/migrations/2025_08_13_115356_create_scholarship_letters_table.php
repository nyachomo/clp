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
        Schema::create('scholarship_letters', function (Blueprint $table) {
            $table->id();
            $table->longText('form_four')->nullable();
            $table->longText('lower_forms')->nullable();
            $table->longText('date')->nullable();
            $table->longText('letter_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_letters');
    }
};
