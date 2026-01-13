<x-guest-layout>
    <div class="text-center">
        <h1 class="auth-title">Member Login</h1>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <i class="bi bi-envelope-fill input-group-icon"></i>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" :value="old('email')" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <i class="bi bi-lock-fill input-group-icon"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>

        <div class="text-center mb-5">
            <span class="small text-muted">Forgot</span>
            <a href="{{ route('password.request') }}" class="auth-links small fw-bold">Username / Password?</a>
        </div>

        <div class="footer-links">
            <a href="{{ route('register') }}" class="auth-links small fw-bold">
                Create your Account <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</x-guest-layout>
