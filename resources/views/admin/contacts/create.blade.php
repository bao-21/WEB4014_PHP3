@extends('layouts.admin')

@section('title', 'Thêm liên hệ')

@section('content')
    <h1 class="mb-4">Thêm liên hệ</h1>

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
            <form action="{{ route('admin.contacts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên liên hệ <span class="text-danger">*</span></label>
                    <input type="text" name="ten_lien_he" class="form-control" value="{{ old('ten_lien_he') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tin nhắn <span class="text-danger">*</span></label>
                    <textarea name="tin_nhan" class="form-control" rows="4">{{ old('tin_nhan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
        </div>
    </div>
@endsection
