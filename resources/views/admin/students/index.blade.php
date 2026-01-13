{{-- resources/views/admin/students/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Students')
@section('page-title', 'Manage Students')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">

            {{-- Header --}}
            <div class="card-header bg-white border-0 px-4 py-3">
                <h4 class="mb-1 fw-semibold">Students</h4>
                <small class="text-muted">
                    View students, their roles, and active enrollments
                </small>
            </div>

            <div class="card-body px-4 pb-4">

                {{-- Search and Filter --}}
                <form action="{{ route('admin.students.index') }}" method="GET" class="mb-4">
                    <div class="row g-2">
                        <div class="col-md-8">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-end-0 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-start-0 ps-0"
                                    placeholder="Search by name or email..."
                                    value="{{ request('search') }}"
                                >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="role" class="form-select form-select-lg">
                                <option value="">All Roles</option>
                                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="old_student" {{ request('role') == 'old_student' ? 'selected' : '' }}>Old Student</option>
                                <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary btn-lg w-100" type="submit">Filter</button>
                        </div>
                    </div>
                     @if(request('search') || request('role'))
                        <div class="mt-2">
                            <a href="{{ route('admin.students.index') }}" class="text-decoration-none small text-muted">
                                <i class="bi bi-x-circle me-1"></i>Clear all filters
                            </a>
                        </div>
                    @endif
                </form>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Active Enrollments</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td class="text-muted">{{ $student->id }}</td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $student->name }}
                                        </div>
                                    </td>

                                    <td class="text-muted">
                                        {{ $student->email }}
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill
                                            {{ $student->role->role === 'student'
                                                ? 'bg-primary-subtle text-primary'
                                                : 'bg-secondary-subtle text-secondary' }}">
                                            {{ ucfirst(str_replace('_', ' ', $student->role->role)) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($student->activeEnrollments->count() > 0)
                                            @foreach($student->activeEnrollments as $enrollment)
                                                <span class="badge rounded-pill bg-info-subtle text-info me-1 mb-1">
                                                    {{ $enrollment->module->module }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">None</span>
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#roleModal{{ $student->id }}"
                                        >
                                            <i class="bi bi-pencil me-1"></i>
                                            Change Role
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people fs-3 d-block mb-2"></i>
                                        No students found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $students->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Change Role Modals --}}
@foreach($students as $student)
    <div class="modal fade" id="roleModal{{ $student->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold">
                        Change Role
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.students.change-role', $student) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-body">
                        <p class="text-muted small mb-3">
                            Update role for <strong>{{ $student->name }}</strong>
                        </p>

                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                Select New Role
                            </label>

                            <select class="form-select form-select-lg" name="role" required>
                                <option value="student" {{ $student->role->role === 'student' ? 'selected' : '' }}>
                                    Student
                                </option>
                                <option value="old_student" {{ $student->role->role === 'old_student' ? 'selected' : '' }}>
                                    Old Student
                                </option>
                                <option value="teacher" {{ $student->role->role === 'teacher' ? 'selected' : '' }}>
                                    Teacher
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Update Role
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

@endsection
