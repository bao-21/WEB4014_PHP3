@extends('layouts.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<h2 class="mb-4">Chi tiết sản phẩm</h2>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $product->ten_san_pham }}</h4>
        <p><strong>Mã sản phẩm:</strong> {{ $product->ma_san_pham }}</p>
        <p><strong>Danh mục:</strong> {{ $product->category->ten_danh_muc ?? 'Chưa có danh mục' }}</p>
        <p><strong>Giá:</strong> {{ number_format($product->gia, 0, ',', '.') }} VND</p>
        <p><strong>Giá khuyến mãi:</strong> 
            @if ($product->gia_khuyen_mai)
                {{ number_format($product->gia_khuyen_mai, 0, ',', '.') }} VND
            @else
                Không có
            @endif
        </p>
        <p><strong>Số lượng:</strong> {{ $product->so_luong }}</p>
        <p><strong>Ngày nhập:</strong> {{ date('d/m/Y', strtotime($product->ngay_nhap)) }}</p>
        <p><strong>Mô tả:</strong> {!! nl2br(e($product->mo_ta)) !!}</p>
        <p><strong>Trạng thái:</strong> 
            @if ($product->trang_thai)
                <span class="badge bg-success">Đang bán</span>
            @else
                <span class="badge bg-danger">Ngừng bán</span>
            @endif
        </p>
        <p><strong>Hình ảnh:</strong></p>
        @if ($product->hinh_anh)
            <img src="{{ asset('storage/' . $product->hinh_anh) }}" width="200" alt="{{ $product->ten_san_pham }}">
        @else
            <p>Không có ảnh</p>
        @endif

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
</div>
@endsection