@extends('layouts.app')
@section('title','قرعه جدید')

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

    .modern-card {
        border: 0;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 12px 32px rgba(15, 23, 42, 0.07);
        overflow: hidden;
    }

    .modern-card .card-body {
        padding: 28px;
    }

    .form-header {
        margin-bottom: 28px;
    }

    .form-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .form-title {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .form-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
        line-height: 1.9;
    }

    .action-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 28px;
    }

    .modern-btn-primary {
        height: 48px;
        padding: 0 22px;
        border: 0;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 10px 22px rgba(37, 99, 235, 0.18);
        transition: all .25s ease;
    }

    .modern-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.24);
    }

    .modern-btn-outline {
        height: 48px;
        padding: 0 22px;
        border-radius: 14px;
        border: 1px solid #dbe2ea;
        background: #fff;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
        transition: all .25s ease;
    }

    .modern-btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .modern-card .card-body {
            padding: 20px;
        }

        .form-title {
            font-size: 20px;
        }

        .action-row {
            flex-direction: column;
            align-items: stretch;
        }

        .action-row .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">قرعه جدید</h1>
        <p class="page-subtitle">ایجاد قرعه جدید و تنظیم اطلاعات مربوط به دوره، تاریخ اجرا و قوانین انتخاب</p>
    </div>

    <div class="card modern-card">
        <div class="card-body">
            <div class="form-header">
                <div class="form-badge">
                    <span>●</span>
                    <span>ایجاد قرعه</span>
                </div>
                <h2 class="form-title">فرم ثبت قرعه</h2>
                <p class="form-subtitle">
                    اطلاعات موردنیاز را وارد کنید و در پایان قرعه جدید را ثبت کنید.
                </p>
            </div>

            <form method="POST" action="{{ route('draws.store') }}">
                @csrf

                @include('draws.partials.form', ['draw' => null])

                <div class="action-row">
                    <button type="submit" class="btn btn-primary modern-btn-primary">
                        ثبت قرعه
                    </button>

                    <a href="{{ route('draws.index') }}" class="btn modern-btn-outline">
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection