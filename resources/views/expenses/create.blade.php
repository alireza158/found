@extends('layouts.app')
@section('title','هزینه جدید')

@section('content')
<style>
    body {
        background: #f8fafc;
    }

    .page-header {
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
    }

    .form-card {
        border: 0;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 28px;
    }

    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .section-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 28px;
    }

    .form-card label {
        font-weight: 700;
        color: #334155;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .form-card .form-control,
    .form-card .form-select,
    .form-card textarea {
        border-radius: 14px;
        border: 1px solid #dbe2ea;
        min-height: 48px;
        padding: 12px 14px;
        font-size: 14px;
        box-shadow: none;
        transition: all .2s ease;
        background: #fff;
    }

    .form-card textarea {
        min-height: 120px;
    }

    .form-card .form-control:focus,
    .form-card .form-select:focus,
    .form-card textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #eef2f7;
    }

    .btn-modern-primary {
        height: 48px;
        padding: 0 20px;
        border: 0;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.18);
        transition: all .25s ease;
    }

    .btn-modern-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.24);
    }

    .btn-modern-secondary {
        height: 48px;
        padding: 0 20px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        border: 1px solid #dbe2ea;
        color: #334155;
        background: #fff;
        transition: all .2s ease;
    }

    .btn-modern-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .form-card .card-body {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn,
        .form-actions a {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">هزینه جدید</h1>
        <p class="page-subtitle">اطلاعات هزینه را وارد کن و در سیستم ثبتش کن</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <div class="section-badge">
                <span>●</span>
                <span>ثبت هزینه</span>
            </div>

            <h2 class="section-title">ایجاد هزینه جدید</h2>
            <p class="section-subtitle">
                فرم زیر را کامل کن تا هزینه جدید به لیست هزینه‌ها اضافه شود.
            </p>

            <form method="POST" action="{{ route('expenses.store') }}">
                @csrf

                @include('expenses.partials.form', ['expense' => null])

                <div class="form-actions">
                    <button class="btn btn-primary btn-modern-primary">
                        ثبت هزینه
                    </button>

                    <a href="{{ route('expenses.index') }}" class="btn btn-modern-secondary">
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection