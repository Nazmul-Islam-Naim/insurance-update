<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceRate extends Model
{
    use HasFactory;
    protected $table = 'insurance_rates';
    protected $fillable = [
        'title', 'slug', 'rate'
    ];
}
