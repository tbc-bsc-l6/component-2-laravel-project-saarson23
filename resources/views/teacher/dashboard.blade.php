{{-- resources/views/teacher/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Teacher Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Welcome & Overview --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="fw-semibold mb-2">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h4>
                <p class="text-muted mb-0">
                    Manage your assigned modules and track student enrollment.
                </p>
            </div>
        </div>
    </div>

    {{-- Summary --}}
    <div class="col-lg-4">
        <div class="card h-100 text-center">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="fs-2 fw-bold text-primary">
                    {{ $modules->count() }}
                </div>
                <div class="text-muted">
                    Assigned Modules
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modules --}}
<div class="row">
    <div class="col-12">
        <h5 class="fw-semibold mb-3">My Modules</h5>

        <div class="row g-4">
            @forelse($modules as $module)
                @php
                    $capacity = 10;
                    $percentage = ($module->active_students_count / $capacity) * 100;
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">

                            {{-- Module Title --}}
                            <h6 class="fw-semibold mb-2">
                                {{ $module->module }}
                            </h6>

                            {{-- Students --}}
                            <p class="small text-muted mb-2">
                                <i class="bi bi-people me-1"></i>
                                {{ $module->active_students_count }} / {{ $capacity }} active students
                            </p>

                            {{-- Capacity --}}
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar
                                    {{ $percentage >= 80 ? 'bg-warning' : 'bg-primary' }}"
                                     style="width: {{ $percentage }}%">
                                </div>
                            </div>

                            {{-- Status --}}
                            @if($percentage >= 100)
                                <span class="badge bg-danger-subtle text-danger mb-3 align-self-start">
                                    Full
                                </span>
                            @elseif($percentage >= 80)
                                <span class="badge bg-warning-subtle text-warning mb-3 align-self-start">
                                    Nearly Full
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success mb-3 align-self-start">
                                    Available
                                </span>
                            @endif

                            {{-- Action --}}
                            <a href="{{ route('teacher.modules.show', $module) }}"
                               class="btn btn-outline-primary mt-auto w-100">
                                <i class="bi bi-eye me-1"></i>
                                View Students
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-1"></i>
                        You don’t have any modules assigned yet.
                        Please contact an administrator.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
