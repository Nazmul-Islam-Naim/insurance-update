<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTitle extends Model
{
    use HasFactory;
    protected $table = "payment_titles";
    protected $fillable = ['title','branch_id','created_by'];

    //relation

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
