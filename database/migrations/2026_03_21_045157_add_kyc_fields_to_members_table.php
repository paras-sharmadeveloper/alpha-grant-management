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
        Schema::table('members', function (Blueprint $table) {
            // null = not started, 'pending' = session created, 'approved' = verified, 'declined' = failed
            $table->string('kyc_status', 20)->nullable()->after('photo');
            $table->string('kyc_session_id', 191)->nullable()->after('kyc_status');
            $table->timestamp('kyc_verified_at')->nullable()->after('kyc_session_id');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['kyc_status', 'kyc_session_id', 'kyc_verified_at']);
        });
    }
};
