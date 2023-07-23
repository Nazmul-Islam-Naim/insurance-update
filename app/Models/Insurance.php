<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    /**
     * Get all of the owning insuranceable models.
     */
    public function insuranceable()
    {
        return $this->morphTo();
    }

    public function marine()
    {
        return $this->morphOne(MarineCargoInsurance::class, 'insuranceable');
    }

    public function fire()
    {
        return $this->morphOne(FireInsurance::class, 'insuranceable');
    }

    public function motor()
    {
        return $this->morphOne(MotorInsurance::class, 'insuranceable');
    }
}
