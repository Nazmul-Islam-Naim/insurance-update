<?php

namespace App\Models;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $table = 'commissions';
    protected $fillable = [
        'insurance_id',
        'client_id',
        'bank_id',
        'payment_method',
        'insurance_type',
        'date',
        'note',
        'insured_amount',
        'total_percent',
        'total_amount',
        'branch_id',
        'created_by'
    ];
    
    //relation

    public function client(){
        return $this->belongsTo(ClientInsured::class);
    }

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    public function paymentAccount(){
        return $this->hasOne('App\Models\BankAccount','id','payment_method');
    }

    public function commissionDetails(){
        return $this->hasMany(CommissionDetails::class);
    }
    

    public function branch(){
        return $this->BelongsTo(Branch::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
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
