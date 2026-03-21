<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kyc_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->string('type'); // id_verification | poa | passive_liveness | face_search | age_estimation
            $table->string('verification_request_id')->nullable(); // Didit's returned session/request ID
            $table->string('status')->nullable();                  // Approved | Declined | Review | etc.
            $table->string('decision')->nullable();                // top-level decision field if present
            $table->json('response_data')->nullable();             // full raw JSON response from Didit
            $table->string('vendor_data')->nullable();             // what we sent as vendor_data
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kyc_verifications');
    }
};
