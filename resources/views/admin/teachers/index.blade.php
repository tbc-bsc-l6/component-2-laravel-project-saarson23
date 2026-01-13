{{-- resources/views/admin/teachers/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="container-fluid px-4 py-4">
    
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Teachers</h2>
            <p class="text-muted mb-0">Manage teacher accounts and module assignments</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Add New Teacher
        </a>
    </div>

    {{-- Search and Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.teachers.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control border-start-0" 
                            placeholder="Search by name or email..."
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="module_id" class="form-select">
                        <option value="">All Modules</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}" {{ request('module_id') == $module->id ? 'selected' : '' }}>
                                {{ $module->module }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Teachers List --}}
    @if($teachers->count() > 0)
        <div class="row g-4">
            @foreach($teachers as $teacher)
                <div class="col-lg-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            {{-- Teacher Info --}}
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                                        <i class="bi bi-person-fill text-primary fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fw-semibold">{{ $teacher->name }}</h5>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-envelope me-1"></i>{{ $teacher->email }}
                                    </p>
                                </div>
                            </div>

                            {{-- Assigned Modules --}}
                            <div class="mb-3">
                                <h6 class="text-muted small mb-2">
                                    <i class="bi bi-book me-1"></i>Assigned Modules ({{ $teacher->teacherModules->count() }})
                                </h6>
                                @if($teacher->teacherModules->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($teacher->teacherModules as $teacherModule)
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                                {{ $teacherModule->module->module }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted small mb-0">No modules assigned yet</p>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex gap-2 pt-3 border-top">
                                <button type="button" class="btn btn-sm btn-outline-primary flex-grow-1" data-bs-toggle="modal" data-bs-target="#assignModuleModal{{ $teacher->id }}">
                                    <i class="bi bi-plus-circle me-1"></i>Assign Module
                                </button>
                                <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Assign Module Modal --}}
                <div class="modal fade" id="assignModuleModal{{ $teacher->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Assign Module to {{ $teacher->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.teachers.attach-module') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                    <div class="mb-3">
                                        <label for="module_id{{ $teacher->id }}" class="form-label">Select Module</label>
                                        <select name="module_id" id="module_id{{ $teacher->id }}" class="form-select" required>
                                            <option value="">Choose a module...</option>
                                            @foreach($modules as $module)
                                                <option value="{{ $module->id }}">
                                                    {{ $module->module }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Assign Module</button>
                                    </div>
                                </form>

                                {{-- Currently Assigned Modules --}}
                                @if($teacher->teacherModules->count() > 0)
                                    <div class="alert alert-info small mt-4 mb-0">
                                        <strong>Currently assigned:</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach($teacher->teacherModules as $tm)
                                                <li class="d-flex justify-content-between align-items-center mb-1">
                                                    <span>{{ $tm->module->module }}</span>
                                                    <form action="{{ route('admin.teachers.detach-module') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                                        <input type="hidden" name="module_id" value="{{ $tm->module_id }}">
                                                        <button type="submit" class="btn btn-sm btn-link text-danger p-0 border-0" onclick="return confirm('Remove this module?');">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $teachers->withQueryString()->links() }}
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-people fs-1 text-muted mb-3 d-block"></i>
                <h5 class="text-muted mb-2">No Teachers Found</h5>
                <p class="text-muted mb-3">
                    @if(request('search') || request('module_id'))
                        No teachers match your search criteria.
                    @else
                        Get started by adding your first teacher.
                    @endif
                </p>
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i>Add First Teacher
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
