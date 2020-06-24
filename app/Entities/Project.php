<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'long_name', 'short_name', 'project_scale', 'total_area',
        'total_area', 'category_id', 'price', 'price_unit', 'latitude', 'longitude',
        'project_overview', 'status', 'user_id', 'investor_id', 'investor_type'
    ];

    protected $with = ['user', 'address', 'tabs'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->morphOne('App\Entities\Address', 'addressable');
    }

    public function tabs()
    {
        return $this->belongsToMany('App\Entities\ProjectTab');
    }
}
