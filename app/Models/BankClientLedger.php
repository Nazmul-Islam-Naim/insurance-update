<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankClientLedger extends Model
{
    use HasFactory;
    
    protected $table = "bank_client_ledgers";
    protected $fillable = [
    	'client_id', 
        'bank_id',
        'creator_id',
        'insurance_id',
        'insurance_type',
        'reason',
        'amount',
        'date',
        'branch_id',
        'created_by',
    ];

    //------------------------- client -----------------//
    public function client()
    {
        return $this->belongsTo(ClientInsured::class);
    }

    //------------------------- bank -----------------//
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    //------------------------- creator -----------------//
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

}
