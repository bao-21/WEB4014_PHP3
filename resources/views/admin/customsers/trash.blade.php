@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác khách hàng</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customsers as $customser)
                    <tr>
                        <td>{{ $customser->id }}</td>
                        <td>{{ $customser->ten_khach_hang }}</td>
                        <td>{{ $customser->so_dien_thoai }}</td>
                        <td>{{ $customser->email }}</td>
                        <td>{{ $customser->dia_chi }}</td>
                        <td>
                            <form action="{{ route('admin.customsers.restore', $customser->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.customsers.forceDelete', $customser->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $customsers->links() }}
    </div>
@endsection
