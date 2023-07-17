<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherReceiveType extends Model
{
    use HasFactory;

    protected $table = "other_receive_types";
    protected $fillable = [
    	'name', 'status', 'branch_id'
    ];
}
