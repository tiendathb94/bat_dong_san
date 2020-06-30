<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'email', 'website', 'logo', 'overview', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->morphOne('App\Entities\Address', 'addressable');
    }
}
