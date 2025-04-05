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

    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

       
        <div class="mb-3">
            <label for="hinh_anh" class="form-label">Hình ảnh</label>
            @if ($banner->hinh_anh)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $banner->hinh_anh) }}" width="100" alt="Ảnh ">
                </div>
            @endif
            <input type="file" name="hinh_anh" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
