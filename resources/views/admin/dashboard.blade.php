{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="row g-4 mt-3">

    {{-- Teachers --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary fs-3">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Teachers</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_teachers'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Students --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success fs-3">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Students</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_students'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modules --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-info fs-3">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Modules</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_modules'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Active Modules --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning fs-3">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="text-muted small">Active Modules</div>
                    <div class="fs-3 fw-semibold">{{ $stats['active_modules'] }}</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Welcome --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body px-4 py-4">
                <h4 class="fw-semibold mb-2">
                    Welcome back 
                </h4>
                <p class="text-muted mb-0">
                    Use the navigation menu to manage modules, teachers, and students.
                    This dashboard gives you a quick overview of your system.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
