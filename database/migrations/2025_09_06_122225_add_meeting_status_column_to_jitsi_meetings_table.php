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
        Schema::table('jitsi_meetings', function (Blueprint $table) {
            //
            $table->longText('meeting_status')->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jitsi_meetings', function (Blueprint $table) {
            //
            $table->dropColumn('meeting_status');
        });
    }
};
