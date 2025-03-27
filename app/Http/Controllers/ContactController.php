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
