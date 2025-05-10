<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tài khoản</h1>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <p>&copy; 2025 My App. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>