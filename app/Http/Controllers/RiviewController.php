<?php

namespace App\Http\Controllers;

use App\Models\Customser;
use App\Models\Product;
use App\Models\Riview;
use Illuminate\Http\Request;

class RiviewController extends Controller
{
    // Danh sách đánh giá (kèm tìm kiếm, phân trang)
    public function index(Request $request)
    {
        $query = Riview::with(['customer', 'product']);

        if ($request->has('search')) {
            $query->where('noi_dung', 'like', '%' . $request->search . '%');
        }

        $riviews = $query->paginate(10);
        return view('admin.riviews.index', compact('riviews'));
    }

    // Hiển thị chi tiết đánh giá
    public function show($id)
{
    $riview = Riview::findOrFail($id);
    return view('admin.riviews.show', compact('riview'));
}


    // Hiển thị form thêm mới
    public function create()
    {
        $customsers = Customser::all(); // Lỗi: sai chính tả "$customsers"
        $products = Product::all();
        return view('admin.riviews.create', compact('customsers', 'products'));
    }

    // Xử lý lưu đánh giá mới
    public function store(Request $request)
    {
        $request->validate([
            'noi_dung' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'xep_hang' => 'required|integer|min:1|max:5',
        ], [
            'noi_dung.required' => 'Vui lòng nhập nội dung đánh giá.',
            'customer_id.required' => 'Vui lòng chọn khách hàng.',
            'customer_id.exists' => 'Khách hàng không hợp lệ.',
            'product_id.required' => 'Vui lòng chọn sản phẩm.',
            'product_id.exists' => 'Sản phẩm không hợp lệ.',
            'xep_hang.required' => 'Vui lòng nhập xếp hạng.',
            'xep_hang.min' => 'Xếp hạng ít nhất là 1.',
            'xep_hang.max' => 'Xếp hạng tối đa là 5.',
        ]);

        Riview::create($request->all());
        return redirect()->route('admin.riviews.index')->with('success', 'Đã thêm đánh giá!');
    }

    // Hiển thị form sửa
    public function edit(Riview $riview)
    {
        $customers = Customser::all();
        $products = Product::all();
        return view('admin.riviews.edit', compact('riview', 'customers', 'products'));
    }

    // Xử lý cập nhật
    public function update(Request $request, Riview $riview)
    {
        $request->validate([
            'noi_dung' => 'required|string',
            'xep_hang' => 'required|integer|min:1|max:5',
        ], [
            'noi_dung.required' => 'Vui lòng nhập nội dung đánh giá.',
            'xep_hang.required' => 'Vui lòng nhập xếp hạng.',
            'xep_hang.min' => 'Xếp hạng ít nhất là 1.',
            'xep_hang.max' => 'Xếp hạng tối đa là 5.',
        ]);

        $riview->update($request->all());
        return redirect()->route('admin.riviews.index')->with('success', 'Đã cập nhật đánh giá!');
    }

    // Xóa mềm
    public function destroy(Riview $riview)
    {
        $riview->delete();
        return redirect()->route('riviews.index')->with('success', 'Đã xóa đánh giá!');
    }

    // Hiển thị thùng rác
    public function trash()
    {
        $reviews = Riview::onlyTrashed()->paginate(10);
        return view('admin.riviews.trash', compact('riviews'));
    }

    // Khôi phục từ thùng rác
    public function restore($id)
    {
        Riview::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('riviews.trash')->with('success', 'Đã khôi phục đánh giá!');
    }

    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        Riview::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('riviews.trash')->with('success', 'Đã xóa vĩnh viễn đánh giá!');
    }
}
