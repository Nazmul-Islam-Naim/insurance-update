<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInsured extends Model
{
    use HasFactory;
    protected $table = "client_insureds";
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'life_stage',
        'owner',
        'branch_id',
        'created_by'
    ];

    //---------------------- owner ---------------//
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner');
    }

    //---------------------- branch ---------------//
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    //---------------------- created by ---------------//
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
