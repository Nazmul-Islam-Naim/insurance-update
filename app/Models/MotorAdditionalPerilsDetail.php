<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorAdditionalPerilsDetail extends Model
{
    use HasFactory;
    protected $table = "motor_additional_perils_details";
    protected $fillable = [
        'motor_insurance_id',
        'perils_id',
        'amount',
        'premium_rate',
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
