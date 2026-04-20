@extends('layouts.app')
@section('title','جزئیات وام')

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

    .header-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .soft-btn {
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

    .summary-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .summary-item {
        padding: 16px 18px;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
    }

    .summary-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .summary-value {
        color: #0f172a;
        font-size: 22px;
        font-weight: 800;
        line-height: 1.4;
    }

    .summary-value.small {
        font-size: 18px;
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
        background: rgba(245, 158, 11, 0.15);
        color: #b45309;
    }

    .status-closed {
        background: rgba(34, 197, 94, 0.14);
        color: #15803d;
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
        padding: 16px 14px;
        vertical-align: middle;
        border-color: #eef2f7;
        font-size: 14px;
        color: #0f172a;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .installment-id {
        font-weight: 800;
        color: #0f172a;
    }

    .due-date-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 700;
    }

    .amount-text {
        font-size: 14px;
        font-weight: 800;
        color: #0f172a;
        white-space: nowrap;
    }

    .paid-text {
        color: #16a34a;
    }

    .installment-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .status-paid {
        background: rgba(34, 197, 94, 0.14);
        color: #15803d;
    }

    .status-partial {
        background: rgba(245, 158, 11, 0.15);
        color: #b45309;
    }

    .status-unpaid {
        background: #e2e8f0;
        color: #475569;
    }

    .pay-form {
        display: flex;
        justify-content: end;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .pay-input {
        width: 150px;
        height: 40px;
        border-radius: 12px;
        border: 1px solid #dbe2ea;
        font-size: 13px;
        box-shadow: none;
    }

    .pay-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .pay-btn {
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 14px;
    }

    @media (max-width: 991.98px) {
        .header-actions {
            width: 100%;
        }

        .header-actions > * {
            flex: 1 1 auto;
        }
    }

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .main-card .card-body,
        .info-card .card-body {
            padding: 18px;
        }

        .pay-form {
            justify-content: stretch;
        }

        .pay-input {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 page-header">
        <div>
            <h1 class="page-title">وام #{{ $loan->id }}</h1>
            <p class="page-subtitle">جزئیات کامل وام مربوط به {{ $loan->member->full_name }}</p>
        </div>

        <div class="header-actions">
            <a class="btn btn-outline-secondary soft-btn" href="{{ route('loans.edit',$loan) }}">
                <i class="bi bi-pencil-square me-1"></i>
                ویرایش
            </a>

            <form method="POST" action="{{ route('loans.settle',$loan) }}">
                @csrf
                <button class="btn btn-outline-success soft-btn">
                    <i class="bi bi-check2-circle me-1"></i>
                    تسویه
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card info-card">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="section-title">خلاصه وام</h5>
                        <p class="section-subtitle">اطلاعات اصلی این وام و وضعیت فعلی آن</p>
                    </div>

                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-label">عضو</div>
                            <div class="summary-value small">{{ $loan->member->full_name }}</div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-label">اصل وام</div>
                            <div class="summary-value">{{ number_format($loan->principal_amount) }}</div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-label">کارمزد</div>
                            <div class="summary-value">{{ number_format($loan->fee_amount) }}</div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-label">مجموع</div>
                            <div class="summary-value">{{ number_format($loan->total_amount) }}</div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-label">وضعیت</div>
                            <div class="mt-1">
                                @if($loan->status === 'active')
                                    <span class="status-badge status-active">
                                        <i class="bi bi-hourglass-split"></i>
                                        فعال
                                    </span>
                                @else
                                    <span class="status-badge status-closed">
                                        <i class="bi bi-check-circle"></i>
                                        {{ $loan->status }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(!empty($loan->note))
                            <div class="summary-item">
                                <div class="summary-label">یادداشت</div>
                                <div class="summary-value small">{{ $loan->note }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card main-card">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="section-title">اقساط وام</h5>
                        <p class="section-subtitle">مدیریت مبلغ، سررسید و ثبت پرداخت هر قسط</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>سررسید</th>
                                    <th>مبلغ</th>
                                    <th>پرداختی</th>
                                    <th>وضعیت</th>
                                    <th class="text-end">پرداخت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loan->installments as $i)
                                    <tr>
                                        <td>
                                            <span class="installment-id">#{{ $i->id }}</span>
                                        </td>
                                        <td>
                                            <span class="due-date-badge">@jdate($i->due_date)</span>
                                        </td>
                                        <td>
                                            <span class="amount-text">{{ number_format($i->total_due) }}</span>
                                        </td>
                                        <td>
                                            <span class="amount-text paid-text">{{ number_format($i->paid_amount) }}</span>
                                        </td>
                                        <td>
                                            @if($i->status === 'paid')
                                                <span class="installment-status status-paid">
                                                    <i class="bi bi-check-circle"></i>
                                                    پرداخت‌شده
                                                </span>
                                            @elseif($i->status === 'partial')
                                                <span class="installment-status status-partial">
                                                    <i class="bi bi-dash-circle"></i>
                                                    پرداخت ناقص
                                                </span>
                                            @else
                                                <span class="installment-status status-unpaid">
                                                    <i class="bi bi-clock-history"></i>
                                                    {{ $i->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <form method="POST" action="{{ route('loans.payInstallment',[$loan,$i]) }}" class="pay-form">
                                                @csrf
                                                <input
                                                    name="amount"
                                                    type="number"
                                                    class="form-control form-control-sm pay-input"
                                                    placeholder="مبلغ پرداخت"
                                                    required
                                                >
                                                <button class="btn btn-sm btn-primary pay-btn">
                                                    ثبت
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
