<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarineCargoInsurance extends Model
{
    use HasFactory;
    protected $table = "marine_cargo_insurances";
    protected $fillable = [
        'insurance_code',
        'client_id',
        'bank_id',
        'interest_covered_id',
        'voyage_from_id',
        'voyage_to_id',
        'voyage_via_id',
        'transit_by_id',
        'period_from',
        'period_to',
        'amount_in_dollar',
        'extra_percent',
        'currency_id',
        'rate',
        'amount_in_bdt',
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

    //---------------------- interest covered object ---------------------//
    public function interestCovered(){
        return $this->belongsTo(Product::class);
    }

    //---------------------- voyage from object ---------------------//
    public function voyageFrom(){
        return $this->belongsTo(VoyageFrom::class);
    }

    //---------------------- voyage to object ---------------------//
    public function voyageTo(){
        return $this->belongsTo(VoyageTo::class);
    }

    //---------------------- voyage via object ---------------------//
    public function voyageVia(){
        return $this->belongsTo(VoyageVia::class);
    }

    //---------------------- transit by object ---------------------//
    public function transitBy(){
        return $this->belongsTo(TransitBy::class);
    }

    
     //----------------------- currency ----------------//
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    
     //----------------------- branch ----------------//
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    //------------------- create account iformation table -------------------//
    public function accountInfoMarinInsurance()
    {
        return $this->hasOne(AccountInformationMarinInsurance::class);
    }

    //------------------- create marine perils table -------------------//
    public function marineAdditionalPerilsDetail()
    {
        return $this->hasMany(MarineAdditionalPerilsDetail::class);
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

        $getLastRecord = MarineCargoInsurance::orderBy('id','desc')->first();

        if (!empty($getLastRecord)) {
            $getLastCode = $getLastRecord->insurance_code;
            $getLastYear = substr($getLastCode,2,4);
            $getLastValue = substr($getLastCode,6);
    
            if ($currentYear > $getLastYear ) {
                return  'M-' . $currentYear . '1';
            } else {
                $getLastValue ++;
                return  'M-' . $getLastYear . $getLastValue;
            }
        } else {
            return  'M-' . $currentYear . '1';
        }
    }
}
