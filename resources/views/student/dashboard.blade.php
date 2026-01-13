{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item"><i class="bi bi-house-door-fill mx-2 text-muted small"></i></li>
            <li class="breadcrumb-item active" aria-current="page">Student Dashboard</li>
        </ol>
    </nav>
</div>

{{-- Welcome & Stats --}}
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card h-100 shadow-sm border-0 p-4" style="background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);">
            <h3 class="fw-bold mb-2 text-dark">
                Welcome back, {{ auth()->user()->name }} 👋
            </h3>

            @if(auth()->user()->isStudent())
                <p class="text-muted mb-4">
                    You are actively enrolled in <strong>{{ $activeEnrollments->count() }}</strong> modules this semester.
                </p>

                @if($activeEnrollments->count() < 4)
                    <a href="{{ route('student.enroll.index') }}"
                       class="btn btn-primary px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle"></i>
                        Enroll in New Module
                    </a>
                @else
                    <div class="d-inline-flex align-items-center gap-2 text-warning fw-medium p-2 bg-warning-subtle rounded-3 small">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Maximum module capacity reached
                    </div>
                @endif
            @else
                <p class="text-muted mb-0">
                    Review your academic journey and module accomplishments.
                </p>
            @endif
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="col-lg-5">
        <div class="row h-100 g-3">
            <div class="col-6">
                <div class="card h-100 stat-card shadow-sm border-0 justify-content-center text-center p-3">
                    <div class="stat-icon bg-blue-100 text-primary mx-auto mb-2" style="background-color: #e0e7ff;">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="fs-2 fw-bold text-dark">{{ $activeEnrollments->count() }}</div>
                    <div class="text-muted small fw-medium">Active</div>
                </div>
            </div>
            <div class="col-6">
                <div class="card h-100 stat-card shadow-sm border-0 justify-content-center text-center p-3">
                    <div class="stat-icon bg-green-100 text-success mx-auto mb-2" style="background-color: #dcfce7;">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div class="fs-2 fw-bold text-dark">{{ $completedEnrollments->count() }}</div>
                    <div class="text-muted small fw-medium">Completed</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Current Modules --}}
@if(auth()->user()->isStudent() && $activeEnrollments->count() > 0)
    <div class="mb-4">
        <h5 class="fw-bold text-dark mb-3">Enrolled Courses</h5>
        <div class="row g-4">
            @foreach($activeEnrollments as $enrollment)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="fw-bold text-dark mb-0 fs-5">
                                    {{ $enrollment->module->module }}
                                </h6>
                                <span class="badge bg-primary-subtle text-primary border-0 px-2">Active</span>
                            </div>

                            <div class="d-flex align-items-center text-muted small mb-0">
                                <i class="bi bi-calendar-check me-2"></i>
                                <span>Enrolled {{ $enrollment->enrolled_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

{{-- Completed Modules --}}
@if($completedEnrollments->count() > 0)
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Recent Module History</h5>
            <a href="{{ route('student.history') }}" class="btn btn-light btn-sm fw-semibold">
                View Report Card
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted small uppercase fw-bold">
                            <th class="ps-4">Course Name</th>
                            <th>Enrolled</th>
                            <th>Completed</th>
                            <th class="pe-4">Final Grade</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark small">
                        @foreach($completedEnrollments->take(5) as $enrollment)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $enrollment->module->module }}</td>
                                <td class="text-muted">{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                <td class="text-muted">{{ $enrollment->completed_at->format('M d, Y') }}</td>
                                <td class="pe-4">
                                    @if($enrollment->status === 'pass')
                                        <span class="badge bg-success-subtle text-success border-0 px-3">Passed</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border-0 px-3">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    @if(auth()->user()->isStudent())
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <i class="bi bi-journals fs-1 text-muted opacity-25 mb-3 d-block"></i>
            <h5 class="text-muted">No completed modules yet</h5>
            <p class="text-muted small">Your academic results will appear here once finalized.</p>
        </div>
    @endif
@endif
@endsection
