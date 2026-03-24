<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('loans', function (Blueprint $table) {
            // Section 1 — Applicant basics
            $table->string('enq_full_name')->nullable()->after('remarks');
            $table->string('enq_mobile')->nullable()->after('enq_full_name');
            $table->string('enq_email')->nullable()->after('enq_mobile');
            $table->string('enq_business_name')->nullable()->after('enq_email');
            $table->boolean('enq_gst_registered')->nullable()->after('enq_business_name');
            $table->string('enq_years_operating')->nullable()->after('enq_gst_registered');
            $table->string('enq_abn_acn')->nullable()->after('enq_years_operating');

            // Section 2 — Loan snapshot
            $table->string('enq_loan_purpose')->nullable()->after('enq_abn_acn');
            $table->string('enq_time_in_business')->nullable()->after('enq_loan_purpose');
            $table->string('enq_monthly_revenue')->nullable()->after('enq_time_in_business');

            // Section 3 — Risk indicators
            $table->boolean('enq_ato_debt')->nullable()->after('enq_monthly_revenue');
            $table->boolean('enq_defaults')->nullable()->after('enq_ato_debt');
            $table->boolean('enq_existing_loans')->nullable()->after('enq_defaults');

            // Section 4 — Security
            $table->string('enq_security_type')->nullable()->after('enq_existing_loans'); // secured/unsecured
            $table->string('enq_asset_type')->nullable()->after('enq_security_type');

            // Section 5 — Progress qualifier
            $table->date('enq_funds_needed_by')->nullable()->after('enq_asset_type');
            $table->string('enq_best_contact_time')->nullable()->after('enq_funds_needed_by');

            // Section 6 — Consent
            $table->boolean('enq_consent')->default(false)->after('enq_best_contact_time');
        });
    }

    public function down(): void {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn([
                'enq_full_name', 'enq_mobile', 'enq_email', 'enq_business_name',
                'enq_gst_registered', 'enq_years_operating', 'enq_abn_acn',
                'enq_loan_purpose', 'enq_time_in_business', 'enq_monthly_revenue',
                'enq_ato_debt', 'enq_defaults', 'enq_existing_loans',
                'enq_security_type', 'enq_asset_type',
                'enq_funds_needed_by', 'enq_best_contact_time', 'enq_consent',
            ]);
        });
    }
};
