<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KycVerification extends Model
{
    protected $fillable = [
        'member_id', 'loan_id', 'type',
        'verification_request_id', 'status', 'decision',
        'response_data', 'vendor_data',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
