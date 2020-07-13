<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\ImageLibrary;
use \Carbon\Carbon;

class ImageLibrary extends Model
{
    protected $fillable = ['library_type', 'file_path', 'meta_data', 'user_id'];
    protected $casts = ['contents' => 'array'];
    protected $appends = ['date_upload_file', 'gallery_image'];

    const PROGRESS = 'progress';
    const GALLERY = 'gallery';

    public function libraryable()
    {
        return $this->morphTo();
    }

    public function getDateSortAttribute()
    {
        $attr = 0;
        if($this->meta_data) {
            $metaData = json_decode($this->meta_data);
            $attr = $metaData->date_sort ?: 0;
        }
        return $attr;
    }

    public function getDateUploadFileAttribute()
    {
        $attr = '';
        if($this->meta_data) {
            $metaData = json_decode($this->meta_data);
            if($metaData) {
                $attr = $metaData->date_upload_file ?: '';
            }
        }
        return $attr;
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'image_libraryable_id');
    }

    public function getGalleryImageAttribute()
    {
        return '/storage' . self::where('image_libraryable_id', $this->image_libraryable_id)
            ->where('image_libraryable_type', Project::class)
            ->where('library_type', self::GALLERY)
            ->first()
            ->file_path;
    }
}
