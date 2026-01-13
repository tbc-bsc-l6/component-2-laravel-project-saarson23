<x-guest-layout>
    <div class="text-center">
        <h1 class="auth-title">Forgot Password</h1>
        <p class="text-muted small mb-5">Enter your email address and we will send you a link to reset your password.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <i class="bi bi-envelope-fill input-group-icon"></i>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" :value="old('email')" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                Send Reset Link
            </button>
        </div>

        <div class="footer-links">
            <a href="{{ route('login') }}" class="auth-links small fw-bold">
                Back to Login <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</x-guest-layout>
