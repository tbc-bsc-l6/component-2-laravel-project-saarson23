<x-guest-layout>
    <div class="text-center">
        <h1 class="auth-title">Confirm Access</h1>
        <p class="text-muted small mb-5">This is a secure area. Please confirm your password to proceed.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="input-group">
            <i class="bi bi-lock-fill input-group-icon"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="current-password" autofocus>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                Confirm
            </button>
        </div>
        
        <div class="footer-links">
            <a href="{{ route('login') }}" class="auth-links small fw-bold">
                Back to Safety <i class="bi bi-shield-lock ms-1"></i>
            </a>
        </div>
    </form>
</x-guest-layout>