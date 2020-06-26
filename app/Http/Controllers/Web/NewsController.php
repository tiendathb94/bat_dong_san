<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\News;
use App\Entities\Role;

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
        $news = News::findOrFail($id);
        $message = [];
        if(auth()->user()->roles()->whereIn('name', [Role::SUPER_ADMIN, Role::APPROVE_NEWS])->count()) {
            $news->update([
                'status' => $request->status
            ]);
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
            
        } else {
            $message = [
                'status' => 'danger',
                'text' => 'Bạn không có quyền thực thi, vui lòng kiểm tra lại.'
            ];
        }

        return redirect()->back()->with('message', $message);
    }
}
