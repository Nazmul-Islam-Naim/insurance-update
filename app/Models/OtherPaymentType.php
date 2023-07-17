<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymentType extends Model
{
    use HasFactory;

    protected $table = "other_payment_types";
    protected $fillable = [
    	'name', 'status', 'branch_id'
    ];
}