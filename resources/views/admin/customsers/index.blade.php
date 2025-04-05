@extends('layouts.admin')

@section('title', 'Danh sách khách hàng')

@section('content')
    <h1 class="mb-4">Danh sách khách hàng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm khách hàng</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.customsers.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tên khách hàng</label>
                        <input type="text" name="ten_khach_hang" class="form-control" placeholder="Nhập tên khách hàng"
                            value="{{ request('ten_khach_hang') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Số điện thoại</label>
                        <input type="so_dien_thoai" name="so_dien_thoai" class="form-control" placeholder="Nhập số điện thoại"
                            value="{{ request('so_dien_thoai') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email"
                            value="{{ request('email') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="dia_chi" class="form-control" placeholder="Nhập tên địa chỉ"
                            value="{{ request('dia_chi') }}">
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
    <a href="{{ route('admin.customsers.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <!-- Nút đến Thùng rác -->
    <a href="{{ route('admin.customsers.trash') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-trash"></i> Thùng rác
    </a>


    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customsers as $customser)
                <tr>
                    <td>{{ $customser->id }}</td>
                    <td>{{ $customser->ten_khach_hang }}</td>
                    <td>{{ $customser->so_dien_thoai }}</td>
                    <td>{{ $customser->email }}</td>
                    <td>{{ $customser->dia_chi }}</td>
                    <td>
                        <a href="{{ route('admin.customsers.show', $customser->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        <a href="{{ route('admin.customsers.edit', $customser->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.customsers.destroy', $customser->id) }}" method="POST"
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
        {{ $customsers->links('pagination::bootstrap-4') }}
    </div>
@endsection
