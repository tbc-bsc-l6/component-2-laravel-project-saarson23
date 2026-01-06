{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

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
            max-width: 480px;
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

        .btn-register {
            background: #4f46e5;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
        }

        .btn-register:hover {
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
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h4 class="fw-semibold mb-1">Create your account</h4>
            <p class="text-muted mb-0">
                Join the College Management System
            </p>
        </div>

        {{-- Errors --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

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
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">
                    Full name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="John Doe"
                    required
                    autofocus
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">
                    Email address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Create a password"
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
                    placeholder="Confirm your password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-register w-100 text-white">
                <i class="bi bi-person-plus me-1"></i>
                Create Account
            </button>
        </form>

        {{-- Footer --}}
        <p class="helper-text text-center mt-4 mb-0">
            Already have an account?
            <a href="{{ route('login') }}" class="link">Sign in</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
