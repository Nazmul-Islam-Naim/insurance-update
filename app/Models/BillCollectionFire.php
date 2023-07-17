<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillCollectionFire extends Model
{
    use HasFactory;
    protected $table = 'bill_collection_fires';
    protected $fillable = [
        'insurance_id',
        'amount',
        'collection_type',
        'cheque_number',
        'bank_name',
        'bank_id',
        'date',
        'note',
        'branch_id',
        'created_by',
    ];

    
    public function insurance(){
        return $this->belongsTo(FireInsurance::class);
    }

    public function bank(){
        return $this->belongsTo(BankAccount::class);
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
