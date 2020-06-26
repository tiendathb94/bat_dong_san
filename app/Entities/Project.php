<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Project extends Model
{
    use Sluggable;

    const StatusPending = 1;
    const StatusApproved = 2;
    const StatusDeclined = 3;

    const InvestorTypeInvest = 1;
    const InvestorTypeDistribute = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'long_name', 'short_name', 'project_scale', 'total_area',
        'category_id', 'price', 'price_unit', 'latitude', 'longitude',
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

    public function imageLibraries()
    {
        return $this->morphMany('App\Entities\ImageLibrary', 'image_libraryable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tabs()
    {
        return $this->hasMany('App\Entities\ProjectTab');
    }

    public function sluggable()
    {
        return ['slug' => ['source' => 'long_name']];
    }
}
