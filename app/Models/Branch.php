<?php

namespace App\Models;

use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
    use MultiTenant;

    protected $table = 'branches';

    protected $guarded = [];  // allow all columns

    public function manager() {
        return $this->belongsTo(User::class, 'branch_manager_id')->withDefault();
    }

    public function members() {
        return $this->hasMany(Member::class, 'branch_id');
    }

    public function activeLoans() {
        return $this->hasManyThrough(Loan::class, Member::class, 'branch_id', 'borrower_id')
            ->where('loans.status', 'Active');
    }
}
