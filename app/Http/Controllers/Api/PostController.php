<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Entities\Address;
use App\Entities\Category;

class PostController extends Controller
{
    public function getPriceUnit(Request $request)
    {
        return Post::CATEGORIES[$request->slug];
    }

    public function getDirection()
    {
        return Post::DIRECTIONS;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $category = Category::whereSlug($request->slugParent)->first();
        $data['form'] = $category->id;
        $data['category_id'] = $request->category_id;
        $data['status'] = 0;
        $data['user_id'] = auth()->id();
        $post = Post::create($data);
        $address = $data['address'];
        $address['addressable_id'] = $post->id;
        $address['addressable_type'] = Post::class;
        Address::create($address);
        $data = [
            'message' => 'Lưu thành công',
            'data' => [
                'post' => $post
            ]
        ];
        return response()->json($data);
    }

    public function changeStatus($id)
    {
        $post = auth()->user()->posts()->whereId($id)->firstOrFail();
        $post->status = $post->status ? 0 : 1;
        $post->save();
    }
}
