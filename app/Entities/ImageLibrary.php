<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ImageLibrary extends Model
{
    protected $fillable = ['library_type', 'file_path', 'meta_data', 'user_id'];
    protected $casts = ['contents' => 'array'];

    public function libraryable()
    {
        return $this->morphTo();
    }
}
