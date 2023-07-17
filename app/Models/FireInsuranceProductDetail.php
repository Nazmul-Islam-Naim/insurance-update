<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireInsuranceProductDetail extends Model
{
    use HasFactory;
    protected $table = "fire_insurance_product_details";
    protected $fillable = [
        'fire_insurance_id',
        'product_id',
        'product_amount',
        's_per',
        'product_rate',
        'branch_id',
        'created_by'
    ];

    //---------------------- insurance ---------------//
    public function insurance()
    {
        return $this->belongsTo(FireInsurance::class);
    }

    //---------------------- perils ---------------//
    public function perils()
    {
        return $this->belongsTo(AdditionalPerils::class);
    }

    //---------------------- branch ---------------//
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    //---------------------- creator ---------------//
    public function user()
    {
        return $this->hasOne('App\Models\User','id','created_by');
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
