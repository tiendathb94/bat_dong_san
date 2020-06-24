<?php

namespace App\Http\Controllers\Api;

use App\Entities\Category;
use App\Entities\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    public function createProject(Request $request)
    {
        $user = auth()->user();

        $project = new Project($request->all());
        $project->user_id = $user;

        try {
            DB::beginTransaction();
            $project->save();

            // Save address
            $address = $request->get('address');
            if ($address) {
                $project->address()->create($address);
            }

            // Save tab contents
            $tabContents = $request->get('tab_contents');
            if ($tabContents) {

            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
