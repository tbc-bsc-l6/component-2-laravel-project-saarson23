{{-- resources/views/teacher/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Teacher Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item"><i class="bi bi-house-door-fill mx-2 text-muted small"></i></li>
            <li class="breadcrumb-item active" aria-current="page">Teacher Dashboard</li>
        </ol>
    </nav>
</div>

<div class="row g-4 mb-4">
    {{-- Welcome Card --}}
    <div class="col-lg-8">
        <div class="card h-100 shadow-sm border-0 p-4" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
            <div class="d-flex align-items-center">
                <div>
                    <h3 class="fw-bold mb-2 text-dark">
                        Welcome back, {{ auth()->user()->name }} 👋
                    </h3>
                    <p class="text-muted mb-0">
                        Manage your assigned modules and track student enrollment progress in real-time.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Card --}}
    <div class="col-lg-4">
        <div class="card h-100 stat-card shadow-sm border-0">
            <div class="d-flex align-items-center h-100">
                <div class="stat-icon bg-blue-100 text-primary me-3" style="background-color: #e0e7ff; width: 60px; height: 60px;">
                    <i class="bi bi-journal-check fs-2"></i>
                </div>
                <div class="ms-auto text-end">
                    <div class="text-muted small fw-medium">Assigned Modules</div>
                    <div class="fs-1 fw-bold text-dark">{{ $modules->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark m-0">My Active Modules</h5>
            <button class="btn btn-light btn-sm"><i class="bi bi-filter me-1"></i> Filter</button>
        </div>

        <div class="row g-4">
            @forelse($modules as $module)
                @php
                    $capacity = 10;
                    $percentage = ($module->active_students_count / $capacity) * 100;
                    $statusColor = $percentage >= 100 ? 'danger' : ($percentage >= 80 ? 'warning' : 'success');
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="fw-bold text-dark mb-0 fs-5">
                                    {{ $module->module }}
                                </h6>
                                <span class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }} border-0 px-2 py-1">
                                    {{ $percentage >= 100 ? 'Full' : ($percentage >= 80 ? 'Closing' : 'Open') }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="bi bi-people-fill me-2"></i>
                                <span><strong>{{ $module->active_students_count }}</strong> students enrolled</span>
                                <span class="mx-2">•</span>
                                <span>Cap: {{ $capacity }}</span>
                            </div>

                            <div class="progress mb-4" style="height: 6px; border-radius: 3px;">
                                <div class="progress-bar bg-{{ $statusColor }}"
                                     style="width: {{ $percentage }}%">
                                </div>
                            </div>

                            <a href="{{ route('teacher.modules.show', $module) }}"
                               class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-2 py-2 fw-semibold">
                                <i class="bi bi-eye"></i>
                                View Roster
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-journal-x fs-1 text-muted opacity-25"></i>
                    </div>
                    <h5 class="text-muted">No modules assigned yet</h5>
                    <p class="text-muted small">Contact administration to update your teaching schedule.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
