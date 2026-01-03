{{-- resources/views/admin/teachers/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Teacher')
@section('page-title', 'Create New Teacher')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-5 col-md-7">
        <div class="card border-0 shadow-sm rounded-4">

            {{-- Header --}}
            <div class="card-header bg-white border-0 text-center pt-4">
                <h4 class="fw-semibold mb-1">Add New Teacher</h4>
                <p class="text-muted small mb-0">
                    Create a teacher account and assign modules later
                </p>
            </div>

            <div class="card-body px-4 py-4">
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium">
                            Full Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            placeholder="e.g. Jane Doe"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium">
                            Email Address
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="teacher@example.com"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium">
                            Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Minimum 8 characters
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin.teachers.index') }}"
                           class="btn btn-outline-secondary px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-person-plus me-1"></i>
                            Create Teacher
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
