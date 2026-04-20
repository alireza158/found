@extends('layouts.app')
@section('title','جزئیات عضو')

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

    .header-btn {
        height: 46px;
        padding: 0 18px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
    }

    .main-card,
    .info-card {
        border: 0;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
        height: 100%;
    }

    .main-card .card-body,
    .info-card .card-body {
        padding: 24px;
    }

    .member-profile {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .member-avatar {
        width: 74px;
        height: 74px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        font-size: 28px;
        box-shadow: 0 14px 28px rgba(37, 99, 235, 0.25);
        flex-shrink: 0;
    }

    .member-name {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .member-meta {
        font-size: 13px;
        color: #64748b;
    }

    .info-box {
        padding: 16px 18px;
        border: 1px solid #eef2f7;
        border-radius: 18px;
        background: #fcfdff;
        margin-bottom: 14px;
    }

    .info-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .info-value {
        color: #0f172a;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.8;
        word-break: break-word;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .status-active {
        background: rgba(34, 197, 94, 0.14);
        color: #15803d;
    }

    .status-inactive {
        background: rgba(100, 116, 139, 0.14);
        color: #475569;
    }

    .section-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .section-subtitle {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 0;
    }

    .table-modern {
        margin-bottom: 0;
    }

    .table-modern thead th {
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        padding: 16px 14px;
        background: #f8fafc;
        white-space: nowrap;
    }

    .table-modern tbody td {
        padding: 18px 14px;
        vertical-align: middle;
        border-color: #eef2f7;
        font-size: 14px;
        color: #0f172a;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .loan-id {
        font-weight: 800;
        color: #0f172a;
    }

    .amount-text {
        font-weight: 800;
        color: #0f172a;
        white-space: nowrap;
    }

    .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 34px;
        padding: 0 12px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
    }

    .loan-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .loan-status-active {
        background: rgba(245, 158, 11, 0.15);
        color: #b45309;
    }

    .loan-status-done {
        background: rgba(34, 197, 94, 0.14);
        color: #15803d;
    }

    .action-btn {
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 14px;
    }

    .passbook-add-box {
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        padding: 16px;
        margin-bottom: 18px;
        background: #f8fafc;
    }

    .passbook-steps {
        margin: 0 0 14px 0;
        padding-right: 18px;
        color: #475569;
        font-size: 13px;
        line-height: 1.9;
    }

    .passbook-input {
        height: 46px;
        border-radius: 12px;
    }

    .empty-state {
        text-align: center;
        padding: 42px 16px;
        color: #94a3b8;
    }

    .empty-state-icon {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #64748b;
        font-size: 26px;
        margin-bottom: 14px;
    }

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .member-profile {
            align-items: flex-start;
        }

        .main-card .card-body,
        .info-card .card-body {
            padding: 18px;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 page-header">
        <div>
            <h1 class="page-title">جزئیات عضو</h1>
            <p class="page-subtitle">مشاهده اطلاعات فردی و وام‌های ثبت‌شده این عضو</p>
        </div>

        <div>
            <a class="btn btn-outline-secondary header-btn" href="{{ route('members.edit',$member) }}">
                <i class="bi bi-pencil-square me-1"></i>
                ویرایش عضو
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card info-card">
                <div class="card-body">
                    <div class="member-profile">
                        <div class="member-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="member-name">{{ $member->full_name }}</div>
                            <div class="member-meta">اطلاعات پایه عضو صندوق</div>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">موبایل</div>
                        <div class="info-value">{{ $member->phone ?: '-' }}</div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">کد ملی</div>
                        <div class="info-value">{{ $member->national_id ?: '-' }}</div>
                    </div>

                    <div class="info-box mb-0">
                        <div class="info-label">وضعیت</div>
                        <div class="info-value">
                            @if($member->is_active)
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle-fill"></i>
                                    فعال
                                </span>
                            @else
                                <span class="status-badge status-inactive">
                                    <i class="bi bi-dash-circle-fill"></i>
                                    غیرفعال
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card main-card">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="section-title">دفترچه‌ها</h5>
                        <p class="section-subtitle">شماره دفترچه‌های عضو و وضعیت درگیری آن‌ها در وام</p>
                    </div>

                    <div id="add-passbook" class="passbook-add-box">
                        <div class="fw-bold mb-2">افزودن دفترچه جدید</div>
                        <ol class="passbook-steps">
                            <li>شماره دفترچه را وارد کنید.</li>
                            <li>در صورت نیاز، عنوان دلخواه بنویسید (اختیاری).</li>
                            <li>روی «افزودن دفترچه» بزنید تا همان لحظه به لیست اضافه شود.</li>
                        </ol>
                        <form method="POST" action="{{ route('members.passbooks.store', $member) }}" class="row g-2">
                            @csrf
                            <div class="col-12 col-md-4">
                                <input
                                    type="text"
                                    name="number"
                                    class="form-control passbook-input @error('number') is-invalid @enderror"
                                    value="{{ old('number') }}"
                                    placeholder="شماره دفترچه"
                                    required
                                >
                                @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-5">
                                <input
                                    type="text"
                                    name="title"
                                    class="form-control passbook-input @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}"
                                    placeholder="عنوان (اختیاری)"
                                >
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-3 d-grid">
                                <button class="btn btn-success passbook-input">
                                    <i class="bi bi-journal-plus me-1"></i>
                                    افزودن دفترچه
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table align-middle table-modern">
                            <thead>
                                <tr>
                                    <th>شماره دفترچه</th>
                                    <th>عنوان</th>
                                    <th>وضعیت وام</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($member->passbooks as $passbook)
                                    @php
                                        $activeLoan = $passbook->loans->firstWhere('status', 'active');
                                    @endphp
                                    <tr>
                                        <td>{{ $passbook->number ?: '-' }}</td>
                                        <td>{{ $passbook->title }}</td>
                                        <td>
                                            @if($activeLoan)
                                                <span class="loan-status loan-status-active">
                                                    <i class="bi bi-hourglass-split"></i>
                                                    درگیر وام #{{ $activeLoan->id }}
                                                </span>
                                            @else
                                                <span class="loan-status loan-status-done">
                                                    <i class="bi bi-check-circle"></i>
                                                    آزاد
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="empty-state">
                                                <div class="empty-state-icon">
                                                    <i class="bi bi-journal-x"></i>
                                                </div>
                                                <div class="fw-bold mb-1">دفترچه‌ای ثبت نشده</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3">
                        <h5 class="section-title">وام‌ها</h5>
                        <p class="section-subtitle">لیست وام‌های ثبت‌شده برای این عضو</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>مبلغ</th>
                                    <th>دفترچه</th>
                                    <th>اقساط</th>
                                    <th>وضعیت</th>
                                    <th class="text-end">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($member->loans as $l)
                                    <tr>
                                        <td>
                                            <span class="loan-id">#{{ $l->id }}</span>
                                        </td>
                                        <td>
                                            <span class="amount-text">{{ number_format($l->principal_amount) }}</span>
                                        </td>
                                        <td>{{ $l->passbook?->number ?: ('#'.$l->passbook_id) }}</td>
                                        <td>
                                            <span class="count-badge">{{ $l->installments_count }}</span>
                                        </td>
                                        <td>
                                            @if($l->status === 'active')
                                                <span class="loan-status loan-status-active">
                                                    <i class="bi bi-hourglass-split"></i>
                                                    فعال
                                                </span>
                                            @else
                                                <span class="loan-status loan-status-done">
                                                    <i class="bi bi-check-circle"></i>
                                                    {{ $l->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-outline-primary action-btn" href="{{ route('loans.show',$l) }}">
                                                <i class="bi bi-eye me-1"></i>
                                                مشاهده
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <div class="empty-state-icon">
                                                    <i class="bi bi-bank"></i>
                                                </div>
                                                <div class="fw-bold mb-1">وامی ثبت نشده</div>
                                                <div class="small">برای این عضو هنوز وامی ثبت نشده است.</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
