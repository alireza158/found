@extends('layouts.app')
@section('title','ورود')

@section('content')
<style>
    body {
        background: radial-gradient(circle at top right, #dbeafe 0%, #eff6ff 35%, #f8fafc 100%);
        min-height: 100vh;
    }

    .login-wrapper {
        min-height: 100vh;
    }

    .login-card {
        border: 1px solid rgba(255, 255, 255, 0.7);
        background: rgba(255, 255, 255, 0.78);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
        border-radius: 28px;
        overflow: hidden;
    }

    .login-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .login-title {
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .login-subtitle {
        color: #64748b;
        font-size: 14px;
        line-height: 1.9;
        margin-bottom: 28px;
    }

    .form-label.custom-label {
        font-weight: 700;
        color: #334155;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .modern-input {
        height: 56px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        background: #fff;
        padding: 0 18px;
        font-size: 15px;
        transition: all .25s ease;
        box-shadow: none;
    }

    .modern-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 18px;
        color: #94a3b8;
        font-size: 18px;
        pointer-events: none;
    }

    .input-with-icon {
        padding-left: 48px;
    }

    .modern-btn {
        height: 56px;
        border: 0;
        border-radius: 16px;
        font-weight: 700;
        font-size: 15px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 12px 25px rgba(37, 99, 235, 0.25);
        transition: all .25s ease;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 30px rgba(37, 99, 235, 0.30);
    }

    .register-btn {
        height: 54px;
        border-radius: 16px;
        font-weight: 700;
        border: 1px solid #dbe2ea;
        color: #0f172a;
        background: rgba(255,255,255,0.75);
        transition: all .25s ease;
    }

    .register-btn:hover {
        background: #fff;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
        margin: 22px 0;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #e2e8f0;
    }

    .divider:not(:empty)::before {
        margin-left: .75em;
    }

    .divider:not(:empty)::after {
        margin-right: .75em;
    }

    .side-panel {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #fff;
        height: 100%;
        padding: 42px 36px;
        position: relative;
        overflow: hidden;
    }

    .side-panel::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
        top: -60px;
        right: -60px;
    }

    .side-panel::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        background: rgba(59,130,246,0.18);
        border-radius: 50%;
        bottom: -70px;
        left: -50px;
    }

    .side-panel h3 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }

    .side-panel p {
        color: rgba(255,255,255,0.75);
        line-height: 2;
        font-size: 14px;
        position: relative;
        z-index: 1;
        margin-bottom: 28px;
    }

    .feature-list {
        position: relative;
        z-index: 1;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
        color: rgba(255,255,255,0.9);
        font-size: 14px;
    }

    .feature-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #60a5fa;
        box-shadow: 0 0 0 5px rgba(96,165,250,0.15);
    }

    .forgot-link {
        font-size: 13px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-link:hover {
        color: #1d4ed8;
    }

    .form-check-label {
        font-size: 13px;
        color: #475569;
    }

    @media (max-width: 991.98px) {
        .side-panel {
            display: none;
        }

        .login-card {
            border-radius: 24px;
        }

        .login-title {
            font-size: 26px;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center login-wrapper py-4">
        <div class="col-12 col-lg-10 col-xl-9">
            <div class="login-card">
                <div class="row g-0">
                    
                    <div class="col-lg-5">
                        <div class="side-panel">
                            <h3>ورود به حساب</h3>
                            <p>
                                به پنل خودت وارد شو و خیلی سریع به امکانات، اطلاعات و بخش‌های اختصاصی دسترسی داشته باش.
                            </p>

                            <div class="feature-list">
                                <div class="feature-item">
                                    <span class="feature-dot"></span>
                                    <span>طراحی مدرن و تمیز</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-dot"></span>
                                    <span>تجربه کاربری سریع و روان</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-dot"></span>
                                    <span>امنیت بهتر برای حساب کاربری</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-4 p-md-5">
                            <div class="login-badge">
                                <span>●</span>
                                <span>ورود امن</span>
                            </div>

                            <h1 class="login-title">خوش اومدی</h1>
                            <p class="login-subtitle">
                                ایمیل و رمز عبورت را وارد کن تا وارد حساب کاربری‌ات شوی.
                            </p>

                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label custom-label">ایمیل</label>
                                    <div class="input-icon-wrap">
                                        <span class="input-icon">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input
                                            name="email"
                                            type="email"
                                            class="form-control modern-input input-with-icon @error('email') is-invalid @enderror"
                                            placeholder="example@email.com"
                                            value="{{ old('email') }}"
                                            required
                                        >
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block mt-2 text-end">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label custom-label">رمز عبور</label>
                                    <div class="input-icon-wrap">
                                        <span class="input-icon">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input
                                            name="password"
                                            type="password"
                                            class="form-control modern-input input-with-icon @error('password') is-invalid @enderror"
                                            placeholder="رمز عبور خود را وارد کنید"
                                            required
                                        >
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block mt-2 text-end">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">
                                            مرا به خاطر بسپار
                                        </label>
                                    </div>

                                    @if(Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forgot-link">
                                            فراموشی رمز عبور؟
                                        </a>
                                    @endif
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary modern-btn">
                                        ورود به حساب
                                    </button>
                                </div>
                            </form>

                            <div class="divider">یا</div>

                            <div class="d-grid">
                                <a href="{{ route('register') }}" class="btn register-btn">
                                    ایجاد حساب جدید
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection