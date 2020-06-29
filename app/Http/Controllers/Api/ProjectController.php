<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveProjectRequest;
use App\Entities\Project;


class ProjectController extends Controller
{
    public function searchByName(Request $request)
    {

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
        $project = Project::query()
            ->where('id', '=', $projectId)
            ->where('user_id', '=', $user->id)
            ->first();

        if (!$project) {
            return response()->json(['message' => 'Dự án bạn yêu cầu không tồn tại'], 400);
        }

        try {
            $project->delete();
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Xóa dự án không thành công bạn vui lòng thử lại'], 500);
        }
    }

    public function updateProject($projectId, SaveProjectRequest $request)
    {
        $validated = $request->validated();
        $user = auth()->user();

        /** @var Project $project */
        $project = Project::query()
            ->where('id', '=', $projectId)
            ->where('user_id', '=', $user->id)
            ->first();
        if (!$project) {
            return response()->json(['message' => 'Dự án bạn yêu cầu không tồn tại'], 400);
        }

        try {
            DB::beginTransaction();

            $allowFields = [
                'long_name', 'short_name', 'project_scale', 'total_area',
                'category_id', 'price', 'price_unit', 'latitude', 'longitude',
                'project_overview', 'investor_id', 'investor_type'
            ];

            foreach ($allowFields as $field) {
                if (isset($request->{$field})) {
                    $project->{$field} = $request->{$field};
                }
            }

            // Save project
            $project->save();

            // Save address
            $address = $validated['address'];
            if ($address) {
                $addressEntity = $project->address;

                if ($addressEntity) {
                    foreach (['province_id', 'district_id', 'ward_id', 'address'] as $field) {
                        $addressEntity->{$field} = $address[$field];
                    }

                    $addressEntity->save();
                } else {
                    $project->address()->create($address);
                }
            }

            // Save tab contents
            $tabContents = $validated['tab_contents'];
            if ($tabContents) {
                foreach ($tabContents as $tabContent) {
                    $tabContentId = !empty($tabContent['id']) ? $tabContent['id'] : 0;
                    $tabContentEntity = $project->tabs()->findOrNew($tabContentId);
                    foreach (['name', 'layout', 'contents'] as $field) {
                        $tabContentEntity->{$field === 'layout' ? 'template' : $field} = $tabContent[$field];
                    }

                    $tabContentEntity->save();
                }
            }

            DB::commit();

            return response()->noContent();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return response()->json(['message' => 'Đã có lỗi khi lưu dự án'], 500);
    }
}
