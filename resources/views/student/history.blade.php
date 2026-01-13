{{-- resources/views/student/history.blade.php --}}
@extends('layouts.app')

@section('title', 'Module History')
@section('page-title', 'Module History')

@section('content')

{{-- Overview --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="fw-semibold mb-2">
                    Learning History 📚
                </h4>
                <p class="text-muted mb-0">
                    Review all modules you’ve completed and track your progress.
                </p>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="col-lg-4">
        <div class="row g-3">
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="fs-3 fw-bold text-primary">
                            {{ $completedEnrollments->count() }}
                        </div>
                        <div class="small text-muted">Completed</div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="fs-3 fw-bold text-success">
                            {{ $completedEnrollments->where('status','pass')->count() }}
                        </div>
                        <div class="small text-muted">Passed</div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="fs-3 fw-bold text-danger">
                            {{ $completedEnrollments->where('status','fail')->count() }}
                        </div>
                        <div class="small text-muted">Failed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- History --}}
@if($completedEnrollments->count() > 0)
    <div class="row g-4">
        @foreach($completedEnrollments as $enrollment)
            @php
                $duration = $enrollment->enrolled_at->diffInDays($enrollment->completed_at);
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-semibold mb-0">
                                {{ $enrollment->module->module }}
                            </h6>

                            @if(!$enrollment->module->is_available)
                                <span class="badge bg-secondary-subtle text-secondary">
                                    Archived
                                </span>
                            @endif
                        </div>

                        {{-- Dates --}}
                        <p class="small text-muted mb-2">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $enrollment->enrolled_at->format('M d, Y') }}
                            →
                            {{ $enrollment->completed_at->format('M d, Y') }}
                        </p>

                        {{-- Duration --}}
                        <p class="small text-muted mb-3">
                            <i class="bi bi-clock-history me-1"></i>
                            {{ $duration }} {{ Str::plural('day', $duration) }}
                        </p>

                        {{-- Status --}}
                        <div class="mt-auto">
                            @if($enrollment->status === 'pass')
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Passed
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Failed
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- Empty State --}}
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-1"></i>
                You haven’t completed any modules yet. Keep learning!
            </div>
        </div>
    </div>
@endif

@endsection
