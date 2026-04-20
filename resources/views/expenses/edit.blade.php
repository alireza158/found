@extends('layouts.app')
@section('title','ویرایش هزینه')

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
        background: #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 28px;
    }

    .form-section-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .form-section-text {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .action-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-modern-primary {
        height: 48px;
        padding: 0 22px;
        border: 0;
        border-radius: 14px;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.20);
        transition: all .25s ease;
    }

    .btn-modern-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 28px rgba(37, 99, 235, 0.28);
    }

    .btn-modern-light {
        height: 48px;
        padding: 0 22px;
        border-radius: 14px;
        font-weight: 700;
        border: 1px solid #dbe2ea;
        color: #0f172a;
        background: #fff;
        transition: all .25s ease;
    }

    .btn-modern-light:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .form-card .card-body {
            padding: 20px;
        }

        .action-row {
            flex-direction: column;
        }

        .action-row .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">ویرایش هزینه</h1>
        <p class="page-subtitle">اطلاعات هزینه را ویرایش کن و سپس تغییرات را ذخیره کن</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <h5 class="form-section-title">فرم ویرایش</h5>
            <p class="form-section-text">
                فیلدهای موردنظر را به‌روزرسانی کن تا اطلاعات هزینه با مقادیر جدید ذخیره شود.
            </p>

            <form method="POST" action="{{ route('expenses.update',$expense) }}">
                @csrf
                @method('PUT')

                @include('expenses.partials.form', ['expense' => $expense])

                <div class="action-row">
                    <button type="submit" class="btn btn-primary btn-modern-primary">
                        ذخیره تغییرات
                    </button>

                    <a href="{{ route('expenses.index') }}" class="btn btn-modern-light">
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection