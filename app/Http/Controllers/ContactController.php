<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị danh sách liên hệ
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $query->where('ten_lien_he', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');
        }

        $contacts = $query->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }

    // Hiển thị form thêm liên hệ
    public function create()
    {
        return view('admin.contacts.create');
    }

    // Xử lý lưu liên hệ mới
    public function store(Request $request)
    {
        $request->validate([
            'ten_lien_he' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'so_dien_thoai' => 'required|digits_between:10,11',
            'tin_nhan' => 'required|string|min:10',
        ]);

        Contact::create($request->all());

        return redirect()->route('admin.contacts.index')->with('success', 'Thêm liên hệ thành công!');
    }

    // Hiển thị form sửa liên hệ
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.edit', compact('contact'));
    }

    // Xử lý cập nhật liên hệ
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_lien_he' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255'],
            'so_dien_thoai' => 'required|digits_between:10,11',
            'tin_nhan' => 'required|string|min:10',
            'trang_thai' => 'required|in:0,1',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('admin.contacts.index')->with('success', 'Cập nhật liên hệ thành công!');
    }
    
    // Hiển thị chi tiết liên hệ
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    // Xóa mềm liên hệ
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được xóa tạm thời.');
    }

    // Hiển thị danh sách thùng rác
    public function trash()
    {
        $contacts = Contact::onlyTrashed()->paginate(10);
        return view('admin.contacts.trash', compact('contacts'));
    }

    // Khôi phục liên hệ từ thùng rác
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('admin.contacts.trash')->with('success', 'Khôi phục thành công!');
    }

    // Xóa vĩnh viễn liên hệ
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return redirect()->route('admin.contacts.trash')->with('success', 'Liên hệ đã bị xóa vĩnh viễn.');
    }
}
