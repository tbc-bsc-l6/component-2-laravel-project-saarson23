{{-- resources/views/auth/verify-email.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>

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
            max-width: 520px;
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
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #eef2ff;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1rem;
        }

        .btn-primary {
            background: #4f46e5;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #4338ca;
        }

        .helper-text {
            font-size: 0.85rem;
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header --}}
        <div class="text-center mb-4">
            <div class="brand-icon">
                <i class="bi bi-envelope-check-fill"></i>
            </div>
            <h4 class="fw-semibold mb-1">Verify your email</h4>
            <p class="text-muted mb-0">
                One last step before getting started
            </p>
        </div>

        {{-- Status --}}
        @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-1"></i>
                A new verification link has been sent to your email address.
            </div>
        @endif

        {{-- Info --}}
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-1"></i>
            Please check your inbox and click the verification link we sent you.
            If you didn’t receive the email, you can request another below.
        </div>

        {{-- Resend --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="bi bi-send me-1"></i>
                Resend Verification Email
            </button>
        </form>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary w-100">
                <i class="bi bi-box-arrow-right me-1"></i>
                Log Out
            </button>
        </form>

        {{-- Footer --}}
        <p class="helper-text text-center mt-4 mb-0">
            Didn’t see the email? Check your spam or promotions folder.
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
