<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Project extends Model
{
    use Sluggable;

    const StatusPending = 1;
    const StatusApproved = 2;
    const StatusDeclined = 3;

    const InvestorTypeInvest = 1;
    const InvestorTypeDistribute = 2;

    const PriceUnitMillion = 1;
    const PriceUnitBillion = 2;
    const PriceUnitHundredThousandPermM2 = 3;
    const PriceUnitMillionPermM2 = 4;

    const ImageLibraryTypeGallery = 'gallery';
    const ImageLibraryTypeProgress = 'progress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'long_name', 'short_name', 'project_scale', 'total_area',
        'category_id', 'price', 'price_unit', 'latitude', 'longitude',
        'project_overview', 'status', 'user_id', 'investor_id', 'investor_type'
    ];

    protected $with = ['user', 'address', 'tabs'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->morphOne('App\Entities\Address', 'addressable');
    }

    public function imageLibraries()
    {
        return $this->morphMany('App\Entities\ImageLibrary', 'image_libraryable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function tabs()
    {
        return $this->hasMany('App\Entities\ProjectTab');
    }

    public function sluggable()
    {
        return ['slug' => ['source' => 'long_name']];
    }

    public function getPriceFormatted()
    {
        switch ($this->price_unit) {
            case self::PriceUnitBillion:
                return "{$this->price} Tỷ";
                break;
            case self::PriceUnitMillion:
                return "{$this->price} Triệu";
                break;
            case self::PriceUnitMillionPermM2:
                return "{$this->price} triệu/m²";
                break;
            case self::PriceUnitHundredThousandPermM2:
                return "{$this->price} trăm nghìn/m²";
                break;
        }
    }

    public function getThumbnail()
    {
        if ($this->imageLibraries && $this->imageLibraries->first()) {
            $filePath = $this->imageLibraries->first()->file_path;
            return "/storage/$filePath";
        }

        return '/images/placeholder.png';
    }
}
