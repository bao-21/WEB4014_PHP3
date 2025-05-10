@extends('layouts.admin')

@section('title', 'Sửa liên hệ')

@section('content')
    <h1 class="mb-4">Sửa liên hệ</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.customsers.update', $customser->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên khách hàng <span class="text-danger">*</span></label>
                    <input type="text" name="ten_khach_hang" class="form-control" value="{{ old('ten_khach_hang', $customser->ten_khach_hang) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $customser->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai', $customser->so_dien_thoai) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" name="dia_chi" class="form-control" value="{{ old('dia_chi',$customser->dia_chi) }}">
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
        </div>
    </div>
@endsection
