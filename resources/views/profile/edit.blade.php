@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-fluid px-4 py-4">
    <h2 class="fw-bold mb-4 text-dark">{{ __('Profile') }}</h2>

    <div class="row g-4 justify-content-center">
        <!-- Update Profile Information -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
