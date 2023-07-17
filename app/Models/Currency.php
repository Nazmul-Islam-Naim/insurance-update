<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = "currencies";
    protected $fillable = [
        'name',
        'slug',
        'symbole',
        'country',
        'branch_id',
        'created_by'
    ];
}
