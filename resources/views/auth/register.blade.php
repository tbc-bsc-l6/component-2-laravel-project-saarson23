<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account • College CMS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --bg: #020617;
            --card: #0f172a;
            --muted: #94a3b8;
            --border: #1e293b;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 15% 10%, rgba(37,99,235,.18), transparent 40%),
                radial-gradient(circle at 85% 90%, rgba(99,102,241,.14), transparent 40%),
                var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e5e7eb;
        }

        .register-shell {
            width: 100%;
            max-width: 460px;
            padding: 1rem;
        }

        .register-card {
            background: linear-gradient(180deg, #020617, #020617),
                        linear-gradient(180deg, var(--card), var(--card));
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2.6rem;
            box-shadow: 0 30px 80px rgba(0,0,0,.45);
        }

        .logo {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 1rem;
        }

        .form-label {
            font-size: .85rem;
            font-weight: 500;
            color: var(--muted);
        }

        .form-control {
            background: #020617;
            border: 1px solid var(--border);
            color: #fff;
            border-radius: 10px;
            padding: .7rem .9rem;
        }

        .form-control:focus {
            background: #020617;
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 .15rem rgba(37,99,235,.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: none;
            border-radius: 12px;
            padding: .75rem;
            font-weight: 600;
        }

        .btn-register:hover {
            opacity: .95;
        }

        .helper {
            font-size: .8rem;
            color: var(--muted);
        }

        .link {
            color: #93c5fd;
            text-decoration: none;
            font-weight: 500;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-shell">
    <div class="register-card">

        {{-- Header --}}
        <div class="text-center mb-4">
            <h4 class="fw-semibold mb-1">Create your account</h4>
            <p class="helper mb-0">
                Get started with College CMS
            </p>
        </div>

        {{-- Errors --}}
        @if(session('error'))
            <div class="alert alert-danger py-2 small">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
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
                <label class="form-label">Full name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="form-control"
                       placeholder="Your name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control"
                       placeholder="you@college.com"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Create a strong password"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Repeat password"
                       required>
            </div>

            <button class="btn btn-register w-100 text-white">
                <i class="bi bi-person-plus me-1"></i>
                Create account
            </button>
        </form>

        {{-- Footer --}}
        <p class="helper text-center mt-4 mb-0">
            Already have an account?
            <a href="{{ route('login') }}" class="link">Sign in</a>
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
