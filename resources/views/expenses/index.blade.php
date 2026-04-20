@extends('layouts.app')
@section('title','هزینه‌ها')

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

    .expense-id {
        font-weight: 800;
        color: #0f172a;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 700;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
    }

    .amount-text {
        font-size: 15px;
        font-weight: 800;
        color: #dc2626;
        white-space: nowrap;
    }

    .currency-text {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
        margin-right: 4px;
    }

    .description-text {
        color: #64748b;
        max-width: 320px;
        line-height: 1.9;
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
        padding: 40px 16px;
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

        .description-text {
            max-width: 180px;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 page-header">
        <div>
            <h1 class="page-title">هزینه‌های صندوق</h1>
            <p class="page-subtitle">مدیریت، بررسی و ویرایش هزینه‌های ثبت‌شده صندوق</p>
        </div>

        <div>
            <a class="btn btn-primary modern-btn" href="{{ route('expenses.create') }}">
                <i class="bi bi-plus-lg me-1"></i>
                هزینه جدید
            </a>
        </div>
    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table align-middle table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاریخ</th>
                        <th>دسته</th>
                        <th>مبلغ</th>
                        <th>توضیح</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $e)
                        <tr>
                            <td>
                                <span class="expense-id">#{{ $e->id }}</span>
                            </td>
                            <td>
                                <span class="date-badge">@jdatetime($e->occurred_at)</span>
                            </td>
                            <td>
                                <span class="category-badge">{{ $e->category }}</span>
                            </td>
                            <td>
                                <span class="amount-text">
                                    {{ number_format($e->amount) }}
                                    <span class="currency-text">تومان</span>
                                </span>
                            </td>
                            <td>
                                <div class="description-text">
                                    {{ $e->description ?: '—' }}
                                </div>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-secondary action-btn" href="{{ route('expenses.edit',$e) }}">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    ویرایش
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="fw-bold mb-1">هیچ هزینه‌ای ثبت نشده</div>
                                    <div class="small">برای شروع، اولین هزینه صندوق را ثبت کن.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($expenses->hasPages())
            <div class="pagination-wrap">
                {{ $expenses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
