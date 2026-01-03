{{-- resources/views/student/enroll.blade.php --}}
@extends('layouts.app')

@section('title', 'Enroll in Modules')
@section('page-title', 'Enroll')

@section('content')

{{-- Enrollment Overview --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="fw-semibold mb-2">
                    Enroll in New Modules
                </h4>

                <p class="text-muted mb-3">
                    You are currently enrolled in
                    <strong>{{ $activeCount }}/4</strong> active modules.
                </p>

                <div class="progress mb-2" style="height: 10px;">
                    <div class="progress-bar bg-primary"
                         style="width: {{ ($activeCount / 4) * 100 }}%">
                    </div>
                </div>

                <small class="text-muted">
                    Maximum allowed: 4 modules
                </small>
            </div>
        </div>
    </div>

    {{-- Status --}}
    <div class="col-lg-4">
        <div class="card h-100 text-center">
            <div class="card-body d-flex flex-column justify-content-center">
                @if($canEnroll)
                    <div class="fs-1 text-success mb-2">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h6 class="fw-semibold">Enrollment Open</h6>
                    <p class="text-muted mb-0">
                        You can enroll in more modules.
                    </p>
                @else
                    <div class="fs-1 text-warning mb-2">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h6 class="fw-semibold">Limit Reached</h6>
                    <p class="text-muted mb-0">
                        Complete a module to continue.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Available Modules --}}
@if($canEnroll)
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="fw-semibold mb-3">
                Available Modules
            </h5>

            @if($availableModules->count() > 0)
                <div class="row g-4">
                    @foreach($availableModules as $module)
                        @php
                            $enrolled = $module->activeStudents()->count();
                            $capacity = 10;
                            $percentage = ($enrolled / $capacity) * 100;
                            $spotsLeft = $capacity - $enrolled;
                        @endphp

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">

                                    <h6 class="fw-semibold mb-2">
                                        {{ $module->module }}
                                    </h6>

                                    <p class="small text-muted mb-2">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $enrolled }} / {{ $capacity }} students enrolled
                                    </p>

                                    {{-- Capacity Bar --}}
                                    <div class="progress mb-3" style="height: 8px;">
                                        <div class="progress-bar
                                            {{ $percentage >= 80 ? 'bg-warning' : 'bg-success' }}"
                                             style="width: {{ $percentage }}%">
                                        </div>
                                    </div>

                                    @if($spotsLeft > 0)
                                        <span class="badge bg-success-subtle text-success mb-3 align-self-start">
                                            {{ $spotsLeft }} {{ Str::plural('spot', $spotsLeft) }} left
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger mb-3 align-self-start">
                                            Full
                                        </span>
                                    @endif

                                    <form action="{{ route('student.enroll.store') }}" method="POST" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="module_id" value="{{ $module->id }}">

                                        <button type="submit"
                                                class="btn btn-primary w-100"
                                                {{ $spotsLeft === 0 ? 'disabled' : '' }}>
                                            <i class="bi bi-plus-circle me-1"></i>
                                            Enroll
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-1"></i>
                    No modules are currently available. Please check back later.
                </div>
            @endif
        </div>
    </div>
@else
    {{-- Enrollment Locked --}}
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle me-1"></i>
                You’ve reached the maximum of 4 active modules.
                Complete a module to enroll in new ones.
            </div>
        </div>
    </div>
@endif

@endsection
