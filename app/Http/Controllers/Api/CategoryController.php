<?php

namespace App\Http\Controllers\Api;

use App\Entities\Category;
use App\Entities\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    const PAGINATE = 20;


    public function getCategoriesByDestinationEntity(Request $request)
    {
        $destinationEntity = $request->get('destination_entity');
        $parentId = '';
        if (empty($destinationEntity)) {
            return response()->json(['error' => true, 'message' => 'Thiếu destination entity']);
        }

        if($request->slug_parent) {
            $parentId = Category::whereSlug($request->slug_parent)->where('destination_entity', $request->destination_entity)->first()->id;
        }

        $categories = Category::query()->where('destination_entity', $request->destination_entity);
        if($parentId) {
            $categories->where('parent_id', $parentId);
        }
        return response()->json($categories->get());
    }

    public function searchByName( Request $request ) {

        $categories = DB::table('categories')
        ->where('destination_entity', News::class)
        ->where('name', 'LIKE', '%' . request('query') . '%')
        ->take(self::PAGINATE)->get();

        return response()->json($categories);

    }

}
