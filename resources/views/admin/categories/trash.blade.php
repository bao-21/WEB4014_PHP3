@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác Liên Hệ</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Ngày gửi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                    <td>{{ $category->ten_danh_muc }}</td>
                    <td>
                        @if ($category->trang_thai)
                            <span class="badge bg-success">Đã xử lý</span>
                        @else
                            <span class="badge bg-danger">Chưa xử lý</span>
                        @endif
                    </td>
                    <td>{{ date('d/m/Y', strtotime($category->created_at)) }}</td>
                        <td>
                            <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.categories.forceDelete', $category->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
@endsection
