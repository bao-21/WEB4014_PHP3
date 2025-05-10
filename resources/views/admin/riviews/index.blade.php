@extends('layouts.admin')

@section('title', 'Danh sách đánh giá')

@section('content')
    <h1 class="mb-4">Danh sách đánh giá</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm đánh giá</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.riviews.index') }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nội dung đánh giá</label>
                        <input type="text" name="search" class="form-control" placeholder="Nhập nội dung đánh giá" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.riviews.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.riviews.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <a href="{{ route('admin.riviews.trash') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-trash"></i> Thùng rác
    </a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nội dung</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Xếp hạng</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riviews as $riview)
                <tr>
                    <td>{{ $riview->id }}</td>
                    <td>{{ $riview->noi_dung }}</td>
                    <td>{{ $riview->customer->ten_khach_hang ?? 'N/A' }}</td>
                    <td>{{ $riview->product->ten_san_pham ?? 'N/A' }}</td>
                    <td>{{ $riview->xep_hang }}/5</td>
                    <td>{{ date('d/m/Y', strtotime($riview->created_at)) }}</td>
                    <td>
                        <a href="{{ route('admin.riviews.show', $riview->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        <a href="{{ route('admin.riviews.edit', $riview->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.riviews.destroy', $riview->id) }}" method="POST"
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

    <div class="d-flex justify-content-end mt-3">
        {{ $riviews->links('pagination::bootstrap-4') }}
    </div>
@endsection
