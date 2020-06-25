<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['province_id', 'district_id', 'ward_id', 'address'];

    protected $with = ['district', 'province', 'ward'];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function district()
    {
        return $this->belongsTo('App\Entities\District');
    }

    public function province()
    {
        return $this->belongsTo('App\Entities\Province');
    }

    public function ward()
    {
        return $this->belongsTo('App\Entities\Ward');
    }
}
