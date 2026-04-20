@extends('layouts.app')
@section('title','اشتراک‌ها')

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

    .main-card {
        border: 0;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .table-modern {
        margin-bottom: 0;
    }

    .table-modern thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        padding: 18px 16px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .table-modern tbody td {
        padding: 18px 16px;
        vertical-align: middle;
        border-color: #eef2f7;
        font-size: 14px;
        color: #0f172a;
    }

    .table-modern tbody tr {
        transition: all .2s ease;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .id-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 34px;
        padding: 0 12px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        font-weight: 800;
        font-size: 13px;
    }

    .member-link {
        color: #0f172a;
        text-decoration: none;
        font-weight: 700;
        transition: color .2s ease;
    }

    .member-link:hover {
        color: #2563eb;
    }

    .period-badge {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
    }

    .amount-box {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .amount-value {
        font-weight: 800;
        color: #0f172a;
        font-size: 15px;
        line-height: 1.4;
    }

    .amount-label {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .status-paid {
        background: rgba(22, 163, 74, 0.10);
        color: #15803d;
    }

    .status-partial {
        background: rgba(245, 158, 11, 0.12);
        color: #b45309;
    }

    .status-unpaid {
        background: #e2e8f0;
        color: #475569;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
        opacity: .9;
    }

    .pay-form {
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .modern-input {
        height: 42px;
        min-width: 150px;
        border-radius: 12px;
        border: 1px solid #dbe2ea;
        background: #fff;
        padding: 0 14px;
        font-size: 14px;
        transition: all .2s ease;
        box-shadow: none;
    }

    .modern-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
    }

    .modern-btn {
        height: 42px;
        padding: 0 16px;
        border: 0;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.18);
        transition: all .25s ease;
    }

    .modern-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.24);
    }

    .pagination-wrap {
        padding: 18px 22px;
        border-top: 1px solid #eef2f7;
        background: #fff;
    }

    .empty-state {
        padding: 36px 16px;
        text-align: center;
        color: #94a3b8;
        font-size: 14px;
    }

    @media (max-width: 991.98px) {
        .page-title {
            font-size: 24px;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 14px 12px;
        }

        .pay-form {
            justify-content: start;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">پرداخت‌های اشتراک</h1>
        <p class="page-subtitle">مدیریت وضعیت پرداخت اعضا و ثبت سریع مبالغ پرداختی</p>
    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عضو</th>
                        <th>دوره</th>
                        <th>مبلغ مورد انتظار</th>
                        <th>پرداختی</th>
                        <th>وضعیت</th>
                        <th class="text-end">ثبت پرداخت</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contributions as $c)
                        <tr>
                            <td>
                                <span class="id-badge">{{ $c->id }}</span>
                            </td>

                            <td>
                                <a href="{{ route('members.show', $c->member_id) }}" class="member-link">
                                    {{ $c->member->full_name }}
                                </a>
                            </td>

                            <td>
                                <span class="period-badge">
                                    {{ $c->period->year }}/{{ $c->period->month }}
                                </span>
                            </td>

                            <td>
                                <div class="amount-box">
                                    <span class="amount-value">{{ number_format($c->expected_amount) }}</span>
                                    <span class="amount-label">تومان</span>
                                </div>
                            </td>

                            <td>
                                <div class="amount-box">
                                    <span class="amount-value">{{ number_format($c->paid_amount) }}</span>
                                    <span class="amount-label">تومان</span>
                                </div>
                            </td>

                            <td>
                                @php
                                    $statusClass = $c->status === 'paid'
                                        ? 'status-paid'
                                        : ($c->status === 'partial' ? 'status-partial' : 'status-unpaid');

                                    $statusText = $c->status === 'paid'
                                        ? 'پرداخت شده'
                                        : ($c->status === 'partial' ? 'پرداخت ناقص' : 'پرداخت نشده');
                                @endphp

                                <span class="status-badge {{ $statusClass }}">
                                    <span class="status-dot"></span>
                                    {{ $statusText }}
                                </span>
                            </td>

                            <td class="text-end">
                                <form method="POST" action="{{ route('contributions.pay', $c) }}" class="pay-form">
                                    @csrf
                                    <input
                                        name="amount"
                                        type="number"
                                        class="form-control modern-input"
                                        placeholder="مبلغ پرداختی"
                                        required
                                    >
                                    <button class="btn btn-primary modern-btn">
                                        ثبت پرداخت
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                موردی برای نمایش وجود ندارد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $contributions->links() }}
        </div>
    </div>
</div>
@endsection