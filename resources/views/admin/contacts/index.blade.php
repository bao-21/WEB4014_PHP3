@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Danh sách Liên Hệ</h2>

        <form action="{{ route('admin.contacts.index') }}" method="GET">
            <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <button type="submit">Tìm kiếm</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tin nhắn</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->ten_lien_he }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->tin_nhan }}</td>
                        <td>{{ $contact->trang_thai ? 'Đã xử lý' : 'Chưa xử lý' }}</td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact->id) }}">Xem</a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $contacts->links() }}
    </div>
@endsection
