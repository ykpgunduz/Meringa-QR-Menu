@php use Illuminate\Support\Facades\Session; @endphp
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Meringa QR Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link {
            color: #ffffff;
            border-radius: 5px;
            margin: 2px 0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #007bff;
            color: #ffffff;
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 0;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .navbar-brand img {
            height: 40px;
        }

        /* Mobile Styles */
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 280px;
                height: 100vh;
                z-index: 1050;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-header {
                background-color: #343a40;
                color: white;
                padding: 15px;
                position: sticky;
                top: 0;
                z-index: 1040;
            }

            .table-responsive {
                font-size: 14px;
            }

            .btn-group .btn {
                padding: 4px 8px;
                font-size: 12px;
            }

            .card-body {
                padding: 15px;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        @media (max-width: 767.98px) {
            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Form responsive */
        @media (max-width: 575.98px) {
            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }

            .btn {
                padding: 10px 15px;
            }

            .table th,
            .table td {
                padding: 8px 4px;
                font-size: 13px;
            }

            .img-thumbnail {
                width: 40px !important;
                height: 40px !important;
            }
        }

        /* Hide scrollbar for mobile sidebar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #2c3034;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #495057;
            border-radius: 2px;
        }

        /* Logout button hover effect */
        .logout-btn:hover {
            background: rgba(255,255,255,0.2) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Mobile Header -->
            <div class="d-md-none mobile-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link text-white p-0 me-3" id="sidebarToggle">
                            <i class="fas fa-bars fa-lg"></i>
                        </button>
                        <img src="{{ asset('img/meringa.png') }}" alt="Meringa" style="height: 30px;" class="me-2">
                        <span class="fw-bold">Admin Panel</span>
                    </div>
                    <small class="text-white-50">
                        <i class="fas fa-user me-1"></i>{{ Session::get('admin_username', 'Admin') }}
                    </small>
                </div>
            </div>

            <!-- Sidebar Overlay -->
            <div class="sidebar-overlay" id="sidebarOverlay"></div>

            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar" id="sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4 d-none d-md-block">
                        <img src="{{ asset('img/meringa.png') }}" alt="Meringa" class="img-fluid" style="max-height: 60px;">
                        <h5 class="text-white mt-2">Admin Panel</h5>
                        <small class="text-white-50">
                            <i class="fas fa-user me-1"></i>{{ Session::get('admin_username', 'Admin') }}
                        </small>
                    </div>

                    <!-- Mobile close button -->
                    <div class="d-md-none text-end mb-3">
                        <button class="btn btn-link text-white p-1" id="sidebarClose">
                            <i class="fas fa-times fa-lg"></i>
                        </button>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" href="{{ route('admin.categories') }}">
                                <i class="fas fa-list me-2"></i>
                                Kategoriler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products') }}">
                                <i class="fas fa-shopping-bag me-2"></i>
                                Ürünler
                            </a>
                        </li>
                    </ul>

                    <hr class="text-white">
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>
                            QR Menüyü Görüntüle
                        </a>
                    </div>

                    <hr class="text-white">
                    <div class="nav-item text-center">
                        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white border border-white-50 rounded px-3 py-2 logout-btn" style="text-decoration: none; background: rgba(255,255,255,0.1); transition: all 0.3s ease;">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Çıkış Yap
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="p-3 p-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
                        <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            @yield('page-actions')
                        </div>
                    </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function showSidebar() {
                sidebar.classList.add('show');
                sidebarOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function hideSidebar() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', showSidebar);
            }

            if (sidebarClose) {
                sidebarClose.addEventListener('click', hideSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', hideSidebar);
            }

            // Close sidebar when clicking on a link (mobile)
            const sidebarLinks = sidebar.querySelectorAll('.nav-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        hideSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    hideSidebar();
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
