<x-guest-layout>
    <div class="text-center">
        <h1 class="auth-title">Member Register</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group">
            <i class="bi bi-person-fill input-group-icon"></i>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" :value="old('name')" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <i class="bi bi-envelope-fill input-group-icon"></i>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" :value="old('email')" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <i class="bi bi-lock-fill input-group-icon"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <i class="bi bi-shield-fill-check input-group-icon"></i>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>

        <div class="footer-links">
            <a href="{{ route('login') }}" class="auth-links small fw-bold">
                Already have an Account? <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</x-guest-layout>
