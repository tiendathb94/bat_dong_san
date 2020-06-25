<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'meta_content','content','thumbnail','status'
    ];

    const STATUSES = [
        1 => 'Từ chối',
        2 => 'Đã duyệt',
        3 => 'Đang chờ duyệt'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtDateAttribute()
    {
        $date = new Carbon($this->created_at);
        return $date->format(config('app.format.date'));
    }

    public function getStatusNameAttribute()
    {
        return self::STATUSES[$this->status];
    }
}
