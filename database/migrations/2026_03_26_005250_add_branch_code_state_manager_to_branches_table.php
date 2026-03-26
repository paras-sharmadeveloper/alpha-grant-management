<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->string('branch_code')->nullable()->after('name');
            $table->string('state')->nullable()->after('branch_code');
            $table->unsignedBigInteger('branch_manager_id')->nullable()->after('state');
        });
    }

    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['branch_code', 'state', 'branch_manager_id']);
        });
    }
};
