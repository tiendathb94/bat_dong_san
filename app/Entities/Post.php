<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
}
