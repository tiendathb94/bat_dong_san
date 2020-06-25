<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'meta_content','content','thumbnail','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
