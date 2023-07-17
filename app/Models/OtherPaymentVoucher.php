<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymentVoucher extends Model
{
    use HasFactory;

    protected $table = "other_payment_vouchers";
    protected $fillable = [
        'payment_type_id', 'payment_sub_type_id', 'bank_id', 'payment_for', 'amount', 'payment_date', 'issue_by', 'note', 'status', 'created_by', 'tok', 'branch_id'
    ];

    public function otherpayment_bank_object()
    {
        return $this->hasOne('App\Models\BankAccount', 'id', 'bank_id');
    }
    public function otherpayment_type_object()
    {
        return $this->hasOne('App\Models\OtherPaymentType', 'id', 'payment_type_id');
    }
    public function otherpayment_subtype_object()
    {
        return $this->hasOne('App\Models\OtherPaymentSubType', 'id', 'payment_sub_type_id');
    }
    public function otherpayment_user_object()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
