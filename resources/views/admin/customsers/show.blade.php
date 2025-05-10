@extends('layouts.admin')

@section('title', 'Chi tiết liên hệ')

@section('content')
    <h1 class="mb-4">Chi tiết liên hệ</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin liên hệ</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20%;">Tên khách hàng:</th>
                    <td>{{ $customser->ten_khach_hang }}</td>
                </tr>
                <tr>
                    <th>Số điện thoại:</th>
                    <td>{{ $customser->so_dien_thoai }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $customser->email }}</td>
                </tr>
                <tr>
                    <th>Địa chỉ:</th>
                    <td>{{ $customser->dia_chi }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.customsers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        <form action="{{ route('admin.customsers.destroy', $customser->id) }}" method="POST" class="d-inline"
            onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này không?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Xóa liên hệ
            </button>
        </form>
    </div>
@endsection
