<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div style="text-align: center; margin-top: 100px;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="text-center">Forgot Password</h1>

                @if (session('message'))
                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                @endif

                <form method="POST" action="">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                    </div>
                </form>

                <p class="text-center"><a href="{{ route('admin.login') }}">Back to Login</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

