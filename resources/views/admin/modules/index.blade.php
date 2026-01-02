{{-- resources/views/admin/modules/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Modules')
@section('page-title', 'Manage Modules')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">

            {{-- Header --}}
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center px-4 py-3">
                <div>
                    <h4 class="mb-0 fw-semibold">Modules</h4>
                    <small class="text-muted">Manage availability, capacity, and assignments</small>
                </div>

                <a href="{{ route('admin.modules.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Add Module
                </a>
            </div>

            {{-- Body --}}
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>#</th>
                                <th>Module</th>
                                <th>Status</th>
                                <th>Students</th>
                                <th>Spots Left</th>
                                <th>Teachers</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($modules as $module)
                                @php
                                    $spots = 10 - $module->active_students_count;
                                @endphp

                                <tr>
                                    <td class="text-muted">{{ $module->id }}</td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $module->module }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill
                                            {{ $module->is_available ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                            {{ $module->is_available ? 'Available' : 'Archived' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="fw-medium">
                                            {{ $module->active_students_count }}
                                        </span>
                                        <span class="text-muted">/10</span>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill
                                            {{ $spots > 0 ? 'bg-info-subtle text-info' : 'bg-danger-subtle text-danger' }}">
                                            {{ $spots }} left
                                        </span>
                                    </td>

                                    <td>
                                        <span class="fw-medium">{{ $module->teachers_count }}</span>
                                    </td>

                                    <td class="text-end">
                                        <form action="{{ route('admin.modules.toggle', $module) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                class="btn btn-sm
                                                {{ $module->is_available ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                {{ $module->is_available ? 'Archive' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        No modules have been created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
