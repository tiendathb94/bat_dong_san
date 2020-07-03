<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
