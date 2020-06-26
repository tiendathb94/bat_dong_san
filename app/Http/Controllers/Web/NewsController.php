<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\News;

class NewsController extends Controller
{
    public function create(Request $request)
    {
        return view('default.pages.news.create');
    }

    public function store(Request $request)
    {
        # code...
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $message = [
            'status' => 'danger',
            'text' => 'Bạn không có quyền thực thi'
        ];
        if($news->user_id == auth()->id()) {
            $news->delete();
            $message = [
                'status' => 'success',
                'text' => 'Xóa thành công'
            ];
        }

        return redirect()->back()->with('message', $message);
    }
}
