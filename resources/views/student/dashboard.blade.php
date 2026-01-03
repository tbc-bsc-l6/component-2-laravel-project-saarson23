{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Welcome & Stats --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="fw-semibold mb-2">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h4>

                @if(auth()->user()->isStudent())
                    <p class="text-muted mb-3">
                        You are actively enrolled in
                        <strong>{{ $activeEnrollments->count() }}/4</strong> modules.
                    </p>

                    @if($activeEnrollments->count() < 4)
                        <a href="{{ route('student.enroll.index') }}"
                           class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>
                            Enroll in Module
                        </a>
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            You’ve reached the maximum active modules.
                        </div>
                    @endif
                @else
                    <p class="text-muted mb-0">
                        View your completed module history and results.
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="col-lg-4">
        <div class="row g-3">
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="fs-3 fw-bold text-primary">
                            {{ $activeEnrollments->count() }}
                        </div>
                        <div class="small text-muted">
                            Active
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="fs-3 fw-bold text-success">
                            {{ $completedEnrollments->count() }}
                        </div>
                        <div class="small text-muted">
                            Completed
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Current Modules --}}
@if(auth()->user()->isStudent() && $activeEnrollments->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="fw-semibold mb-3">Current Modules</h5>

            <div class="row g-4">
                @foreach($activeEnrollments as $enrollment)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-2">
                                    {{ $enrollment->module->module }}
                                </h6>

                                <p class="small text-muted mb-3">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Enrolled on {{ $enrollment->enrolled_at->format('M d, Y') }}
                                </p>

                                <span class="badge bg-primary-subtle text-primary">
                                    In Progress
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

{{-- Completed Modules --}}
@if($completedEnrollments->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">Recently Completed</h5>
                    <a href="{{ route('student.history') }}"
                       class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Module</th>
                                    <th>Enrolled</th>
                                    <th>Completed</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedEnrollments->take(5) as $enrollment)
                                    <tr>
                                        <td class="fw-medium">
                                            {{ $enrollment->module->module }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $enrollment->enrolled_at->format('M d, Y') }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $enrollment->completed_at->format('M d, Y') }}
                                        </td>
                                        <td>
                                            @if($enrollment->status === 'pass')
                                                <span class="badge bg-success-subtle text-success">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Pass
                                                </span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Fail
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    @if(auth()->user()->isStudent())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-1"></i>
                    You haven’t completed any modules yet — keep going!
                </div>
            </div>
        </div>
    @endif
@endif

@endsection
