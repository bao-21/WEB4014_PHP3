@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-container">
    <h2>Đăng nhập</h2>
    @if ($errors->any())
        <div class="alert alert-danner" >
            <ul class="mb-0" >
                @foreach ($errors->all() as $error)
                    <li>{{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email') }}" 
                   class="form-control @error('email') is-invalid @enderror" 
                   >
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   >
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <a href="{{ route('register') }}" class="btn btn-link">Đăng ký</a>
        </div>
    </form>
</div>
@endsection