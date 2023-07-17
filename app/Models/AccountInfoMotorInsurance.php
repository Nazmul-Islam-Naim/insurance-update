<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountInfoMotorInsurance extends Model
{
    use HasFactory;
    protected $table = "account_info_motor_insurances";
    protected $fillable = [
        'motor_insurance_id',
        'insured_amount',
        'premium_percent',
        'ncb_percent',
        'net_premium',
        'vat_percent',
        'grand_total',
        'payment_percent',
        'payment',
        'collected_amount',
        'due',
        'branch_id',
        'created_by',
    ];


    // scop

    public static function scopeCheckBranch($query)
    {
        $getUser = Auth::user();
        if ($getUser->role->slug != 'admin') {
            $query->where('branch_id', $getUser->branch_id);
        }
    }
}
