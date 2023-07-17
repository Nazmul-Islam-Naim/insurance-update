<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitBy extends Model
{
    use HasFactory;
    protected $table = "transit_bies";
    protected $fillable = [
        'name',
        'slug',
        'voyage_via_id',
        'stamp_amount',
        'branch_id',
        'created_by'
    ];

    //------------------- voyage via -------------------//
    public function voyageVia(){
        return $this->belongsTo(VoyageVia::class);
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
