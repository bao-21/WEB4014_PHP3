@extends('layouts.admin')

@section('title', 'Cập nhật sản phẩm')

@section('content')
    <h1 class="mb-4">Cập nhật sản phẩm</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
            <input type="text" name="ma_san_pham" class="form-control @error('ma_san_pham') is-invalid @enderror"
            value="{{ old('ma_san_pham',$product->ma_san_pham)}}" >
            @error('ma_san_pham')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
            <input type="text" name="ten_san_pham" class="form-control" @error('ten_san_pham') is-invalid @enderror
            value="{{ old('ten_san_pham',$product->ten_san_pham)}}">
            @error('ten_san_pham')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-control" @error('category_id') is-invalid @enderror >
            
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id',$product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->ten_danh_muc }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hinh_anh" class="form-label">Hình ảnh</label>
            @if ($product->hinh_anh)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->hinh_anh) }}" width="100" alt="Ảnh sản phẩm">
                </div>
            @endif
            <input type="file" name="hinh_anh" class="form-control">
        </div>

        <div class="mb-3">
            <label for="gia" class="form-label">Giá</label>
            <input type="number" name="gia" class="form-control" @error('gia') is-invalid @enderror
            value="{{ old('gia',$product->gia)}}">
            @error('gia')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
            <input type="number" name="gia_khuyen_mai" class="form-control"  @error('gia_khuyen_mai') is-invalid @enderror
            value="{{ old('gia_khuyen_mai',$product->gia_khuyen_mai)}}">
            @error('gia_khuyen_mai')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="so_luong" class="form-label">Số lượng</label>
            <input type="number" name="so_luong" class="form-control"  @error('so_luong') is-invalid @enderror
            value="{{ old('so_luong',$product->so_luong)}}">
            @error('so_luong')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
            <input type="date" name="ngay_nhap" class="form-control"  @error('ngay_nhap') is-invalid @enderror
            value="{{ old('ngay_nhap',$product->ngay_nhap)}}">
            @error('ngay_nhap')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô tả</label>
            <textarea name="mo_ta" class="form-control"  @error('mo_ta') is-invalid @enderror
            value="{{ old('mo_ta',$product->mo_ta)}}"></textarea>
            @error('mo_ta')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <select name="trang_thai" class="form-control" @error('trang_thai') is-invalid @enderror>
                <option value="1" {{ old('trang_thai',$product->trang_thai) == "1" ? 'selected' : '' }}>Đang bán</option>
                <option value="0" {{ old('trang_thai',$product->trang_thai) == "0" ? 'selected' : '' }}>Ngừng bán</option>
            </select>
            @error('trang_thai')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
