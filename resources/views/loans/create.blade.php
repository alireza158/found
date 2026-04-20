@extends('layouts.app')
@section('title','وام جدید')

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

    .form-label.custom-label {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
    }

    .modern-input,
    .modern-select,
    .modern-textarea {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #fff;
        font-size: 14px;
        color: #0f172a;
        transition: all .2s ease;
        box-shadow: none;
    }

    .modern-input,
    .modern-select {
        height: 54px;
    }

    .modern-textarea {
        min-height: 120px;
        padding-top: 14px;
        resize: vertical;
    }

    .modern-input:focus,
    .modern-select:focus,
    .modern-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 18px;
        pointer-events: none;
        z-index: 2;
    }

    .input-with-icon {
        padding-left: 46px;
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
        margin-top: 26px;
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

    .field-box {
        padding: 18px;
        border: 1px solid #eef2f7;
        border-radius: 20px;
        background: #fcfdff;
        height: 100%;
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
        <h1 class="page-title">ایجاد وام جدید</h1>
        <p class="page-subtitle">ثبت اطلاعات وام، مبلغ، تعداد اقساط و تاریخ شروع بازپرداخت</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <div class="section-label">
                <i class="bi bi-bank"></i>
                <span>فرم ثبت وام</span>
            </div>

            <form method="POST" action="{{ route('loans.store') }}">
                @csrf

                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="field-box">
                            <label class="form-label custom-label">عضو</label>
                            <div class="input-icon-wrap">
                                <span class="input-icon">
                                    <i class="bi bi-person"></i>
                                </span>
                                <select name="member_id" class="form-select modern-select input-with-icon" required>
                                    <option value="">انتخاب کنید...</option>
                                    @foreach($members as $m)
                                        <option value="{{ $m->id }}" {{ old('member_id') == $m->id ? 'selected' : '' }}>
                                            {{ $m->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-hint">عضوی که وام برای او ثبت می‌شود را انتخاب کن.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="field-box">
                            <label class="form-label custom-label">مبلغ وام (اصل)</label>
                            <div class="input-icon-wrap">
                                <span class="input-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </span>
                                <input
                                    name="principal_amount"
                                    type="number"
                                    class="form-control modern-input input-with-icon"
                                    value="{{ old('principal_amount') }}"
                                    placeholder="مثلاً 5000000"
                                    required
                                >
                            </div>
                            <div class="form-hint">مبلغ اصلی وام بدون کارمزد.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="field-box">
                            <label class="form-label custom-label">کارمزد (اختیاری)</label>
                            <div class="input-icon-wrap">
                                <span class="input-icon">
                                    <i class="bi bi-percent"></i>
                                </span>
                                <input
                                    name="fee_amount"
                                    type="number"
                                    class="form-control modern-input input-with-icon"
                                    value="{{ old('fee_amount', 0) }}"
                                    placeholder="0"
                                >
                            </div>
                            <div class="form-hint">در صورت نداشتن کارمزد، صفر بگذار.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="field-box">
                            <label class="form-label custom-label">تعداد اقساط</label>
                            <div class="input-icon-wrap">
                                <span class="input-icon">
                                    <i class="bi bi-list-ol"></i>
                                </span>
                                <input
                                    name="installments_count"
                                    type="number"
                                    class="form-control modern-input input-with-icon"
                                    value="{{ old('installments_count', 10) }}"
                                    required
                                >
                            </div>
                            <div class="form-hint">تعداد کل اقساط بازپرداخت.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="field-box">
                            <label class="form-label custom-label">تاریخ شروع</label>
                            <div class="input-icon-wrap">
                                <span class="input-icon">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                                <input
                                    name="start_date"
                                    type="date"
                                    class="form-control modern-input input-with-icon"
                                    value="{{ old('start_date', now()->format('Y-m-d')) }}"
                                    required
                                >
                            </div>
                            <div class="form-hint">اولین تاریخ شروع بازپرداخت.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="field-box">
                            <label class="form-label custom-label">یادداشت</label>
                            <div class="input-icon-wrap">
                                <span class="input-icon" style="top: 22px; transform: none;">
                                    <i class="bi bi-chat-left-text"></i>
                                </span>
                                <textarea
                                    name="note"
                                    class="form-control modern-textarea input-with-icon"
                                    placeholder="توضیحات تکمیلی، شرایط یا یادداشت اختیاری..."
                                >{{ old('note') }}</textarea>
                            </div>
                            <div class="form-hint">این بخش اختیاری است.</div>
                        </div>
                    </div>
                </div>

                <div class="button-row">
                    <button type="submit" class="btn btn-primary primary-btn">
                        <i class="bi bi-check2-circle ms-1"></i>
                        ثبت وام
                    </button>

                    <a href="{{ route('loans.index') }}" class="btn btn-outline-secondary secondary-btn">
                        <i class="bi bi-arrow-right ms-1"></i>
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection