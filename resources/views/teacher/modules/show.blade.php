{{-- resources/views/teacher/modules/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Module Overview')
@section('page-title', $module->module)

@section('content')

{{-- Header --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="fw-semibold mb-1">
                    {{ $module->module }}
                </h4>
                <p class="text-muted mb-0">
                    <i class="bi bi-people me-1"></i>
                    {{ $students->where('status','enrolled')->count() }} active students
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100 text-center">
            <div class="card-body d-flex flex-column justify-content-center">
                <a href="{{ route('teacher.dashboard') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Statistics --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-2 fw-bold text-primary">
                    {{ $students->where('status','enrolled')->count() }}
                </div>
                <div class="text-muted">Enrolled</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-2 fw-bold text-success">
                    {{ $students->where('status','pass')->count() }}
                </div>
                <div class="text-muted">Passed</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-2 fw-bold text-danger">
                    {{ $students->where('status','fail')->count() }}
                </div>
                <div class="text-muted">Failed</div>
            </div>
        </div>
    </div>
</div>

{{-- Student List --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="fw-semibold mb-0">
                    Students
                </h5>
            </div>

            <div class="card-body p-0">
                @forelse($students as $enrollment)
                    <div class="border-bottom p-3">
                        <div class="row align-items-center g-3">

                            {{-- Student Info --}}
                            <div class="col-md-4">
                                <div class="fw-semibold">
                                    {{ $enrollment->user->name }}
                                </div>
                                <div class="small text-muted">
                                    {{ $enrollment->user->email }}
                                </div>
                            </div>

                            {{-- Dates --}}
                            <div class="col-md-3 small text-muted">
                                Enrolled:
                                {{ $enrollment->enrolled_at->format('M d, Y') }}
                            </div>

                            {{-- Status --}}
                            <div class="col-md-2">
                                @if($enrollment->status === 'enrolled')
                                    <span class="badge bg-primary-subtle text-primary">
                                        Enrolled
                                    </span>
                                @elseif($enrollment->status === 'pass')
                                    <span class="badge bg-success-subtle text-success">
                                        Passed
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">
                                        Failed
                                    </span>
                                @endif
                            </div>

                            {{-- Action --}}
                            <div class="col-md-3 text-md-end">
                                @if($enrollment->status === 'enrolled')
                                    <button class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#gradeModal{{ $enrollment->id }}">
                                        <i class="bi bi-pencil-square me-1"></i>
                                        Grade
                                    </button>
                                @else
                                    <span class="small text-muted">
                                        Completed
                                        @if($enrollment->completed_at)
                                            ({{ $enrollment->completed_at->format('M d, Y') }})
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Grade Modal --}}
                    @if($enrollment->status === 'enrolled')
                        <div class="modal fade" id="gradeModal{{ $enrollment->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Grade {{ $enrollment->user->name }}
                                        </h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form action="{{ route('teacher.grades.update', [$module, $enrollment]) }}"
                                          method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="modal-body">
                                            <p class="text-muted">
                                                Select the final result for this student.
                                            </p>

                                            <div class="d-grid gap-3">
                                                <button type="submit"
                                                        name="status"
                                                        value="pass"
                                                        class="btn btn-success btn-lg">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Pass
                                                </button>

                                                <button type="submit"
                                                        name="status"
                                                        value="fail"
                                                        class="btn btn-danger btn-lg">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Fail
                                                </button>
                                            </div>

                                            <div class="alert alert-warning mt-3 mb-0">
                                                <i class="bi bi-exclamation-triangle me-1"></i>
                                                Grading will complete this module for the student.
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        No students enrolled yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
