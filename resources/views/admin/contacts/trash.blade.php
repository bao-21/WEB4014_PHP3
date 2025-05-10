@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác Liên Hệ</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tin nhắn</th>
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
                        <td>
                            <form action="{{ route('admin.contacts.restore', $contact->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.contacts.forceDelete', $contact->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $contacts->links() }}
    </div>
@endsection
