<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OtherReceiveVoucher extends Model
{
    use HasFactory;

    protected $table = "other_receive_vouchers";
    protected $fillable = [
        'receive_type_id', 'receive_sub_type_id', 'bank_id', 'receive_from', 'amount', 'receive_date', 'issue_by', 'note', 'status', 'branch_id', 'created_by', 'tok'
    ];

    public function otherreceive_bank_object()
    {
        return $this->hasOne('App\Models\BankAccount', 'id', 'bank_id');
    }
    public function otherreceive_type_object()
    {
        return $this->hasOne('App\Models\OtherReceiveType', 'id', 'receive_type_id');
    }
    public function otherreceive_subtype_object()
    {
        return $this->hasOne('App\Models\OtherReceiveSubType', 'id', 'receive_sub_type_id');
    }
    public function otherreceive_user_object()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
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


