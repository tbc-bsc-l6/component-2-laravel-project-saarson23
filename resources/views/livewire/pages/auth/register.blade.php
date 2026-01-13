<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center">
        <h1 class="auth-title">Member Register</h1>
    </div>

    <form wire:submit="register">
        <!-- Name -->
        <div class="input-group">
            <i class="bi bi-person-fill input-group-icon"></i>
            <input wire:model="name" id="name" class="form-control" type="text" name="name" placeholder="Full Name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <i class="bi bi-envelope-fill input-group-icon"></i>
            <input wire:model="email" id="email" class="form-control" type="email" name="email" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <i class="bi bi-lock-fill input-group-icon"></i>
            <input wire:model="password" id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <i class="bi bi-shield-fill-check input-group-icon"></i>
            <input wire:model="password_confirmation" id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                REGISTER
            </button>
        </div>

        <div class="footer-links">
            <a href="{{ route('login') }}" class="auth-links small fw-bold" wire:navigate>
                Already have an Account? <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</div>
