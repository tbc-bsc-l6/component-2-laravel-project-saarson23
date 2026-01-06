{{-- resources/views/auth/reset-password.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top, #eef2ff, #e5e7eb);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 460px;
            padding: 1rem;
        }

        .auth-card {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(14px);
            border-radius: 22px;
            padding: 2.75rem;
            box-shadow: 0 30px 60px rgba(0,0,0,0.12);
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #eef2ff;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #6366f1;
        }

        .btn-reset {
            background: #4f46e5;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
        }

        .btn-reset:hover {
            background: #4338ca;
        }

        .helper-text {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header --}}
        <div class="text-center mb-4">
            <div class="brand-icon">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h4 class="fw-semibold mb-1">Reset your password</h4>
            <p class="text-muted mb-0">
                Choose a new secure password
            </p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-3">
                <label class="form-label fw-medium">
                    Email address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com"
                    required
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">
                    New password
                </label>
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Create a new password"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-medium">
                    Confirm password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirm your new password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-reset w-100 text-white">
                <i class="bi bi-check-circle me-1"></i>
                Reset Password
            </button>
        </form>

        {{-- Footer --}}
        <p class="helper-text text-center mt-4 mb-0">
            Remembered your password?
            <a href="{{ route('login') }}" class="link">Sign in</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
