{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'College Management System')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

      <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f3f4f6;
            --sidebar-active: #2563eb;
            --content-bg: #f8fafc;
        }

        body {
            background-color: var(--content-bg);
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            box-shadow: 4px 0 10px rgba(0,0,0,0.03);
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
        }

        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
            color: #1e293b;
            font-size: 1.5rem;
        }

        .sidebar-profile {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 1rem;
        }

        .sidebar-profile img {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 0.75rem;
            border: 2px solid #f8fafc;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-weight: 600;
            color: #334155;
            margin-bottom: 2px;
            font-size: 0.95rem;
        }

        .profile-role {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: capitalize;
        }

        .nav_category {
            padding: 0 1.5rem;
            font-size: 0.65rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar .nav-link {
            color: #64748b;
            padding: 0.6rem 1rem;
            margin: 0.2rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: #1e293b;
        }

        .sidebar .nav-link.active {
            background-color: #f1f5f9;
            color: var(--sidebar-active);
        }

        /* Content */
        .content-wrapper {
            min-height: 100vh;
        }

        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            height: 70px;
            display: flex;
            align-items: center;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <aside class="col-lg-2 sidebar px-0">
            <div class="position-sticky top-0">

                <div class="sidebar-brand">
                    <h4>Assasin School</h4>
                </div>

                <div class="sidebar-profile">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f1f5f9&color=64748b" alt="Profile">
                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-role text-muted">{{ auth()->user()->role->role }}</div>
                </div>

                <div class="nav_category">Main</div>
                @include('layouts.navigation')
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="col-lg-10 content-wrapper px-0">

            {{-- Topbar --}}
            <nav class="topbar sticky-top px-4">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link link-dark p-0 me-3 d-lg-none">
                            <i class="bi bi-list fs-3"></i>
                        </button>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-sm rounded-circle">
                                <i class="bi bi-fullscreen"></i>
                            </button>
                            <button class="btn btn-light btn-sm rounded-circle position-relative">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem">
                                    3
                                </span>
                            </button>
                        </div>

                        <div class="vr mx-2 text-muted opacity-25" style="height: 24px"></div>

                        <div class="dropdown">
                            <button class="btn border-0 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff" alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px">
                                <span class="fw-semibold d-none d-sm-inline">{{ auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down small text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2">
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Content --}}
            <div class="container-fluid px-4 py-4">

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
