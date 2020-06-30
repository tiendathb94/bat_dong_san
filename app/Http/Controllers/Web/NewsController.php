<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\News;
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
        $this->newsValidate( null );
        try{
            $data = $request->only('title', 'meta_content', 'content', 'project_id', 'category_id');
            $data['thumbnail'] = $this->storeFileReturnPath($request->thumbnail);
            $data['user_id'] = Auth::user()->id;
            $data['status'] = News::PENDING;
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

    public function update( $slug ) {
        $news = DB::table('news')
        ->join('projects', 'projects.id', '=', 'project_id')
        ->where('news.slug', $slug)
        ->select('news.*', 'projects.long_name as projectName')
        ->first();
        return view('default.pages.news.update', ['categories'=>getAllCategoriesNews(), 'news' => $news]);
    }

    public function postUpdate(Request $request)
    {
        $request->flash();

        $this->newsValidate(1);

        $data = $request->only('title', 'meta_content', 'content', 'category_id');

        if( request('thumbnail') ) {
            request()->validate([
                'thumbnail' => 'mimes:jpeg,jpg,png,gif|max:10000',
            ],
            [
                'thumbnail.max' => 'Ảnh vượt quá dung lượng',
                'thumbnail.mimes' => 'Ảnh không đúng định dạng',
            ]);
            $data['thumbnail'] = $this->storeFileReturnPath(request('thumbnail'));
        }
        if( request('project_id') ) {
            $data['project_id'] = request('project_id');
        }

        $this->news->where('slug', $request->slug)->where('user_id', Auth::user()->id)->update($data);

        $message = [
            'status' => 'success',
            'text' => 'Chỉnh sửa thành công'
        ];

        return  redirect()->route('pages.user.news')->with('message', $message);


    }

    public function storeFileReturnPath($file)
    {
        $fileName = uniqid() . '.' . $file->extension();
        $path = $file->storePubliclyAs(
            'public' . News::PATH_IMAGE, $fileName
        );
        return $fileName;
    }


    public function newsValidate( $action )
    {
        if( $action == null ) {
            return request()->validate([
                'title' => 'required|max:191|min:4',
                'meta_content' => 'required',
                'content' => 'required',
                'thumbnail' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'project_id' => 'required',
                'category_id' => 'required',
            ],
            [
                'title.required' => 'Tiêu đề không được để trống',
                'title.max' => 'Độ dài tiêu đề tối đa là 191 ký tự',
                'title.min' => 'Độ dài tiêu đề tối đa là 4 ký tự',
    
                'content.required' => 'Nội dung không được để trống',
                'meta_content.required' => 'Mô tả không được để trống',
    
                'thumbnail.required' => 'Ảnh không được để trống',
                'thumbnail.max' => 'Ảnh vượt quá dung lượng',
                'thumbnail.mimes' => 'Ảnh không đúng định dạng',
    
                'project_id.required' => 'Dự án không được để trống',
                'category_id.required' => 'Danh mục không được để trống',
    
            ]);
        }

       return request()->validate([
            'title' => 'required|max:191|min:4',
            'meta_content' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ],
        [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Độ dài tiêu đề tối đa là 191 ký tự',
            'title.min' => 'Độ dài tiêu đề tối đa là 4 ký tự',

            'content.required' => 'Nội dung không được để trống',
            'meta_content.required' => 'Mô tả không được để trống',

            'category_id.required' => 'Danh mục không được để trống',

        ]);
    }

}