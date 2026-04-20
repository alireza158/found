@extends('layouts.app')
@section('title','داشبورد')

@section('content')
<style>
    body {
        background: #f8fafc;
    }

    .dashboard-header {
        margin-bottom: 24px;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .dashboard-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
    }

    .stat-card {
        border: 0;
        border-radius: 22px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
        transition: all .25s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.10);
    }

    .stat-card .card-body {
        padding: 22px;
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .stat-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.4;
    }

    .stat-value.small-value {
        font-size: 24px;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .icon-blue {
        background: rgba(37, 99, 235, 0.10);
        color: #2563eb;
    }

    .icon-green {
        background: rgba(22, 163, 74, 0.10);
        color: #16a34a;
    }

    .icon-red {
        background: rgba(239, 68, 68, 0.10);
        color: #ef4444;
    }

    .icon-amber {
        background: rgba(245, 158, 11, 0.12);
        color: #d97706;
    }

    .main-card {
        border: 0;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .main-card .card-body {
        padding: 24px;
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

    .modern-btn {
        border-radius: 12px;
        font-weight: 600;
        padding: 8px 14px;
    }

    .table-modern {
        margin-bottom: 0;
    }

    .table-modern thead th {
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        padding: 14px 12px;
        white-space: nowrap;
    }

    .table-modern tbody td {
        padding: 16px 12px;
        vertical-align: middle;
        border-color: #eef2f7;
        font-size: 14px;
        color: #0f172a;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .loan-link {
        text-decoration: none;
        font-weight: 700;
        color: #2563eb;
    }

    .loan-link:hover {
        color: #1d4ed8;
    }

    .custom-badge {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .empty-state {
        padding: 28px 12px;
        color: #94a3b8;
        font-size: 14px;
        text-align: center;
    }

    .currency-text {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        margin-right: 6px;
    }

    @media (max-width: 767.98px) {
        .dashboard-title {
            font-size: 24px;
        }

        .stat-value {
            font-size: 24px;
        }

        .main-card .card-body {
            padding: 18px;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="dashboard-header">
        <h1 class="dashboard-title">داشبورد مالی</h1>
        <p class="dashboard-subtitle">نمای کلی از وضعیت صندوق، گردش دوره و اقساط نزدیک به سررسید</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">موجودی صندوق</div>
                            <div class="stat-value">
                                {{ number_format($centralBalance) }}
                                <span class="currency-text">تومان</span>
                            </div>
                        </div>
                        <div class="stat-icon icon-blue">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">ورودی دوره جاری</div>
                            <div class="stat-value">{{ number_format($incomingThisPeriod) }}</div>
                        </div>
                        <div class="stat-icon icon-green">
                            <i class="bi bi-arrow-down-left-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">خروجی دوره جاری</div>
                            <div class="stat-value">{{ number_format($outgoingThisPeriod) }}</div>
                        </div>
                        <div class="stat-icon icon-red">
                            <i class="bi bi-arrow-up-right-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">بدهی‌های اشتراک</div>
                            <div class="stat-value small-value">{{ $unpaidContribs }}</div>
                        </div>
                        <div class="stat-icon icon-amber">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card main-card mt-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                <div>
                    <h5 class="section-title">اقساط سررسید نزدیک</h5>
                    <p class="section-subtitle">لیست اقساطی که تا ۷ روز آینده سررسید می‌شوند</p>
                </div>

                <a href="{{ route('loans.index') }}" class="btn btn-outline-primary modern-btn">
                    <i class="bi bi-credit-card-2-front me-1"></i>
                    مشاهده وام‌ها
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-modern">
                    <thead>
                        <tr>
                            <th>تاریخ</th>
                            <th>وام</th>
                            <th>مبلغ</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dueSoon as $i)
                            <tr>
                                <td>@jdate($i->due_date)</td>
                                <td>
                                    <a href="{{ route('loans.show', $i->loan_id) }}" class="loan-link">
                                        #{{ $i->loan_id }}
                                    </a>
                                </td>
                                <td>{{ number_format($i->total_due) }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark custom-badge">
                                        {{ $i->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">موردی برای نمایش وجود ندارد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
