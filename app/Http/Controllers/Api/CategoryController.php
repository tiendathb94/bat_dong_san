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
        if (empty($destinationEntity)) {
            return response()->json(['error' => true, 'message' => 'Thiếu destination entity']);
        }

        $categories = Category::query()->where('destination_entity', '=', $request->get('destination_entity'))->get();
        return response()->json($categories);
    }

    public function searchByName( Request $request ) {

        $categories = DB::table('categories')
        ->where('destination_entity', News::class)
        ->where('name', 'LIKE', '%' . request('query') . '%')
        ->take(self::PAGINATE)->get();

        return response()->json($categories);

    }

}
