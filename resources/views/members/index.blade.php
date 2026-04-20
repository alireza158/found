@extends('layouts.app')
@section('title','اعضا')

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

    .member-id {
        font-weight: 800;
        color: #0f172a;
    }

    .member-link {
        text-decoration: none;
        color: #2563eb;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .member-link:hover {
        color: #1d4ed8;
    }

    .member-avatar {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-size: 16px;
    }

    .phone-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f8fafc;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        direction: ltr;
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

    .action-btn {
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 14px;
    }

    .actions-wrap {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 8px;
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
            <h1 class="page-title">اعضا</h1>
            <p class="page-subtitle">مدیریت، مشاهده و ویرایش اعضای صندوق خانوادگی</p>
        </div>

        <div>
            <a class="btn btn-primary modern-btn" href="{{ route('members.create') }}">
                <i class="bi bi-plus-lg me-1"></i>
                عضو جدید
            </a>
        </div>
    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table align-middle table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>موبایل</th>
                        <th>وضعیت</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $m)
                        <tr>
                            <td>
                                <span class="member-id">#{{ $m->id }}</span>
                            </td>
                            <td>
                                <a href="{{ route('members.show',$m) }}" class="member-link">
                                    <span class="member-avatar">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <span>{{ $m->full_name }}</span>
                                </a>
                            </td>
                            <td>
                                <span class="phone-badge">
                                    <i class="bi bi-telephone"></i>
                                    <span>{{ $m->phone ?: '—' }}</span>
                                </span>
                            </td>
                            <td>
                                @if($m->is_active)
                                    <span class="status-badge status-active">
                                        <i class="bi bi-check-circle"></i>
                                        فعال
                                    </span>
                                @else
                                    <span class="status-badge status-inactive">
                                        <i class="bi bi-dash-circle"></i>
                                        غیرفعال
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="actions-wrap">
                                    <a class="btn btn-sm btn-outline-primary action-btn" href="{{ route('members.show',$m) }}">
                                        <i class="bi bi-eye me-1"></i>
                                        مشاهده جزئیات
                                    </a>
                                    <a class="btn btn-sm btn-outline-success action-btn" href="{{ route('members.show',$m) }}#add-passbook">
                                        <i class="bi bi-journal-plus me-1"></i>
                                        افزودن دفترچه
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary action-btn" href="{{ route('members.edit',$m) }}">
                                        <i class="bi bi-pencil-square me-1"></i>
                                        ویرایش
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="fw-bold mb-1">هیچ عضوی ثبت نشده</div>
                                    <div class="small">برای شروع، اولین عضو صندوق را اضافه کن.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
            <div class="pagination-wrap">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
