<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = "branches";
    protected $fillable = [
        'name',
        'phone',
        'email',
        'division',
        'district',
        'address',
        'created_by',
        'status',
    ];

    //------------------- user ------------------//
    public function user(){
        return $this->belongsTo(User::class);
    }
}
