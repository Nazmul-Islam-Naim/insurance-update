<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountInfoFireInsurance extends Model
{
    use HasFactory;
    protected $table = "account_info_fire_insurances";
    protected $fillable = [
        'fire_insurance_id',
        'amount_in_bdt',
        'extra_percent',
        'extra_percent_amount',
        'discount_percent',
        'discount_amount',
        'net_premium',
        'vat_percent',
        'vat_amount',
        'grand_total',
        'payment_percent',
        'payment',
        'collected_amount',
        'due',
        'branch_id',
        'created_by'
    ];


    //----------------------- currency ----------------//
    public function currency(){
        return $this->hasOne('App\Models\Currency','slug','currecy_id');
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
