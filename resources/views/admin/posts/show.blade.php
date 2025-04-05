@extends('layouts.admin')

@section('title', 'Chi tiết bài viết')

@section('content')
    <h1 class="mb-4">Chi tiết bài viết</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin bài viết</h5>
        </div>
        <div class="card-body">
            <h1>{{ $post->tieu_de }}</h1>
            <p><strong>Tác giả:</strong> {{ $post->tac_gia }}</p>
            <p><strong>Ngày xuất bản:</strong> {{ $post->xuat_ban }}</p>
            <p><strong>Nội dung:</strong></p>
            <p>{{ $post->noi_dung }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline"
            onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này không?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Xóa liên hệ
            </button>
        </form>
    </div>
@endsection
