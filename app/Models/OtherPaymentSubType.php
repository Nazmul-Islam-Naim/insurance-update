<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymentSubType extends Model
{
    use HasFactory;

    protected $table = "other_payment_sub_types";
    protected $fillable = [
    	'payment_type_id', 'name', 'status', 'branch_id'
    ];

    public function paymentsubtype_type_object()
    {
        return $this->hasOne('App\Models\OtherPaymentType', 'id', 'payment_type_id');
    }
}