@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác bài viết</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ngày xuất bản</th>
                    <th>Hành động</th>
                </tr>    
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->tieu_de }}</td>
                        <td>{{ $post->tac_gia }}</td>
                        <td>{{ $post->xuat_ban }}</td>
                        <td>
                            <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.posts.forceDelete', $post->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links() }}
    </div>
@endsection
