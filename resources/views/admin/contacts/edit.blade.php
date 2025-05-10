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
            <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên liên hệ <span class="text-danger">*</span></label>
                    <input type="text" name="ten_lien_he" class="form-control" value="{{ old('ten_lien_he', $contact->ten_lien_he) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai', $contact->so_dien_thoai) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tin nhắn <span class="text-danger">*</span></label>
                    <textarea name="tin_nhan" class="form-control" rows="4">{{ old('tin_nhan', $contact->tin_nhan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="trang_thai" class="form-control">
                        <option value="0" {{ $contact->trang_thai == 0 ? 'selected' : '' }}>Chưa xử lý</option>
                        <option value="1" {{ $contact->trang_thai == 1 ? 'selected' : '' }}>Đã xử lý</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
        </div>
    </div>
@endsection
