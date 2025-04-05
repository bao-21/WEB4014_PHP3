<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // Danh sách bài viết (kèm tìm kiếm, phân trang)
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $query->where('tieu_de', 'like', '%' . $request->search . '%');
        }

        $posts = $query->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    // Form tạo bài viết mới
    public function create()
    {
        return view('admin.posts.create');
    }

    // Xử lý thêm bài viết
    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'tac_gia' => 'required|string|max:100',
            'xuat_ban' => 'nullable|date',
        ], [
            'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
            'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'noi_dung.required' => 'Vui lòng nhập nội dung bài viết.',
            'tac_gia.required' => 'Vui lòng nhập tên tác giả.',
            'tac_gia.max' => 'Tên tác giả không được vượt quá 100 ký tự.',
            'xuat_ban.date' => 'Ngày xuất bản phải là định dạng ngày hợp lệ.',
        ]);



        Post::create($request->all());
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được thêm');
    }

    // Form chỉnh sửa bài viết
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    // Xử lý cập nhật bài viết
    public function update(Request $request, $id)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'tac_gia' => 'required|string|max:100',
            'xuat_ban' => 'nullable|date',
        ], [
            'tieu_de.required' => 'Vui lòng nhập tiêu đề.',
            'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'noi_dung.required' => 'Vui lòng nhập nội dung bài viết.',
            'tac_gia.required' => 'Vui lòng nhập tên tác giả.',
            'tac_gia.max' => 'Tên tác giả không được vượt quá 100 ký tự.',
            'xuat_ban.date' => 'Ngày xuất bản phải là định dạng ngày hợp lệ.',
        ]);


        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật');
    }

    // Xóa mềm bài viết
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa');
    }

    // Hiển thị thùng rác
    public function trash()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('admin.posts.trash', compact('posts'));
    }

    // Khôi phục bài viết đã xóa
    public function restore($id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.posts.trash')->with('success', 'Bài viết đã được khôi phục');
    }

    // Xóa vĩnh viễn bài viết
    public function forceDelete($id)
    {
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.posts.trash')->with('success', 'Bài viết đã bị xóa vĩnh viễn');
    }
}
