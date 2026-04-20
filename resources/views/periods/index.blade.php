@extends('layouts.app')
@section('title','دوره‌ها')

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

    .period-id {
        font-weight: 800;
        color: #0f172a;
    }

    .period-code {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f8fafc;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-open {
        background: rgba(34, 197, 94, 0.14);
        color: #15803d;
    }

    .status-closed {
        background: #e2e8f0;
        color: #475569;
    }

    .actions-wrap {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 8px;
    }

    .action-btn {
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 14px;
        white-space: nowrap;
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

        .actions-wrap {
            justify-content: flex-start;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 page-header">
        <div>
            <h1 class="page-title">دوره‌های ماهانه</h1>
            <p class="page-subtitle">مدیریت دوره‌ها، تولید اشتراک و بستن دوره‌های مالی</p>
        </div>

        <div>
            <a class="btn btn-primary modern-btn" href="{{ route('periods.create') }}">
                <i class="bi bi-plus-lg me-1"></i>
                دوره جدید
            </a>
        </div>
    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table align-middle table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>سال/ماه</th>
                        <th>از</th>
                        <th>تا</th>
                        <th>وضعیت</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($periods as $p)
                        <tr>
                            <td>
                                <span class="period-id">#{{ $p->id }}</span>
                            </td>
                            <td>
                                <span class="period-code">{{ $p->year }}/{{ $p->month }}</span>
                            </td>
                            <td>
                                <span class="date-badge">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $p->starts_at }}
                                </span>
                            </td>
                            <td>
                                <span class="date-badge">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    {{ $p->ends_at }}
                                </span>
                            </td>
                            <td>
                                @if($p->status === 'open')
                                    <span class="status-badge status-open">
                                        <i class="bi bi-unlock"></i>
                                        باز
                                    </span>
                                @else
                                    <span class="status-badge status-closed">
                                        <i class="bi bi-lock"></i>
                                        بسته
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="actions-wrap">
                                    <a class="btn btn-sm btn-outline-secondary action-btn" href="{{ route('periods.edit',$p) }}">
                                        <i class="bi bi-pencil-square me-1"></i>
                                        ویرایش
                                    </a>

                                    <form method="POST" action="{{ route('periods.generateContributions',$p) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary action-btn">
                                            <i class="bi bi-cash-coin me-1"></i>
                                            تولید اشتراک
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('periods.close',$p) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger action-btn" @disabled($p->status==='closed')>
                                            <i class="bi bi-lock me-1"></i>
                                            بستن دوره
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-calendar-range"></i>
                                    </div>
                                    <div class="fw-bold mb-1">هیچ دوره‌ای ثبت نشده</div>
                                    <div class="small">برای شروع، اولین دوره ماهانه را ایجاد کن.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($periods->hasPages())
            <div class="pagination-wrap">
                {{ $periods->links() }}
            </div>
        @endif
    </div>
</div>
@endsection