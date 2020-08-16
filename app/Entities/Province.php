<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\District;

class Province extends Model
{
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
