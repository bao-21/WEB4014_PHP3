@extends('layouts.admin')

@section('title', 'Thêm Đánh Giá')

@section('content')
    <h1 class="mb-4">Thêm Đánh Giá Mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.riviews.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nội Dung</label>
                    <textarea name="noi_dung" class="form-control" rows="3">{{ old('noi_dung') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Khách Hàng</label>
                    <select name="customer_id" class="form-control">
                        <option value="">-- Chọn Khách Hàng --</option>
                        @foreach ($customsers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->ten_khach_hang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sản Phẩm</label>
                    <select name="product_id" class="form-control">
                        <option value="">-- Chọn Sản Phẩm --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->ten_san_pham }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Xếp Hạng</label>
                    <select name="xep_hang" class="form-control">
                        <option value="1" {{ old('xep_hang') == 1 ? 'selected' : '' }}>1 Sao</option>
                        <option value="2" {{ old('xep_hang') == 2 ? 'selected' : '' }}>2 Sao</option>
                        <option value="3" {{ old('xep_hang') == 3 ? 'selected' : '' }}>3 Sao</option>
                        <option value="4" {{ old('xep_hang') == 4 ? 'selected' : '' }}>4 Sao</option>
                        <option value="5" {{ old('xep_hang') == 5 ? 'selected' : '' }}>5 Sao</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                <a href="{{ route('admin.riviews.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay Lại</a>
            </form>
        </div>
    </div>
@endsection
