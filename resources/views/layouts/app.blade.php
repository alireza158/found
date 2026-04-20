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
<script>
    (function () {
        const toEnDigits = (value) => value.replace(/[۰-۹]/g, (d) => String('۰۱۲۳۴۵۶۷۸۹'.indexOf(d)));

        function div(a, b) { return ~~(a / b); }

        function gregorianToJalali(gy, gm, gd) {
            const gdm = [0,31,59,90,120,151,181,212,243,273,304,334];
            const gy2 = gm > 2 ? gy + 1 : gy;
            let days = 355666 + (365 * gy) + div(gy2 + 3, 4) - div(gy2 + 99, 100) + div(gy2 + 399, 400) + gd + gdm[gm - 1];
            let jy = -1595 + (33 * div(days, 12053));
            days %= 12053;
            jy += 4 * div(days, 1461);
            days %= 1461;
            if (days > 365) {
                jy += div(days - 1, 365);
                days = (days - 1) % 365;
            }
            const jm = days < 186 ? 1 + div(days, 31) : 7 + div(days - 186, 30);
            const jd = 1 + (days < 186 ? (days % 31) : ((days - 186) % 30));
            return { jy, jm, jd };
        }

        function jalaliToGregorian(jy, jm, jd) {
            jy += 1595;
            let days = -355668 + (365 * jy) + (div(jy, 33) * 8) + div((jy % 33) + 3, 4) + jd + (jm < 7 ? (jm - 1) * 31 : ((jm - 7) * 30) + 186);
            let gy = 400 * div(days, 146097);
            days %= 146097;
            if (days > 36524) {
                gy += 100 * div(--days, 36524);
                days %= 36524;
                if (days >= 365) days++;
            }
            gy += 4 * div(days, 1461);
            days %= 1461;
            if (days > 365) {
                gy += div(days - 1, 365);
                days = (days - 1) % 365;
            }
            let gd = days + 1;
            const sal_a = [0,31,((gy % 4 === 0 && gy % 100 !== 0) || (gy % 400 === 0)) ? 29 : 28,31,30,31,30,31,31,30,31,30,31];
            let gm = 0;
            for (gm = 1; gm <= 12 && gd > sal_a[gm]; gm++) gd -= sal_a[gm];
            return { gy, gm, gd };
        }

        function pad(value) {
            return String(value).padStart(2, '0');
        }

        function toJalaliString(gDate) {
            if (!gDate || !/^\d{4}-\d{2}-\d{2}$/.test(gDate)) return '';
            const [gy, gm, gd] = gDate.split('-').map(Number);
            const { jy, jm, jd } = gregorianToJalali(gy, gm, gd);
            return `${jy}/${pad(jm)}/${pad(jd)}`;
        }

        function toGregorianString(jDate) {
            const cleaned = toEnDigits((jDate || '').trim()).replace(/-/g, '/');
            const match = cleaned.match(/^(\d{4})\/(\d{1,2})\/(\d{1,2})$/);
            if (!match) return '';
            const jy = Number(match[1]), jm = Number(match[2]), jd = Number(match[3]);
            if (jm < 1 || jm > 12 || jd < 1 || jd > 31) return '';
            const { gy, gm, gd } = jalaliToGregorian(jy, jm, jd);
            return `${gy}-${pad(gm)}-${pad(gd)}`;
        }

        function upgradeDateInput(input) {
            if (input.dataset.jalaliUpgraded === '1') return;
            input.dataset.jalaliUpgraded = '1';

            const textInput = document.createElement('input');
            textInput.type = 'text';
            textInput.className = input.className;
            textInput.placeholder = 'مثال: 1405/01/01';
            textInput.autocomplete = 'off';
            textInput.value = toJalaliString(input.value);

            input.type = 'hidden';
            input.parentNode.insertBefore(textInput, input.nextSibling);

            const syncToGregorian = () => {
                const gDate = toGregorianString(textInput.value);
                if (!textInput.value.trim() || gDate) {
                    textInput.setCustomValidity('');
                    input.value = gDate;
                } else {
                    textInput.setCustomValidity('تاریخ را به‌صورت شمسی وارد کنید. مثال: 1405/01/01');
                }
            };

            textInput.addEventListener('input', syncToGregorian);
            textInput.addEventListener('blur', syncToGregorian);
        }

        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type="date"]').forEach(upgradeDateInput);
        });
    })();
</script>

</body>
</html>
