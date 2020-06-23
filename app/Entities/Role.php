<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permission()
    {
        return $this->hasMany(Permissions::class);
    }

}
