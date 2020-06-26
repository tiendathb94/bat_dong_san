<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name',
    ];

    const SUPER_ADMIN = 'super_admin';
    const APPROVE_NEWS = 'approve_news';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permission()
    {
        return $this->hasMany(Permissions::class);
    }

}
