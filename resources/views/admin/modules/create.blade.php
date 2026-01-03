{{-- resources/views/admin/modules/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Module')
@section('page-title', 'Create New Module')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-lg-5 col-md-7">
        <div class="card border-0 shadow-sm rounded-4">
            
            <div class="card-header bg-white border-0 text-center pt-4">
                <h4 class="fw-semibold mb-1">Create New Module</h4>
                <p class="text-muted small mb-0">
                    Add a new module to manage system features
                </p>
            </div>

            <div class="card-body px-4 py-4">
                <form action="{{ route('admin.modules.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="module" class="form-label fw-medium">
                            Module Name
                        </label>

                        <input
                            type="text"
                            class="form-control form-control-lg @error('module') is-invalid @enderror"
                            id="module"
                            name="module"
                            placeholder="e.g. User Management"
                            value="{{ old('module') }}"
                            required
                        >

                        @error('module')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-between gap-2">
                        <a href="{{ route('admin.modules.index') }}"
                           class="btn btn-outline-secondary px-4">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary px-4">
                            <i class="bi bi-plus-circle me-1"></i>
                            Create Module
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
