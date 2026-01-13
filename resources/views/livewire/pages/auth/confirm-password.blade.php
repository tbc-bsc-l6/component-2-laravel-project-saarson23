<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center">
        <h1 class="auth-title">Confirm Password</h1>
    </div>

    <div class="mb-4 text-center small text-muted">
        This is a secure area. Please confirm your password before continuing.
    </div>

    <form wire:submit="confirmPassword">
        <!-- Password -->
        <div class="input-group">
            <i class="bi bi-lock-fill input-group-icon"></i>
            <input wire:model="password" id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                CONFIRM
            </button>
        </div>
    </form>
</div>
