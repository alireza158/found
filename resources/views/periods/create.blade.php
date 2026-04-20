@extends('layouts.app')
@section('title','دوره جدید')

@section('content')
<style>
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
        border-radius: 26px;
        background: #ffffff;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 28px;
    }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .partial-form-wrapper {
        padding: 18px;
        border: 1px solid #eef2f7;
        border-radius: 22px;
        background: linear-gradient(180deg, #fcfdff 0%, #f8fafc 100%);
    }

    .partial-form-wrapper .form-label {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
    }

    .partial-form-wrapper .form-control,
    .partial-form-wrapper .form-select,
    .partial-form-wrapper textarea {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        min-height: 52px;
        box-shadow: none;
        transition: all .2s ease;
    }

    .partial-form-wrapper textarea {
        min-height: 120px;
        padding-top: 14px;
        resize: vertical;
    }

    .partial-form-wrapper .form-control:focus,
    .partial-form-wrapper .form-select:focus,
    .partial-form-wrapper textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .partial-form-wrapper .row > div {
        margin-bottom: 6px;
    }

    .button-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }

    .primary-btn {
        height: 52px;
        padding: 0 22px;
        border: 0;
        border-radius: 16px;
        font-weight: 700;
        font-size: 14px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 12px 24px rgba(37, 99, 235, 0.22);
        transition: all .25s ease;
    }

    .primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 30px rgba(37, 99, 235, 0.28);
    }

    .secondary-btn {
        height: 52px;
        padding: 0 20px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 14px;
    }

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .form-card .card-body {
            padding: 20px;
        }

        .partial-form-wrapper {
            padding: 14px;
        }

        .button-row > * {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">ایجاد دوره جدید</h1>
        <p class="page-subtitle">اطلاعات دوره را وارد کن و یک دوره جدید برای صندوق ثبت کن</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <div class="section-label">
                <i class="bi bi-calendar-plus"></i>
                <span>فرم ثبت دوره</span>
            </div>

            <form method="POST" action="{{ route('periods.store') }}">
                @csrf

                <div class="partial-form-wrapper">
                    @include('periods.partials.form', ['period' => null])
                </div>

                <div class="button-row">
                    <button type="submit" class="btn btn-primary primary-btn">
                        <i class="bi bi-check2-circle ms-1"></i>
                        ثبت دوره
                    </button>

                    <a href="{{ route('periods.index') }}" class="btn btn-outline-secondary secondary-btn">
                        <i class="bi bi-arrow-right ms-1"></i>
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection