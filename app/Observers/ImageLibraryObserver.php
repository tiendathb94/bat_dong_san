<?php

namespace App\Observers;

use App\Entities\ImageLibrary;
use Illuminate\Support\Facades\Storage;

class ImageLibraryObserver
{
    /**
     * Handle the User "deleted" event.
     *
     * @param ImageLibrary $imageLibrary
     * @return void
     */
    public function deleted(ImageLibrary $imageLibrary)
    {
        // Delete file when delete entity
        Storage::disk('public')->delete($imageLibrary->file_path);
    }
}
