<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountInformationMarinInsurance extends Model
{
    use HasFactory;
    protected $table = "account_information_marin_insurances";
    protected $fillable = [
        'marine_cargo_insurance_id',
        'amount_in_dollar',
        'extra_percent',
        'extra_percent_amount',
        'currency_id',
        'rate',
        'amount_in_bdt',
        'premium_percent',
        'premium',
        'discount_percent',
        'discount_amount',
        'net_premium',
        'vat_percent',
        'vat_amount',
        'stamp_duty',
        'grand_total',
        'payment_percent',
        'payment_percent_amount',
        'payment',
        'collected_amount',
        'due',
        'branch_id',
        'created_by'
    ];


    //----------------------- currency ----------------//
    public function currency(){
        return $this->belongsTo(Currency::class);
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
