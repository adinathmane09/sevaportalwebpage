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
         <img src="{{ asset('images/gov-logo.png') }}" alt="Gov Logo" class="gov-logo">
        <h1> SevaPortal </h1>
        <p class="ee">Please login to admin dashboard</p>
        <form action="{{ route('admin.login') }}" method="POST" autocomplete="off">
            @csrf
            <input type="text" name="username" placeholder="Username" required autocomplete="off">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            @if ($errors->has('login'))
                <div class="error">{{ $errors->first('login') }}</div>
            @endif
            <button type="submit">Log In</button>
        </form>
    </div>

</body>
</html>
