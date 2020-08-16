<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Province;
use App\Entities\Ward;

class District extends Model
{
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
