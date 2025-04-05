@extends('layouts.admin')

@section('title', 'Thêm danh mục')

@section('content')
    <h1 class="mb-4">Thêm danh mục</h1>

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
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                    <input type="text" name="ten_danh_muc" class="form-control" value="{{ old('ten_danh_muc') }}">
                </div>

                <div class="mb-3">
                    <label for="trang_thai" class="form-label">Trạng thái</label>
                    <select name="trang_thai" class="form-control" @error('trang_thai') is-invalid @enderror>
                        <option value="1" {{ old('trang_thai') == "1" ? 'selected' : '' }}>Đã xử lí</option>
                        <option value="0" {{ old('trang_thai') == "0" ? 'selected' : '' }}>Chưa xử lí</option>
                    </select>
                    @error('trang_thai')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
        </div>
    </div>
@endsection
