<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectTab extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'template', 'contents'];

    protected $casts = ['contents' => 'array'];
}
