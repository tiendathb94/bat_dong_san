<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveProjectRequest;
use App\Entities\Project;


class ProjectController extends Controller
{
    public function searchByName( Request $request ) {

        $categories = DB::table('projects')
        ->where('status', Project::StatusApproved)
        ->where('long_name', 'LIKE', '%' . request('query') . '%')->take(20)->get();

        return response()->json($categories);
    }

    public function createProject(SaveProjectRequest $request)
    {
        $validated = $request->validated();
        $user = auth()->user();

        $project = new Project($validated);
        $project->user_id = $user->id;
        $project->status = Project::StatusPending;

        try {
            DB::beginTransaction();

            // Save project
            $project->save();

            // Save address
            $address = $validated['address'];
            if ($address) {
                $project->address()->create($address);
            }

            // Save tab contents
            $tabContents = $validated['tab_contents'];
            if ($tabContents) {
                foreach ($tabContents as $tabContent) {
                    $project->tabs()->create([
                        'name' => $tabContent['name'],
                        'template' => $tabContent['layout'],
                        'contents' => $tabContent['contents'],
                    ]);
                }
            }

            DB::commit();

            return response()->json(Project::query()->find($project->id));
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json(['message' => 'Đã có lỗi khi lưu dự án'], 500);
    }

    public function deleteProject($projectId)
    {
        $user = auth()->user();
        $project = Project::query()->where('id', '=', $projectId)->where('user_id', '=', $user->id)->get();
        if (!$project) {
            return response()->json(['message' => 'Dự án bạn yêu cầu không tồn tại'], 400);
        }

        try {
            $project->first()->delete();
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Xóa dự án không thành công bạn vui lòng thử lại'], 500);
        }
    }
}
