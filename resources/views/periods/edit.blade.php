@extends('layouts.app')
@section('title','ویرایش دوره')

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

    .form-section {
        padding: 22px;
        border: 1px solid #eef2f7;
        border-radius: 22px;
        background: #fcfdff;
        margin-bottom: 24px;
    }

    .button-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 6px;
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

        .form-section {
            padding: 16px;
        }

        .button-row > * {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">ویرایش دوره</h1>
        <p class="page-subtitle">اطلاعات دوره را ویرایش کن و تغییرات را ذخیره کن</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <div class="section-label">
                <i class="bi bi-pencil-square"></i>
                <span>فرم ویرایش دوره</span>
            </div>

            <form method="POST" action="{{ route('periods.update',$period) }}">
                @csrf
                @method('PUT')

                <div class="form-section">
                    @include('periods.partials.form', ['period' => $period])
                </div>

                <div class="button-row">
                    <button class="btn btn-primary primary-btn">
                        <i class="bi bi-check2-circle ms-1"></i>
                        ذخیره تغییرات
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