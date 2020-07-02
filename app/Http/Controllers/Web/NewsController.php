<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\News;
use App\Entities\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Entities\Role;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{   
    private $news;

    public function __construct(News $news) {
        $this->news = $news;
    }

    public function create(Request $request)
    {
        return view('default.pages.news.create', ['categories'=>getAllCategoriesNews()]);
    }

    public function store(Request $request)
    {
        $request->flash();
        $this->newsValidate('store');
        try{
            $data = $request->only('title', 'meta_content', 'content', 'project_id', 'category_id');
            $data['thumbnail'] = $this->storeFileReturnName($request->thumbnail);
            $data['user_id'] = Auth::user()->id;
            $data['status'] = News::AWAITING_REVIEW;
            $this->news->create($data);
            return  redirect()->route('pages.user.news')->with('success', 'Đăng thành bài thành công!');
        } catch ( \Exception $e ) {
            return back()->with('error', 'Thao tác thất bại!');
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $message = [];
        if($news->user_id == auth()->id()) {
            $news->delete();
            $message = [
                'status' => 'success',
                'text' => 'Xóa thành công'
            ];
        } else {
            $message = [
                'status' => 'danger',
                'text' => 'Bạn không có quyền thực thi, vui lòng kiểm tra lại.'
            ];
        }
        return redirect()->back()->with('message', $message);
    }

    public function updateStatus($id, Request $request)
    {
        $message = [];
        $news = News::findOrFail($id)->update([
            'status' => $request->status
        ]);;
        if ($request->status == News::DECLINE) {
            $message = [
                'status' => 'success',
                'text' => 'Từ chối hiển thị tin tức thành công'
            ];
        } else {
            $message = [
                'status' => 'success',
                'text' => 'Phê duyệt tin tức thành công'
            ];
        }

        return redirect()->back()->with('message', $message);
    }

    public function edit( $slug ) {
        $news = News::where('slug', $slug)->firstOrFail();
        $data = [
            'categories' => getAllCategoriesNews(),
            'news' => $news,
            'pathImageThumbnail' => '/storage' . News::PATH_IMAGE
        ];
        return view('default.pages.news.edit', $data);
    }

    public function update(Request $request)
    {
        $request->flash();
        $this->newsValidate('update');
        $data = $request->only('title', 'meta_content', 'content', 'category_id', 'project_id');
        $news = $this->news->where('slug', $request->slug)->where('user_id', auth()->id())->firstOrFail();
        if ($news->status == News:: DECLINE) {
            $data['status'] =  News::AWAITING_REVIEW;
        }
        if ( $request->thumbnail) {
            $data['thumbnail'] = $this->storeFileReturnName($request->thumbnail);
        }
        $news->update($data);
        $message = [
            'status' => 'success',
            'text' => 'Cập nhật bài đăng thành công'
        ];

        return  redirect()->route('pages.user.news')->with('message', $message);
    }

    public function storeFileReturnName($file)
    {
        $fileName = uniqid() . '.' . $file->extension();
        $path = $file->storePubliclyAs(
            'public' . News::PATH_IMAGE, $fileName
        );
        return $fileName;
    }


    public function newsValidate($action)
    {
        if( $action == 'store' ) {
            return request()->validate([
                'title' => 'required|max:191|min:4',
                'meta_content' => 'required',
                'content' => 'required',
                'thumbnail' => 'mimes:jpeg,jpg,png,gif|required|max:2048',
                'category_id' => 'required',
            ]);
        }

        return request()->validate([
            'title' => 'required|max:191|min:4',
            'meta_content' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
    }

    public function show($categorySlug, $slug) {
        $category = Category::with(['news' => function ($query) {
            $query->whereStatus(News::APPROVED);
        }])->whereSlug($categorySlug)->firstOrFail();
        $news = $category->news()->with('user')->whereStatus(News::APPROVED)->whereSlug($slug)->firstOrFail();
        $data = [
            'news' => $news,
            'category' => $category,
            'relatedNews' => $category->news->except($news->id)->sortByDesc('created_at')->take(2),
        ];
        return view('default.pages.news.show', $data);
    }

}