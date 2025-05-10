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

            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tieu_de" class="form-label">Tiêu đề:</label>
                    <input type="text" name="tieu_de" class="form-control" value="{{ old('tieu_de', $post->tieu_de) }}" >
                </div>


                    <label for="noi_dung" class="form-label">Nội dung:</label>
                    <textarea name="noi_dung" class="form-control"  rows="4">{{ old('noi_dung', $post->noi_dung) }}</textarea>


                <div class="mb-3">
                    <label for="tac_gia" class="form-label">Tác giả:</label>
                    <input type="text" name="tac_gia" class="form-control" value="{{ old('tac_gia', $post->tac_gia) }}" >
                </div>

                <div class="mb-3">
                    <label for="xuat_ban" class="form-label">Ngày xuất bản:</label>
                    <input type="date" name="xuat_ban" class="form-control"
                    value="{{ old('xuat_ban', $post->xuat_ban)}}" >
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
@endsection
