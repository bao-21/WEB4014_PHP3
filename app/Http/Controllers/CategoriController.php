<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
     // Hiển thị danh sách danh mục
    public function index(Request $request)
    {
        $query = Category::query();

        // Tìm kiếm theo tên danh mục
        if ($request->filled('ten_danh_muc')) {
            $query->where('ten_danh_muc', 'LIKE', '%' . $request->ten_danh_muc . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        // Phân trang 10 bản ghi trên mỗi trang
        $categories = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    // Hiển thị form tạo mới danh mục
    public function create()
    {
        return view('admin.categories.create');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten_danh_muc' => 'required|string|max:255|unique:categories',
            'trang_thai'   => 'required|boolean',
        ], [
            'ten_danh_muc.required' => 'Tên danh mục không được để trống.',
            'ten_danh_muc.unique'   => 'Tên danh mục đã tồn tại.',
            'trang_thai.required'   => 'Trạng thái không được để trống.',
        ]);

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $data = $request->validate([
            'ten_danh_muc' => 'required|string|max:255|unique:categories,ten_danh_muc,' . $id,
            'trang_thai' => 'required|boolean',
        ],
        [
            'ten_danh_muc.required' => 'Tên danh mục không được để trống.',
            'ten_danh_muc.unique'   => 'Tên danh mục đã tồn tại.',
            'trang_thai.required'   => 'Trạng thái không được để trống.',
        ]);

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa mềm danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }

    // Hiển thị danh sách thùng rác
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(10);
        return view('admin.categories.trash', compact('categories'));
    }

    // Khôi phục danh mục từ thùng rác
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('admin.categories.trash')->with('success', 'Khôi phục danh mục thành công!');
    }

    // Xóa vĩnh viễn danh mục
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('admin.categories.trash')->with('success', 'Danh mục đã bị xóa vĩnh viễn!');
    }

}
