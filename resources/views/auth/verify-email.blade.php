<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify email • College CMS</title>

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
                radial-gradient(circle at 20% 10%, rgba(37,99,235,.18), transparent 40%),
                radial-gradient(circle at 80% 90%, rgba(99,102,241,.14), transparent 40%),
                var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e5e7eb;
        }

        .verify-shell {
            width: 100%;
            max-width: 520px;
            padding: 1rem;
        }

        .verify-card {
            background: linear-gradient(180deg, #020617, #020617),
                        linear-gradient(180deg, var(--card), var(--card));
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2.6rem;
            box-shadow: 0 30px 80px rgba(0,0,0,.45);
        }

        .icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 1rem;
        }

        .helper {
            font-size: .85rem;
            color: var(--muted);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: none;
            border-radius: 12px;
            padding: .75rem;
            font-weight: 600;
        }

        .btn-primary-custom:hover {
            opacity: .95;
        }

        .btn-outline {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="verify-shell">
    <div class="verify-card">

        {{-- Header --}}
        <div class="text-center mb-4">
            <div class="icon">
                <i class="bi bi-envelope-check-fill text-white"></i>
            </div>
            <h4 class="fw-semibold mb-1">Verify your email</h4>
            <p class="helper mb-0">
                One final step to activate your account
            </p>
        </div>

        {{-- Status --}}
        @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success py-2 small">
                <i class="bi bi-check-circle me-1"></i>
                A new verification link has been sent to your email address.
            </div>
        @endif

        {{-- Info --}}
        <div class="alert alert-info py-2 small">
            <i class="bi bi-info-circle me-1"></i>
            We’ve sent a verification email to your inbox.
            Please click the link inside to continue.
        </div>

        {{-- Resend --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary-custom w-100 mb-3 text-white">
                <i class="bi bi-send me-1"></i>
                Resend verification email
            </button>
        </form>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary w-100 btn-outline">
                <i class="bi bi-box-arrow-right me-1"></i>
                Log out
            </button>
        </form>

        {{-- Footer --}}
        <p class="helper text-center mt-4 mb-0">
            Didn’t receive the email? Check spam or promotions folder.
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
