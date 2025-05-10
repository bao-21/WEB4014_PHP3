@extends('layouts.admin')

@section('title', 'Chi tiết danh mục')

@section('content')
    <h1 class="mb-4">Chi tiết danh mục</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin danh mục</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20%;">Tên danh mục:</th>
                    <td>{{ $category->ten_danh_muc }}</td>
                </tr>
                <tr>
                    <th>Ngày gửi:</th>
                    <td>{{ date('d/m/Y H:i', strtotime($category->created_at)) }}</td>
                </tr>
                <tr>
                    <th>Trạng thái:</th>
                    <td>
                        @if ($category->trang_thai)
                            <span class="badge bg-success">Đã xử lý</span>
                        @else
                            <span class="badge bg-danger">Chưa xử lý</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline"
            onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này không?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Xóa liên hệ
            </button>
        </form>
    </div>
@endsection
