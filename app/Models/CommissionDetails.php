<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionDetails extends Model
{
    use HasFactory;
    protected $table = 'commission_details';
    protected $fillable = [
        'commission_id',
        'payment_title_id',
        'percent',
        'amount'
    ];

    // relationship

    public function commission(){
        return $this->belongsTo(Commission::class);
    }
    public function title(){
        return $this->belongsTo(PaymentTitle::class);
    }
    
}
