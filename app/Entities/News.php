<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{

    const PENDING = 1;
    const ACTIVE = 2;
    const CANCEL = 3;
    const PATH_IMAGE = '/uploads/news/';

    use Sluggable;

    protected $fillable = [
        'title', 'slug', 'meta_content','content','thumbnail','status', 'category_id', 'user_id', 'project_id'
    ];

    const DECLINE = 1;
    const APPROVED = 2;
    const AWAITING_REVIEW = 3;

    const STATUSES = [
        self::DECLINE => 'Từ chối',
        self::APPROVED => 'Đã duyệt',
        self::AWAITING_REVIEW => 'Đang chờ duyệt'
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
    
    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }
}
