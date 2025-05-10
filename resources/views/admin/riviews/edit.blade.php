@extends('layouts.admin')

@section('title', 'Chỉnh sửa Đánh giá')

@section('content')
    <h1 class="mb-4">Chỉnh sửa Đánh giá</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.riviews.update', $riview->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nội dung đánh giá</label>
                    <textarea name="noi_dung" class="form-control" required>{{ old('noi_dung', $riview->noi_dung) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Xếp hạng</label>
                    <select name="xep_hang" class="form-control" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $riview->xep_hang == $i ? 'selected' : '' }}>
                                {{ $i }} sao
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Khách hàng</label>
                    <select name="customer_id" class="form-control" required>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $riview->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sản phẩm</label>
                    <select name="product_id" class="form-control" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $riview->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->ten_san_pham }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.riviews.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection