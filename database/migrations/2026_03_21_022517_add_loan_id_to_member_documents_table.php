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
        Schema::table('member_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('loan_id')->nullable()->after('member_id');
        });
    }

    public function down(): void
    {
        Schema::table('member_documents', function (Blueprint $table) {
            $table->dropColumn('loan_id');
        });
    }
};
