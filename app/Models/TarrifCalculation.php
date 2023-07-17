<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarrifCalculation extends Model
{
    use HasFactory;
    protected $table = 'tarrif_calculations';
    protected $fillable = [
        'tarrif_id',
        'basic',
        'act_laibility',
        'per_passenger_fee',
        'passenger',
        'driver_fee',
        'net_amount',
        'vat_percent',
        'branch_id',
        'created_by',
    ];
     //---------------------- branch ---------------//
     public function tarrif()
     {
         return $this->belongsTo(TarrifType::class);
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
