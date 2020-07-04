<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['name', 'value', 'day_id'];

    const COUNT_VIEWS = 'cont_views';

    public function statisticable()
    {
        return $this->morphTo();
    }
}
