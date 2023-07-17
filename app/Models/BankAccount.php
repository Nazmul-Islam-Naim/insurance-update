<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $table = "bank_accounts";
    protected $fillable = [
    	'bank_name', 'account_name', 'account_no', 'account_type', 'bank_branch', 'balance', 'opening_date', 'status', 'branch_id', 'created_by'
    ];

    public function bankaccount_accounttype_object()
    {
        return $this->hasOne('App\Models\AccountType', 'id', 'account_type');

    }

        // scop

        public static function scopeCheckBranch($query)
        {
            $getUser = Auth::user();
            if ($getUser->role->slug != 'admin') {
                $query->where('branch_id', $getUser->branch_id);
            }
        }
}