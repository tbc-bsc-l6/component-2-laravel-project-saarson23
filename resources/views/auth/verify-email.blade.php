<x-guest-layout>
    <div class="text-center">
        <div class="mb-4">
            <i class="bi bi-envelope-open-fill" style="font-size: 3rem; color: var(--primary-green);"></i>
        </div>
        <h1 class="auth-title">Email Verification</h1>
        <p class="text-muted small mb-5">Thanks for signing up! Please verify your email address by clicking on the link we just emailed to you.</p>
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success small mb-4 text-center" style="border-radius: 25px; background-color: var(--input-bg); border: none; color: var(--primary-green); font-weight: 600;">
            A new verification link has been sent to your email.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">
                Resend Email
            </button>
        </div>
    </form>

    <div class="footer-links">
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-link auth-links small fw-bold text-decoration-none p-0">
                Log Out <i class="bi bi-box-arrow-right ms-1"></i>
            </button>
        </form>
    </div>
</x-guest-layout>