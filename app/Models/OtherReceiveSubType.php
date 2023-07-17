<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherReceiveSubType extends Model
{
    use HasFactory;

    protected $table = "other_receive_sub_types";
    protected $fillable = [
    	'receive_type_id', 'name', 'status', 'branch_id'
    ];

    public function receivesubtype_type_object()
    {
        return $this->hasOne('App\Models\OtherReceiveType', 'id', 'receive_type_id');
    }
}

