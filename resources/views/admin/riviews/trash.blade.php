@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Thùng rác đánh giá</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nội dung</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Xếp hạng</th>
                    <th>Hành động</th>
                </tr>    
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ Str::limit($review->noi_dung, 50) }}</td> <!-- Limit content for display -->
                        <td>{{ $review->customer ? $review->customer->name : 'N/A' }}</td>
                        <td>{{ $review->product ? $review->product->ten_san_pham : 'N/A' }}</td>
                        <td>{{ $review->xep_hang }} sao</td>
                        <td>
                            <form action="{{ route('admin.riviews.restore', $review->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.riviews.forceDelete', $review->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reviews->links() }}
    </div>
@endsection