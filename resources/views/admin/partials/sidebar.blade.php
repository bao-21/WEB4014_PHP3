<div class="sidebar bg-dark text-light">
    <div class="sidebar-header text-center py-3">
        <h3>Quản trị viên</h3>
    </div>

    <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-boxes me-2"></i> Sản phẩm
        </a>
        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-th-list me-2"></i> Danh mục
        </a>
        <a href="{{ route('admin.customsers.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-user me-2"></i> Khách hàng
        </a>
        <a href="{{ route('admin.banners.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-image me-2"></i> Banners
        </a>
        <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-newspaper me-2"></i> Bài viết
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-envelope me-2"></i> Liên hệ
        </a>
        <a href="{{ route('admin.riviews.index') }}" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-star me-2"></i> Đánh giá
        </a>
        <a href="#" class="list-group-item list-group-item-action text-light">
            <i class="fas fa-cog me-2"></i> Cài đặt
        </a>
    </div>

    <div class="sidebar-footer text-center py-3">
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" href="" class="btn btn-danger w-75">
                <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
            </button>
        </form>
        
    </div>
</div>
