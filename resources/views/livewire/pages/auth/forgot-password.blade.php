<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="text-center">
        <h1 class="auth-title">Forgot Password</h1>
    </div>

    <div class="mb-4 text-center small text-muted">
        Enter your email address and we'll send you a password reset link.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div class="input-group">
            <i class="bi bi-envelope-fill input-group-icon"></i>
            <input wire:model="email" id="email" class="form-control" type="email" name="email" placeholder="Email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="d-grid gap-2 mb-4">
            <button type="submit" class="btn btn-primary">
                SEND RESET LINK
            </button>
        </div>

        <div class="footer-links">
            <a href="{{ route('login') }}" class="auth-links small fw-bold" wire:navigate>
                Back to Login <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </form>
</div>
