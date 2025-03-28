@extends('layouts.admin')

@section('title', 'Danh sách liên hệ')

@section('content')
    <h1 class="mb-4">Danh sách liên hệ</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm liên hệ</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.contacts.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tên liên hệ</label>
                        <input type="text" name="ten_lien_he" class="form-control" placeholder="Nhập tên liên hệ"
                            value="{{ request('ten_lien_he') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email"
                            value="{{ request('email') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-control">
                            <option value="">-- Trạng thái --</option>
                            <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Đã xử lý</option>
                            <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Chưa xử lý</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ngày gửi</label>
                        <input type="date" name="ngay_gui" class="form-control"
                            value="{{ request('ngay_gui') }}">
                    </div>
                    <div class="col-md-4 align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary w-100 ms-1">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('admin.contacts.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <!-- Nút đến Thùng rác -->
    <a href="{{ route('admin.contacts.trash') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-trash"></i> Thùng rác
    </a>


    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên liên hệ</th>
                <th>Email</th>
                <th>Tin nhắn</th>
                <th>Trạng thái</th>
                <th>Ngày gửi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->ten_lien_he }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ Str::limit($contact->tin_nhan, 50) }}</td>
                    <td>
                        @if ($contact->trang_thai)
                            <span class="badge bg-success">Đã xử lý</span>
                        @else
                            <span class="badge bg-danger">Chưa xử lý</span>
                        @endif
                    </td>
                    <td>{{ date('d/m/Y', strtotime($contact->created_at)) }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
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
        {{ $contacts->links('pagination::bootstrap-4') }}
    </div>
@endsection
