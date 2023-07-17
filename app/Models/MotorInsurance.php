<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorInsurance extends Model
{
    use HasFactory;
    protected $table = "motor_insurances";
    protected $fillable = [
        'insurance_code',
        'client_id',
        'bank_id',
        'tarrif_calculation_id',
        'reg_no',
        'engine_no',
        'chassis_no',
        'model_no',
        'period_from',
        'period_to',
        'declaration',
        'risk_option',
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
    
    //---------------------- tarrif calculation object ---------------------//
    public function tarrifCalculation(){
        return $this->belongsTo(TarrifCalculation::class);
    }


    //------------------- create account iformation table -------------------//
    public function accountInfoMotorInsurance()
    {
        return $this->hasOne(AccountInfoMotorInsurance::class);
    }

    //------------------- create fire perils table -------------------//
    public function motorAdditionalPerilsDetail()
    {
        return $this->hasMany(MotorAdditionalPerilsDetail::class);
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

        $getLastRecord = MotorInsurance::orderBy('id','desc')->first();

        if (!empty($getLastRecord)) {
            $getLastCode = $getLastRecord->insurance_code;
            $getLastYear = substr($getLastCode,2,4);
            $getLastValue = substr($getLastCode,6);
    
            if ($currentYear > $getLastYear ) {
                return  'V-' . $currentYear . '1';
            } else {
                $getLastValue ++;
                return  'V-' . $getLastYear . $getLastValue;
            }
        } else {
            return  'V-' . $currentYear . '1';
        }
    }
}
