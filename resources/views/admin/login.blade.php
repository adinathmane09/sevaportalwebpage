<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            @if ($errors->has('login'))
                <div class="error">{{ $errors->first('login') }}</div>
            @endif
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>
