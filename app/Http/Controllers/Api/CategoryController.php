<?php

namespace App\Http\Controllers\Api;

use App\Entities\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategoriesByDestinationEntity(Request $request)
    {
        $destinationEntity = $request->get('destination_entity');
        if (empty($destinationEntity)) {
            return response()->json(['error' => true, 'message' => 'Thiếu destination entity']);
        }

        $categories = Category::query()->where('destination_entity', '=', $request->get('destination_entity'))->get();
        return response()->json($categories);
    }
}
