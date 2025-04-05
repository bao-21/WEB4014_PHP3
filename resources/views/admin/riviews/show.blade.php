@extends('layouts.admin')

@section('title', 'Chi tiết đánh giá')

@section('content')
    <h1 class="mb-4">Chi tiết Đánh Giá</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thông tin đánh giá</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $riview->id }}</td>
                </tr>
                <tr>
                    <th>Khách hàng</th>
                    <td>{{ $riview->customer->ten_khach_hang ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Sản phẩm</th>
                    <td>{{ $riview->product->ten_san_pham ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Nội dung</th>
                    <td>{{ $riview->noi_dung }}</td>
                </tr>
                <tr>
                    <th>Xếp hạng</th>
                    <td>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $riview->xep_hang)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        @endfor
                        ({{ $riview->xep_hang }}/5)
                    </td>
                </tr>
                <tr>
                    <th>Ngày tạo</th>
                    <td>{{ date('d/m/Y H:i', strtotime($riview->created_at)) }}</td>
                </tr>
                <tr>
                    <th>Ngày cập nhật</th>
                    <td>{{ date('d/m/Y H:i', strtotime($riview->updated_at)) }}</td>
                </tr>
            </table>
            <a href="{{ route('admin.riviews.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            
        </div>
    </div>
@endsection
