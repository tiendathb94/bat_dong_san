<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    const MILLION = 'Triệu';
    const BILLION = 'Tỷ';
    const HUNDRED_THOUSAND_PER_M2 = 'Trăm nghìn/m2';
    const MILLION_PER_M2 = 'Triệu/m2';
    const HUNDRED_THOUSAND_PER_MONTH = 'Trăm nghìn/tháng';
    const MILLION_PER_MONTH = 'Triệu/tháng';
    const HUNDRED_THOUSAND_PER_M2_MONTH = 'Trăm nghìn/m2/tháng';
    const MILLION_PER_M2_MONTH = 'Triệu/m2/tháng';
    const THOUSAND_PER_M2_MONTH = 'Nghìn/m2/tháng';
    const SELL_HOUSE = 'nha-dat-ban';
    const LEASE_HOUSE = 'nha-dat-cho-thue';
    const HOUSE_BUY = 'nha-dat-can-mua';
    const HOUSE_RENT = 'nha-dat-can-thue';
    const CATEGORIES = [
        self::SELL_HOUSE => [
            1 => self::MILLION,
            2 => self::BILLION,
            3 => self::HUNDRED_THOUSAND_PER_M2,
            4 => self::MILLION_PER_M2
        ],
        self::LEASE_HOUSE => [
            5 => self::HUNDRED_THOUSAND_PER_MONTH,
            6 => self::MILLION_PER_MONTH,
            7 => self::HUNDRED_THOUSAND_PER_M2_MONTH,
            8 => self::MILLION_PER_M2_MONTH,
            9 => self::THOUSAND_PER_M2_MONTH
        ]
    ];

    const PRICE_NAME = [
        1 => self::MILLION,
        2 => self::BILLION,
        3 => self::HUNDRED_THOUSAND_PER_M2,
        4 => self::MILLION_PER_M2,
        5 => self::HUNDRED_THOUSAND_PER_MONTH,
        6 => self::MILLION_PER_MONTH,
        7 => self::HUNDRED_THOUSAND_PER_M2_MONTH,
        8 => self::MILLION_PER_M2_MONTH,
        9 => self::THOUSAND_PER_M2_MONTH
    ];

    const DIRECTIONS = [
        0 => 'KXĐ',
        1 => 'Đông',
        2 => 'Tây',
        3 => 'Nam',
        4 => 'Bắc',
        5 => 'Đông-Bắc',
        6 => 'Tây-Bắc',
        7 => 'Tây-Nam',
        8 => 'Đông-Nam'
    ];
    const StatusPending = 1;
    const StatusApproved = 2;
    const StatusDeclined = 3;
    
    protected $fillable = [
        'title', 'slug', 'form', 'content', 'price_unit', 'status', 'facade', 'way_in',
        'direction_house', 'direction_balcony', 'number_of_floors', 'number_of_bedroom',
        'number_of_toilet', 'furniture', 'legal_information', 'total_area', 'price', 'total_price', 'category_id', 'user_id'
    ];

    protected $with = ['imageLibraries', 'address'];

    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }

    public function imageLibraries()
    {
        return $this->morphMany('App\Entities\ImageLibrary', 'image_libraryable');
    }

    public function getPriceUnitNameAttribute()
    {
        return $this->price_unit ? self::PRICE_NAME[$this->price_unit] : '';
    }

    public function address()
    {
        return $this->morphOne('App\Entities\Address', 'addressable');
    }

    public function categories()
    {
        return $this->hasMany('App\Entities\Category');
    }
}
