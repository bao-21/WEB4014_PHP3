@extends('layouts.admin')

@section('title', 'Sửa liên hệ')

@section('content')
    <h1 class="mb-4">Sửa liên hệ</h1>

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
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                    <input type="text" name="ten_danh_muc" class="form-control" value="{{ old('ten_danh_muc', $category->ten_danh_muc) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="trang_thai" class="form-control">
                        <option value="0" {{ $category->trang_thai == 0 ? 'selected' : '' }}>Chưa xử lý</option>
                        <option value="1" {{ $category->trang_thai == 1 ? 'selected' : '' }}>Đã xử lý</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
        </div>
    </div>
@endsection
