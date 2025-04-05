@extends('layouts.admin')

@section('title', 'Danh sách banner')

@section('content')
    <h1 class="mb-4">Danh sách banner</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <a href="{{ route('admin.banners.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <a href="{{ route('admin.banners.trash') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-trash"></i> Thùng rác
    </a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>

                    <td>
                        @if ($banner->hinh_anh)
                            <img src="{{ asset('storage/' . $banner->hinh_anh) }}" alt="ảnh"
                                width="100">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{  route('admin.banners.destroy', $banner->id)  }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa không?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-end mt-3">
        {{ $banners->links('pagination::bootstrap-4') }}
    </div>
@endsection
