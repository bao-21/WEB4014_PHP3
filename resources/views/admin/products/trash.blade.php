@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác sản phẩm</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Giá KM</th>
                    <th>Số lượng</th>
                    <th>Ngày nhập</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->ma_san_pham }}</td>
                    <td>{{ $product->ten_san_pham }}</td>
                    <td>{{ $product->category->ten_danh_muc ?? 'Chưa có danh mục' }}</td>
                    <td>
                        @if ($product->hinh_anh)
                            <img src="{{ asset('storage/' . $product->hinh_anh) }}" alt="{{ $product->ten_san_pham }}"
                                width="60">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>{{ number_format($product->gia, 0, ',', '.') }} VND</td>
                    <td>
                        @if ($product->gia_khuyen_mai)
                            {{ number_format($product->gia_khuyen_mai, 0, ',', '.') }} VND
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $product->so_luong }}</td>
                    <td>{{ date('d/m/Y', strtotime($product->ngay_nhap)) }}</td>
                    <td>
                        @if ($product->trang_thai)
                            <span class="badge bg-success">Đang bán</span>
                        @else
                            <span class="badge bg-danger">Ngừng bán</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection
