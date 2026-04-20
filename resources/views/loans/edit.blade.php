@extends('layouts.app')
@section('title','ویرایش وام')

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
        background: rgba(245, 158, 11, 0.10);
        color: #d97706;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .loan-id-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #334155;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 18px;
    }

    .field-box {
        padding: 20px;
        border: 1px solid #eef2f7;
        border-radius: 20px;
        background: #fcfdff;
    }

    .form-label.custom-label {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 22px;
        color: #94a3b8;
        font-size: 18px;
        pointer-events: none;
        z-index: 2;
    }

    .modern-textarea {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #fff;
        font-size: 14px;
        color: #0f172a;
        transition: all .2s ease;
        box-shadow: none;
        min-height: 140px;
        resize: vertical;
        padding: 16px 18px 16px 46px;
        line-height: 1.9;
    }

    .modern-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .form-hint {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 8px;
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

        .button-row > * {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">ویرایش وام</h1>
        <p class="page-subtitle">اطلاعات قابل ویرایش وام را به‌روزرسانی کن</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <div class="section-label">
                <i class="bi bi-pencil-square"></i>
                <span>فرم ویرایش وام</span>
            </div>

            <div class="loan-id-badge">
                <i class="bi bi-hash ms-1"></i>
                وام شماره {{ $loan->id }}
            </div>

            <form method="POST" action="{{ route('loans.update',$loan) }}">
                @csrf
                @method('PUT')

                <div class="field-box">
                    <label class="form-label custom-label">یادداشت</label>
                    <div class="input-icon-wrap">
                        <span class="input-icon">
                            <i class="bi bi-chat-left-text"></i>
                        </span>
                        <textarea
                            name="note"
                            class="form-control modern-textarea"
                            placeholder="توضیحات، شرایط یا یادداشت مربوط به این وام را وارد کنید..."
                        >{{ old('note', $loan->note) }}</textarea>
                    </div>
                    <div class="form-hint">این بخش برای ثبت توضیحات تکمیلی وام استفاده می‌شود.</div>
                </div>

                <div class="button-row">
                    <button type="submit" class="btn btn-primary primary-btn">
                        <i class="bi bi-check2-circle ms-1"></i>
                        ذخیره تغییرات
                    </button>

                    <a href="{{ route('loans.show',$loan) }}" class="btn btn-outline-secondary secondary-btn">
                        <i class="bi bi-arrow-right ms-1"></i>
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection