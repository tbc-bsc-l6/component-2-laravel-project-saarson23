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

    <style>
        :root {
            --sidebar-bg: #1f2933;
            --sidebar-hover: #374151;
            --sidebar-active: #2563eb;
            --content-bg: #f3f4f6;
        }

        body {
            background-color: var(--content-bg);
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: var(--sidebar-bg);
        }

        .sidebar-brand {
            padding: 1.5rem;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .sidebar-brand h4 {
            margin: 0;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: #e5e7eb;
            padding: 0.75rem 1.25rem;
            margin: 0.2rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link i {
            margin-right: 0.6rem;
        }

        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
        }

        .sidebar .nav-link.active {
            background-color: var(--sidebar-active);
            color: #fff;
        }

        /* Content */
        .content-wrapper {
            min-height: 100vh;
        }

        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        /* Alerts */
        .alert {
            border-radius: 0.75rem;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <aside class="col-lg-2 col-md-3 sidebar px-0">
            <div class="position-sticky top-0">

                <div class="sidebar-brand text-white text-center">
                    <h4>CMS</h4>
                    <small class="opacity-75">
                        {{ ucfirst(auth()->user()->role->role) }}
                    </small>
                </div>

                @include('layouts.navigation')
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="col-lg-10 col-md-9 content-wrapper px-0">

            {{-- Topbar --}}
            <div class="topbar">
                <div class="d-flex justify-content-between align-items-center px-4 py-3">
                    <div class="page-title">
                        @yield('page-title', 'Dashboard')
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ auth()->user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>
                                    Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

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
