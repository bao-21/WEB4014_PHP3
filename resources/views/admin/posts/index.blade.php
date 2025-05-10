@extends('layouts.admin')

@section('title', 'Danh sách bài viêt')

@section('content')
    <h1 class="mb-4">Danh sách bài viết</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm bài viết</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.posts.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tên bài viết</label>
                        <input type="text" name="search" class="form-control" 
                   placeholder="Nhập tiêu đề bài viết..." 
                   value="{{ request('search') }}">
                    </div>
                    
                    <div class="col-md-4 align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.customsers.index') }}" class="btn btn-secondary w-100 ms-1">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <!-- Nút đến Thùng rác -->
    <a href="{{ route('admin.posts.trash') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-trash"></i> Thùng rác
    </a>


    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Ngày xuất bản</th>
                <th>Hành động</th>
            </tr>    
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->tieu_de }}</td>
                    <td>{{ $post->tac_gia }}</td>
                    <td>{{ $post->xuat_ban }}</td>
                    <td>
                        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
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
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection
