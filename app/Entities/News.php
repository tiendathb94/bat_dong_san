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

    const TU_CHOI = 1;
    const DA_DUYET = 2;
    const DANG_CHO_DUYET = 3;

    const STATUSES = [
        self::TU_CHOI => 'Từ chối',
        self::DA_DUYET => 'Đã duyệt',
        self::DANG_CHO_DUYET => 'Đang chờ duyệt'
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
