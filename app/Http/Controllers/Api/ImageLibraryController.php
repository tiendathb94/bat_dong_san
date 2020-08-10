<?php

namespace App\Http\Controllers\Api;

use App\Entities\ImageLibrary;
use App\Entities\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageLibraryRequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Entities\Post;

class ImageLibraryController extends Controller
{
    public function uploadImages(ImageLibraryRequest $request)
    {
        $user = auth()->user();
        $libraryableType = $request->get('libraryable_type');
        $libraryableId = $request->get('libraryable_id');
        $libraryType = $request->get('library_type');
        $metaData = $request->get('meta_data');

        $targetEntity = $this->getTargetEntity($libraryableType, $libraryableId);
        if (!$targetEntity) {
            return response()->json(['Target entity không tồn tại hoặc chưa được hỗ trợ']);
        }

        $savedFiles = [];
        $uploadedFiles = $request->file('files');
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $file) {
                $uploadedFilePath = $file->storePublicly('/public/uploads/images/library');
                $savedFiles[] = $uploadedFilePath;
                $targetEntity->imageLibraries()->create([
                    'library_type' => $libraryType,
                    'file_path' => str_replace('public', '', $uploadedFilePath),
                    'user_id' => $user->id,
                    'meta_data' => json_encode($metaData),
                ]);
            }
        }

        return response()->json($targetEntity->imageLibraries);
    }

    public function deleteLibraries(Request $request)
    {
        $libIds = $request->get('image_library_ids');
        if (!$libIds || count($libIds) < 1) {
            return response()->json(['message' => 'Không có dữ liệu cần xóa'], 400);
        }

        $user = auth()->user();

        $imageLibraries = ImageLibrary::query()
            ->where('user_id', '=', $user->id)
            ->whereIn('id', $libIds)
            ->get();

        foreach ($imageLibraries as $imageLibrary) {
            $imageLibrary->delete();
        }

        return response()->noContent();
    }

    private function getTargetEntity($type, $id)
    {
        switch ($type) {
            case Project::class:
                return Project::query()->find($id);
            case Post::class:
                return Post::query()->find($id);
        }

        return false;
    }
}
