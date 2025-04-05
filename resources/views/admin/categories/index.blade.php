@extends('layouts.admin')

@section('title', 'Danh sách danh mục')

@section('content')
    <h1 class="mb-4">Danh sách danh mục</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm danh mục</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.categories.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="ten_danh_muc" class="form-control" placeholder="Nhập tên danh mục" value="{{ request('ten_danh_muc') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-control">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Đã xử lý</option>
                            <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Chưa xử lý</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <!-- Nút đến Thùng rác -->
    <a href="{{ route('admin.categories.trash') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-trash"></i> Thùng rác
    </a>


    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Ngày gửi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->ten_danh_muc }}</td>
                    <td>
                        @if ($category->trang_thai)
                            <span class="badge bg-success">Đã xử lý</span>
                        @else
                            <span class="badge bg-danger">Chưa xử lý</span>
                        @endif
                    </td>
                    <td>{{ date('d/m/Y', strtotime($category->created_at)) }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
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
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
@endsection
