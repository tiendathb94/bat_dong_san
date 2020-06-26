<?php

namespace App\Http\Controllers\Api;

use App\Entities\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageLibraryRequest;
use DB;
use Illuminate\Support\Facades\File;

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
        try {
            DB::beginTransaction();

            $uploadedFiles = $request->file('files');
            if ($uploadedFiles) {
                foreach ($uploadedFiles as $file) {
                    $uploadedFilePath = $file->storePublicly('/uploads/images/library/');
                    $savedFiles[] = $uploadedFilePath;
                    $targetEntity->imageLibraries()->create([
                        'library_type' => $libraryType,
                        'file_path' => $uploadedFilePath,
                        'user_id' => $user->id,
                        'meta_data' => $metaData,
                    ]);
                }
            }

            DB::commit();
            return response()->json($targetEntity->imageLibraries);
        } catch (\Exception $e) {
            DB::rollback();
            File::delete($savedFiles);
        }

        return response()->json(['message' => 'Đã có lỗi xảy ra khi lưu thư viện ảnh'], 500);
    }

    private function getTargetEntity($type, $id)
    {
        switch ($type) {
            case Project::class:
                return Project::query()->find($id);
        }

        return false;
    }
}
