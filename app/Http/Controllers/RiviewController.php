<?php

namespace App\Http\Controllers;

use App\Models\Customser;
use App\Models\Product;
use App\Models\Riview;
use Illuminate\Http\Request;

class RiviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Riview::with(['customer', 'product']);
        if ($request->has('search')) {
            $query->where('noi_dung', 'like', '%' . $request->search . '%');
        }
        $riviews = $query->paginate(10);
        return view('admin.riviews.index', compact('riviews'));
    }

    public function show($id)
    {
        $riview = Riview::findOrFail($id);
        return view('admin.riviews.show', compact('riview'));
    }

    public function create()
    {
        $customers = Customser::all(); // Fixed typo
        $products = Product::all();
        return view('admin.riviews.create', compact('customers', 'products'));
    }

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

    public function edit(Riview $riview, $id)
    {
        $riview = Riview::findOrFail($id);
        $customers = Customser::all(); // Fixed typo
        $products = Product::all();
        return view('admin.riviews.edit', compact('riview', 'customers', 'products'));
    }

    public function update(Request $request, Riview $riview, $id)
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
        $riview = Riview::findOrFail($id);
        $riview->update($request->all());
        return redirect()->route('admin.riviews.index')->with('success', 'Đã cập nhật đánh giá!');
    }

    public function destroy(Riview $riview, $id)
    {
        $riview = Riview::findOrFail($id);
        $riview->delete();
        return redirect()->route('admin.riviews.index')->with('success', 'Đã xóa đánh giá!'); // Fixed route
    }

    public function trash()
    {
        $reviews = Riview::onlyTrashed()->paginate(10);
        return view('admin.riviews.trash', compact('reviews')); // Consistent variable name
    }

    public function restore($id)
    {
        $riview = Riview::onlyTrashed()->findOrFail($id);
        $riview->restore();
        return redirect()->route('admin.riviews.trash')->with('success', 'Đã khôi phục đánh giá!');
    }

    public function forceDelete($id)
    {
        Riview::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.riviews.trash')->with('success', 'Đã xóa vĩnh viễn đánh giá!');
    }
}
