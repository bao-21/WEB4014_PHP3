@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-container">
    <h2>Đăng ký</h2>
    @if ($errors->any())
        <div class="alert alert-danner" >
            <ul class="mb-0" >
                @foreach ($errors->all() as $error)
                    <li>{{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Họ tên:</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name') }}" 
                   class="form-control @error('name') is-invalid @enderror" 
                   required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email') }}" 
                   class="form-control @error('email') is-invalid @enderror" 
                   required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                   class="form-control" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Đăng ký</button>
            <a href="{{ route('login') }}" class="btn btn-link">Đăng nhập</a>
        </div>
    </form>
</div>
@endsection