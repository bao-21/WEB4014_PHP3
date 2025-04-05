@extends('layouts.admin')

@section('title', 'Thêm banner mới')

@section('content')
    <h1 class="mb-4">Thêm banner mới</h1>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="hinh_anh" class="form-label">Hình ảnh</label>
            <input type="file" name="hinh_anh" class="form-control @error('hinh_anh') is-invalid @enderror">
            @error('hinh_anh')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Thêm ảnh</button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
