<?php

namespace App\Http\Controllers;

use App\Models\Customser;
use Illuminate\Http\Request;

class CustomserController extends Controller
{
    //
    // Hiển thị danh sách liên hệ
    public function index(Request $request)
    {
        $query = Customser::query();

        if ($request->filled('ten_khach_hang')) {
            $query->where('ten_khach_hang', 'LIKE', '%' . $request->ten_khach_hang . '%');
        }

        if ($request->filled('so_dien_thoai')) {
            $query->where('so_dien_thoai', 'LIKE', '%' . $request->so_dien_thoai . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('dia_chi')) {
            $query->where('dia_chi', 'LIKE', '%' . $request->dia_chi . '%');
        }
        

        $customsers = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.customsers.index', compact('customsers'));
    }

    // Hiển thị form thêm liên hệ
    public function create()
    {
        return view('admin.customsers.create');
    }

    // Xử lý lưu liên hệ mới
    public function store(Request $request)
    {
        $request->validate([
            'ten_khach_hang' => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|digits_between:10,11',
            'email' => 'required|email|unique:customers,email',
            'dia_chi' => 'nullable|string|max:255',
        ], [
            'ten_khach_hang.required' => 'Vui lòng nhập tên khách hàng.',
            'ten_khach_hang.max' => 'Tên khách hàng không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'so_dien_thoai.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ]);
        

        Customser::create($request->all());

        return redirect()->route('admin.customsers.index')->with('success', 'Thêm khách hàng thành công!');
    }

    // Hiển thị form sửa liên hệ
    public function edit($id)
    {
        $customser = Customser::findOrFail($id);
        return view('admin.customsers.edit', compact('customser'));
    }

    // Xử lý cập nhật liên hệ
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_khach_hang' => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|digits_between:10,11',
            'email' => 'required|email|unique:customers,email,' . $id,
            'dia_chi' => 'nullable|string|max:255',
        ], [
            'ten_khach_hang.required' => 'Vui lòng nhập tên khách hàng.',
            'ten_khach_hang.max' => 'Tên khách hàng không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'so_dien_thoai.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ]);
        

        $customser = Customser::findOrFail($id);
        $customser->update($request->all());

        return redirect()->route('admin.customsers.index')->with('success', 'Cập nhật khách hàng thành công!');
    }
    // Hiển thị chi tiết liên hệ
    public function show($id)
    {
        $customser = Customser::findOrFail($id);
        return view('admin.customsers.show', compact('customser'));
    }

    // Xóa mềm liên hệ
    public function destroy($id)
    {
        $customser = Customser::findOrFail($id);
        $customser->delete();

        return redirect()->route('admin.customsers.index')->with('success', 'Khách hàng đã được xóa tạm thời.');
    }

    // Hiển thị danh sách thùng rác
    public function trash()
    {
        $customsers = Customser::onlyTrashed()->paginate(10);
        return view('admin.customsers.trash', compact('customsers'));
    }

    // Khôi phục liên hệ từ thùng rác
    public function restore($id)
    {
        $customser = Customser::onlyTrashed()->findOrFail($id);
        $customser->restore();

        return redirect()->route('admin.customsers.trash')->with('success', 'Khôi phục thành công!');
    }

    // Xóa vĩnh viễn liên hệ
    public function forceDelete($id)
    {
        $customser = Customser::onlyTrashed()->findOrFail($id);
        $customser->forceDelete();

        return redirect()->route('admin.customsers.trash')->with('success', 'Liên hệ đã bị xóa vĩnh viễn.');
    }
}
