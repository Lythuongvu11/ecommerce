<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
<div style="text-align: center; margin-top: 100px;">
    <h1>Forgot Password</h1>

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <button type="submit">Send Password Reset Link</button>
        </div>
    </form>

    <p><a href="{{ route('admin.login') }}">Back to Login</a></p>
</div>
</body>
</html>

