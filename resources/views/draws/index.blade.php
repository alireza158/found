@extends('layouts.app')
@section('title','قرعه‌ها')

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

    .header-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .modern-btn-primary {
        height: 46px;
        padding: 0 18px;
        border: 0;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 10px 22px rgba(37, 99, 235, 0.18);
        transition: all .25s ease;
    }

    .modern-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.24);
    }

    .modern-btn-outline {
        height: 40px;
        padding: 0 14px;
        border-radius: 12px;
        border: 1px solid #dbe2ea;
        background: #fff;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        transition: all .25s ease;
    }

    .modern-btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    .modern-btn-run {
        height: 40px;
        padding: 0 14px;
        border: 0;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: #fff;
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.16);
        transition: all .25s ease;
    }

    .modern-btn-run:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 22px rgba(37, 99, 235, 0.22);
        color: #fff;
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

    .draw-id {
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

    .period-badge {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
    }

    .method-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eef2ff;
        color: #4338ca;
        font-size: 12px;
        font-weight: 700;
    }

    .winner-name {
        font-weight: 700;
        color: #0f172a;
    }

    .winner-empty {
        color: #94a3b8;
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

    .status-done {
        background: rgba(22, 163, 74, 0.10);
        color: #15803d;
    }

    .status-planned {
        background: rgba(245, 158, 11, 0.12);
        color: #b45309;
    }

    .status-other {
        background: #e2e8f0;
        color: #475569;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
    }

    .action-group {
        display: flex;
        align-items: center;
        justify-content: end;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pagination-wrap {
        padding: 18px 22px;
        border-top: 1px solid #eef2f7;
        background: #fff;
    }

    .modal-modern .modal-content {
        border: 0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.16);
    }

    .modal-modern .modal-header {
        border-bottom: 1px solid #eef2f7;
        padding: 20px 22px;
        background: #fff;
    }

    .modal-modern .modal-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
    }

    .modal-modern .modal-body {
        padding: 22px;
        background: #fcfdff;
    }

    .modal-modern .modal-footer {
        border-top: 1px solid #eef2f7;
        padding: 18px 22px;
        background: #fff;
    }

    .custom-label {
        font-weight: 700;
        color: #334155;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .modern-input {
        height: 50px;
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        background: #fff;
        padding: 0 16px;
        font-size: 14px;
        transition: all .25s ease;
        box-shadow: none;
    }

    .modern-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
    }

    .modal-note {
        margin-top: 12px;
        padding: 14px 16px;
        border-radius: 14px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 13px;
        line-height: 1.9;
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
    }

    @media (max-width: 767.98px) {
        .header-actions {
            align-items: stretch;
        }

        .header-actions .btn {
            width: 100%;
        }

        .action-group {
            justify-content: start;
        }

        .modal-modern .modal-body,
        .modal-modern .modal-header,
        .modal-modern .modal-footer {
            padding: 18px;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <div class="header-actions">
            <div>
                <h1 class="page-title">قرعه‌ها</h1>
                <p class="page-subtitle">مدیریت قرعه‌ها، مشاهده وضعیت، و اجرای قرعه برای دوره‌های برنامه‌ریزی‌شده</p>
            </div>

            <a class="btn btn-primary modern-btn-primary" href="{{ route('draws.create') }}">
                + قرعه جدید
            </a>
        </div>
    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>دوره</th>
                        <th>تاریخ</th>
                        <th>روش</th>
                        <th>برنده</th>
                        <th>وضعیت</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($draws as $d)
                        <tr>
                            <td>
                                <span class="draw-id">{{ $d->id }}</span>
                            </td>

                            <td>
                                <span class="period-badge">
                                    {{ $d->period->year }}/{{ $d->period->month }}
                                </span>
                            </td>

                            <td>@jdate($d->draw_date)</td>

                            <td>
                                <span class="method-badge">
                                    {{ $d->method }}
                                </span>
                            </td>

                            <td>
                                @if(optional($d->winner)->full_name)
                                    <span class="winner-name">{{ $d->winner->full_name }}</span>
                                @else
                                    <span class="winner-empty">-</span>
                                @endif
                            </td>

                            <td>
                                @php
                                    $statusClass = $d->status === 'done'
                                        ? 'status-done'
                                        : ($d->status === 'planned' ? 'status-planned' : 'status-other');

                                    $statusText = $d->status === 'done'
                                        ? 'انجام شده'
                                        : ($d->status === 'planned' ? 'برنامه‌ریزی شده' : $d->status);
                                @endphp

                                <span class="status-badge {{ $statusClass }}">
                                    <span class="status-dot"></span>
                                    {{ $statusText }}
                                </span>
                            </td>

                            <td class="text-end">
                                <div class="action-group">
                                    <a class="btn modern-btn-outline" href="{{ route('draws.edit',$d) }}">
                                        ویرایش
                                    </a>

                                    @if($d->status === 'planned')
                                        <button class="btn modern-btn-run" data-bs-toggle="modal" data-bs-target="#run{{ $d->id }}">
                                            اجرا
                                        </button>

                                        <div class="modal fade modal-modern" id="run{{ $d->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('draws.run',$d) }}">
                                                        @csrf

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">اجرای قرعه #{{ $d->id }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label custom-label">مبلغ وام</label>
                                                                <input name="loan_amount" type="number" class="form-control modern-input" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label custom-label">کارمزد</label>
                                                                <input name="fee_amount" type="number" class="form-control modern-input" value="0">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label custom-label">تعداد اقساط</label>
                                                                <input name="installments_count" type="number" class="form-control modern-input" value="10" required>
                                                            </div>

                                                            <div class="mb-0">
                                                                <label class="form-label custom-label">تاریخ شروع</label>
                                                                <input name="start_date" type="date" class="form-control modern-input" value="{{ now()->format('Y-m-d') }}" required>
                                                            </div>

                                                            <div class="modal-note">
                                                                اگر برنده از قبل انتخاب نشده باشد، سیستم به‌صورت تصادفی از اعضای واجد شرایط انتخاب می‌کند.
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn modern-btn-outline" type="button" data-bs-dismiss="modal">
                                                                انصراف
                                                            </button>
                                                            <button class="btn btn-primary modern-btn-primary">
                                                                اجرای قرعه
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">موردی برای نمایش وجود ندارد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $draws->links() }}
        </div>
    </div>
</div>
@endsection
