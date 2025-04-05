<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Hiển thị danh sách Banner
    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    // Hiển thị form thêm mới Banner
    public function create()
    {
        return view('admin.banners.create');
    }

    // Xử lý thêm mới Banner
    public function store(Request $request)
    {
        $dataNew = $request->validate([
            'hinh_anh' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ], [
            'hinh_anh.required' => 'Vui lòng chọn hình ảnh.',
            'hinh_anh.image' => 'Tệp tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, jpg, png, gif.',
            'hinh_anh.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

        // Xử lý hình ảnh
        if ($request->hasFile('hinh_anh')) {
            $imgPath = $request->file('hinh_anh')->store('images/banners', 'public');
            $dataNew['hinh_anh'] = $imgPath;
        }

        Banner::create($dataNew);

        return redirect()->route('admin.banners.index')->with('success', 'Thêm banner thành công!');
    }

    // Hiển thị form chỉnh sửa Banner
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    // Xử lý cập nhật Banner
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $dataNew = $request->validate([
            'hinh_anh' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ], [
            'hinh_anh.image' => 'Tệp tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpeg, jpg, png, gif.',
            'hinh_anh.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

         // Xử lý hình ảnh
         if ($request->hasFile('hinh_anh')) {
            $imgPath = $request->file('hinh_anh')->store('images/banners', 'public');
            $dataNew['hinh_anh'] = $imgPath;
            // Nếu mà có hình ảnh mới thì xóa ảnh cũ
            if ($banner->hinh_anh) {
        //use Illuminate\Support\Facades\Storage;
                Storage::disk('public')->delete($banner->hinh_anh);
                
            }
        }


        $banner->update($dataNew);

        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật banner thành công!');
    }

    // Xóa mềm Banner
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Xóa banner thành công!');
    }

    // Hiển thị danh sách Banner trong thùng rác
    public function trash()
    {
        $banners = Banner::onlyTrashed()->paginate(10);
        return view('admin.banners.trash', compact('banners'));
    }

    // Khôi phục Banner từ thùng rác
    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->restore();

        return redirect()->route('admin.banners.trash')->with('success', 'Khôi phục banner thành công!');
    }

    // Xóa vĩnh viễn Banner
    public function forceDelete($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);

        // Xóa hình ảnh nếu có
        if ($banner->hinh_anh) {
            Storage::delete('public/banners/' . $banner->hinh_anh);
        }

        $banner->forceDelete();

        return redirect()->route('admin.banners.trash')->with('success', 'Banner đã bị xóa vĩnh viễn.');
    }
}
