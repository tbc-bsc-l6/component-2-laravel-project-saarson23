<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="text-center">
        <h1 class="auth-title">Verify Email</h1>
    </div>

    <div class="mb-4 text-center small text-muted">
        Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="d-grid gap-2 mb-4">
        <button wire:click="sendVerification" type="button" class="btn btn-primary">
            RESEND VERIFICATION EMAIL
        </button>
    </div>

    <div class="footer-links">
        <button wire:click="logout" type="submit" class="auth-links small fw-bold" style="background: none; border: none; cursor: pointer;">
            Log Out <i class="bi bi-arrow-right ms-1"></i>
        </button>
    </div>
</div>
