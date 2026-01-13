<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center">
        <h1 class="auth-title">Assasin School</h1>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div class="input-group" align="center">
            <i class="bi bi-envelope-fill input-group-icon"></i>
            <input wire:model="form.email" id="email" class="form-control" type="email" name="email" placeholder="Email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group" align="center">
            <i class="bi bi-lock-fill input-group-icon"></i>
            <input wire:model="form.password" id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                LOGIN
            </button>
        </div>

        <div class="text-center mb-3">
            @if (Route::has('password.request'))
                <a class="auth-links small" href="{{ route('password.request') }}" wire:navigate>
                    Forgot Username / Password?
                </a>
            @endif
        </div>

        <div class="footer-links">
            <a href="{{ route('register') }}" class="auth-links small fw-bold" wire:navigate>
                Create your Account <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</div>
