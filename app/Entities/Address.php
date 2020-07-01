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

    public function show()
    {
        $parts = [];

        if (!empty($this->address)) {
            $parts[] = $this->address;
        }

        if (!empty($this->ward) && !empty($this->ward->name)) {
            $parts[] = $this->ward->name;
        }

        if (!empty($this->district) && !empty($this->district->name)) {
            $parts[] = $this->district->name;
        }

        if (!empty($this->province) && !empty($this->province->name)) {
            $parts[] = $this->province->name;
        }

        return join(', ', $parts);
    }
}
