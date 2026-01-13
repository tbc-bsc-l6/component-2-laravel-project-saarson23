{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item"><i class="bi bi-house-door-fill mx-2 text-muted small"></i></li>
            <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    {{-- New Students (Total Students) --}}
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card shadow-sm border-0">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-blue-100 text-primary me-3" style="background-color: #e0e7ff;">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="ms-auto text-end">
                    <div class="text-muted small fw-medium">Total Students</div>
                    <div class="fs-2 fw-bold text-dark">{{ $stats['total_students'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Courses (Total Modules) --}}
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card shadow-sm border-0">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-teal-100 text-teal-600 me-3" style="background-color: #ccfbf1; color: #0d9488;">
                    <i class="bi bi-book-half"></i>
                </div>
                <div class="ms-auto text-end">
                    <div class="text-muted small fw-medium">Total Courses</div>
                    <div class="fs-2 fw-bold text-dark">{{ $stats['total_modules'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Teachers --}}
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card shadow-sm border-0">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-pink-100 text-pink-600 me-3" style="background-color: #fce7f3; color: #db2777;">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="ms-auto text-end">
                    <div class="text-muted small fw-medium">Total Teachers</div>
                    <div class="fs-2 fw-bold text-dark">{{ $stats['total_teachers'] }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
