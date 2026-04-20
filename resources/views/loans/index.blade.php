@extends('layouts.app')
@section('title','وام‌ها')

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

    .modern-btn {
        height: 46px;
        padding: 0 18px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        border: 0;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 10px 22px rgba(37, 99, 235, 0.22);
        transition: all .25s ease;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 28px rgba(37, 99, 235, 0.28);
    }

    .main-card {
        border: 0;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .table-modern {
        margin-bottom: 0;
    }

    .table-modern thead th {
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        padding: 16px 18px;
        background: #f8fafc;
        white-space: nowrap;
    }

    .table-modern tbody td {
        padding: 18px;
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

    .loan-id {
        font-weight: 800;
        color: #0f172a;
    }

    .member-link {
        text-decoration: none;
        color: #2563eb;
        font-weight: 700;
    }

    .member-link:hover {
        color: #1d4ed8;
    }

    .amount-text {
        font-size: 14px;
        font-weight: 800;
        color: #0f172a;
        white-space: nowrap;
    }

    .passbook-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 800;
    }

    .fee-text {
        color: #7c3aed;
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

    .action-btn {
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 14px;
    }

    .pagination-wrap {
        padding: 18px 22px;
        border-top: 1px solid #eef2f7;
        background: #fff;
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
    }
</style>

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 page-header">
        <div>
            <h1 class="page-title">وام‌ها</h1>
            <p class="page-subtitle">مدیریت، بررسی و مشاهده وضعیت همه وام‌های ثبت‌شده</p>
        </div>

        <div>
            <a class="btn btn-primary modern-btn" href="{{ route('loans.create') }}">
                <i class="bi bi-plus-lg me-1"></i>
                وام جدید
            </a>
        </div>
    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table align-middle table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عضو</th>
                        <th>دفترچه</th>
                        <th>اصل وام</th>
                        <th>کارمزد</th>
                        <th>اقساط</th>
                        <th>وضعیت</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $l)
                        <tr>
                            <td>
                                <span class="loan-id">#{{ $l->id }}</span>
                            </td>
                            <td>
                                <a href="{{ route('members.show',$l->member_id) }}" class="member-link">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ $l->member->full_name }}
                                </a>
                            </td>
                            <td>
                                <span class="passbook-badge">
                                    <i class="bi bi-journal-text"></i>
                                    {{ $l->passbook?->number ?: ('#'.$l->passbook_id) }}
                                </span>
                            </td>
                            <td>
                                <span class="amount-text">{{ number_format($l->principal_amount) }}</span>
                            </td>
                            <td>
                                <span class="amount-text fee-text">{{ number_format($l->fee_amount) }}</span>
                            </td>
                            <td>
                                <span class="count-badge">{{ $l->installments_count }}</span>
                            </td>
                            <td>
                                @if($l->status === 'active')
                                    <span class="status-badge status-active">
                                        <i class="bi bi-hourglass-split"></i>
                                        فعال
                                    </span>
                                @else
                                    <span class="status-badge status-closed">
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
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-bank"></i>
                                    </div>
                                    <div class="fw-bold mb-1">هیچ وامی ثبت نشده</div>
                                    <div class="small">برای شروع، اولین وام را ثبت کن.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($loans->hasPages())
            <div class="pagination-wrap">
                {{ $loans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
