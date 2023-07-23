<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireInsurance extends Model
{
    use HasFactory;
    protected $table = "fire_insurances";
    protected $fillable = [
        'insurance_code',
        'client_id',
        'bank_id',
        'period_from',
        'period_to',
        'used_as',
        'situation',
        'construction_premises',
        'branch_id',
        'created_by'
    ];

    //---------------------- client object ---------------------//
    public function client(){
        return $this->belongsTo(ClientInsured::class);
    }

    //---------------------- bank object ---------------------//
    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    
    //----------------------- branch ----------------//
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    //------------------- create account iformation table -------------------//
    public function accountInfoFireInsurance()
    {
        return $this->hasOne(AccountInfoFireInsurance::class);
    }
    public function accountInfo()
    {
        return $this->hasOne(AccountInfoFireInsurance::class);
    }

    //------------------- create fire perils table -------------------//
    public function fireAdditionalPerilsDetail()
    {
        return $this->hasMany(FireAdditionalPerilsDetail::class);
    }

    //------------------- create fire product  table -------------------//
    public function fireInsuranceProductDetail()
    {
        return $this->hasMany(FireInsuranceProductDetail::class);
    }

    // morph
    public function insurances(){
        return $this->morphOne(Insurance::class, 'insuranceable');
    }


    // scop

    public static function scopeCheckBranch($query)
    {
        $getUser = Auth::user();
        if ($getUser->role->slug != 'admin') {
            $query->where('branch_id', $getUser->branch_id);
        }
    }

    
    // function
    public static function setInsuranceCode($currentYear){
        $getLastYear = '';

        $getLastRecord = FireInsurance::orderBy('id','desc')->first();

        if (!empty($getLastRecord)) {
            $getLastCode = $getLastRecord->insurance_code;
            $getLastYear = substr($getLastCode,2,4);
            $getLastValue = substr($getLastCode,6);
    
            if ($currentYear > $getLastYear ) {
                return  'F-' . $currentYear . '1';
            } else {
                $getLastValue ++;
                return  'F-' . $getLastYear . $getLastValue;
            }
        } else {
            return  'F-' . $currentYear . '1';
        }
    }
}
