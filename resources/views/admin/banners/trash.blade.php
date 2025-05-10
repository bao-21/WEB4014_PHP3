@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác banner</h2>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
    
                        <td>
                            @if ($banner->hinh_anh)
                                <img src="{{ asset('storage/' . $banner->hinh_anh) }}" alt="ảnh"
                                    width="100">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.banners.restore', $banner->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.banners.forceDelete', $banner->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $banners->links() }}
    </div>
@endsection
