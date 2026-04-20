<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'صندوق خانوادگی')</title>

  <link href="{{ asset('assets/bootstrap.rtl.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-icons.min.css') }}">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --panel-bg: #f8fafc;
            --card-bg: #ffffff;
            --success-bg: #ecfdf3;
            --success-text: #166534;
            --danger-bg: #fef2f2;
            --danger-text: #b91c1c;
        }

        body {
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text-dark);
            font-family: inherit;
            min-height: 100vh;
        }

        .app-navbar {
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .navbar-brand.custom-brand {
            font-weight: 800;
            font-size: 20px;
            color: #fff !important;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-badge {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.30);
            font-size: 18px;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.78) !important;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 14px !important;
            border-radius: 12px;
            transition: all .2s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #fff !important;
            background: rgba(255,255,255,0.08);
        }

        .user-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 14px;
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #60a5fa, #2563eb);
            font-size: 15px;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
        }

        .logout-btn {
            border-radius: 12px;
            font-weight: 700;
            padding: 8px 14px;
        }

        .main-wrapper {
            padding-top: 32px;
            padding-bottom: 32px;
        }

        .content-shell {
            min-height: calc(100vh - 110px);
        }

        .custom-alert {
            border: 0;
            border-radius: 18px;
            padding: 16px 18px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
            margin-bottom: 18px;
        }

        .alert-success.custom-alert {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .alert-danger.custom-alert {
            background: var(--danger-bg);
            color: var(--danger-text);
        }

        .custom-alert .alert-icon {
            font-size: 20px;
            margin-left: 10px;
        }

        .error-list {
            margin: 0;
            padding-right: 18px;
        }

        .page-container {
            background: transparent;
        }

        .navbar-toggler {
            border: 0;
            box-shadow: none !important;
        }

        .navbar-toggler:focus {
            box-shadow: none !important;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                margin-top: 14px;
                padding: 14px;
                border-radius: 18px;
                background: rgba(255,255,255,0.05);
            }

            .user-area {
                margin-top: 14px;
                flex-direction: column;
                align-items: stretch !important;
            }

            .user-chip {
                justify-content: center;
            }

            .logout-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg app-navbar">
    <div class="container-fluid px-3 px-md-4">
        <a class="navbar-brand custom-brand" href="{{ route('dashboard') }}">
            <span class="brand-badge">
                <i class="bi bi-wallet2"></i>
            </span>
            <span>صندوق خانوادگی</span>
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            @if(session('ff_user_id'))
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}" href="{{ route('members.index') }}">
                            <i class="bi bi-people ms-1"></i>
                            اعضا
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('periods.*') ? 'active' : '' }}" href="{{ route('periods.index') }}">
                            <i class="bi bi-calendar-range ms-1"></i>
                            دوره‌ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contributions.*') ? 'active' : '' }}" href="{{ route('contributions.index') }}">
                            <i class="bi bi-cash-coin ms-1"></i>
                            اشتراک‌ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}" href="{{ route('loans.index') }}">
                            <i class="bi bi-bank ms-1"></i>
                            وام‌ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}" href="{{ route('expenses.index') }}">
                            <i class="bi bi-receipt ms-1"></i>
                            هزینه‌ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('draws.*') ? 'active' : '' }}" href="{{ route('draws.index') }}">
                            <i class="bi bi-trophy ms-1"></i>
                            قرعه‌ها
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 user-area">
                    <div class="user-chip">
                        <span class="user-avatar">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <span class="small fw-semibold">
                            سلام، {{ session('ff_user_name') }}
                        </span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm logout-btn">
                            <i class="bi bi-box-arrow-right ms-1"></i>
                            خروج
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</nav>

<main class="main-wrapper">
    <div class="container-fluid px-3 px-md-4 page-container content-shell">

        @if(session('ok'))
            <div class="alert alert-success custom-alert d-flex align-items-center">
                <span class="alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </span>
                <div>{{ session('ok') }}</div>
            </div>
        @endif

        @if(session('err'))
            <div class="alert alert-danger custom-alert d-flex align-items-center">
                <span class="alert-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </span>
                <div>{{ session('err') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger custom-alert">
                <div class="d-flex align-items-center mb-2">
                    <span class="alert-icon">
                        <i class="bi bi-exclamation-octagon-fill"></i>
                    </span>
                    <strong>لطفاً موارد زیر را بررسی کنید:</strong>
                </div>
                <ul class="error-list">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</main>
<script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>

</body>
</html>