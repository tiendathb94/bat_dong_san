<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Entities\Province;
use App\Entities\District;
use App\Entities\Ward;
use App\Entities\Category;
use App\Entities\Project;
use App\Http\Requests\SavePostRequest;
use App\Entities\Address;
use DB;


class PostController extends Controller
{
    public function createSell()
    {
        return view($this->_config['view']);
    }

    public function listSell(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $checkPermission = checkRule($user);
        $categorySellHouse = Category::whereSlug(Post::SELL_HOUSE)->first();
        $categoryLeaseHouse = Category::whereSlug(Post::LEASE_HOUSE)->first();
        $posts = Post::whereIn('form', [$categorySellHouse->id, $categoryLeaseHouse->id]);
        if(!$checkPermission){
            $posts = $posts->where('user_id',$user_id);
        }
        if($request->title) {
            $posts->where('title', 'like', "%$request->title%");
        }
        return view($this->_config['view'], ['posts' => $posts->orderByDesc('created_at')->paginate(20)]);
    }

    public function listBuy(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $checkPermission = checkRule($user);
        $categoryBuyHouse = Category::whereSlug(Post::HOUSE_BUY)->first();
        $categoryRentHouse = Category::whereSlug(Post::HOUSE_RENT)->first();
        $posts = Post::whereIn('form', [$categoryBuyHouse->id, $categoryRentHouse->id]);
        if(!$checkPermission){
            $posts = $posts->where('user_id',$user_id);
        }
        if($request->title) {
            $posts->where('title', 'like', "%$request->title%");
        }
        return view($this->_config['view'], ['posts' => $posts->orderByDesc('created_at')->paginate(10)]);
    }

    public function createBuy()
    {
        $categories = Category::all();
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $projects = Project::all();

        $data = [
            'categories' => $categories,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'projects' => $projects
        ];
        return view($this->_config['view'], $data);
    }

    public function store(SavePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $user_id = auth()->id();

            $uploadedFilePath = $request->file('image')->storePublicly('/public/uploads/images/library');
            $category = Category::whereSlug($request->slug)->first();

            $createPost = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $request->slug,
                'form' => $category->id,
                'category_id' => $request->category_id,
                'total_area' => $request->total_area,
                'price' => $request->price,
                'user_id' => $user_id,
                'status' => 0,
                'approval' => 1
            ]);
            
            $address['addressable_id'] = $createPost->id;
            $address['addressable_id'] = $createPost->id;
            $address['province_id'] = $request->province_id;
            $address['district_id'] = $request->district_id;
            $address['ward_id'] = $request->ward_id;
            $address['address'] = $request->address;
            
            $createPost->address()->create($address);
            $createPost->imageLibraries()->create([
                'library_type' => Post::class,
                'file_path' => str_replace('public', '', $uploadedFilePath),
                'user_id' => $user_id,
                'meta_data' => '',
            ]);
            DB::commit();
            return  redirect()->route('posts.list_buy')->with('success', 'Đăng thành bài thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return back()->with('error', 'Thao tác thất bại!');
        }
    }

    public function getDistrict(Request $request)
    {
        $respon = [
            'districts' => Province::findOrFail($request->id)->districts()->orderBy('name')->get(),
        ];
        return response()->json($respon);
    }

    public function getWard(Request $request)
    {
        $respon = [
            'wards' => District::findOrFail($request->id)->wards()->orderBy('name')->get(),
        ];
        return response()->json($respon);
    }
}
