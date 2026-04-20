@extends('layouts.app')
@section('title','ویرایش عضو')

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

    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .member-top {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 26px;
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(135deg, #f8fbff, #f1f5f9);
        border: 1px solid #e2e8f0;
    }

    .member-avatar {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        font-size: 24px;
        box-shadow: 0 12px 24px rgba(37, 99, 235, 0.20);
        flex-shrink: 0;
    }

    .member-name {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .member-meta {
        font-size: 13px;
        color: #64748b;
    }

    .form-box {
        padding: 18px;
        border-radius: 22px;
        border: 1px solid #eef2f7;
        background: #fcfdff;
    }

    .button-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
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

    @media (max-width: 767.98px) {
        .page-title {
            font-size: 24px;
        }

        .form-card .card-body {
            padding: 20px;
        }

        .member-top {
            align-items: flex-start;
        }

        .button-row > * {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="page-header">
        <h1 class="page-title">ویرایش عضو</h1>
        <p class="page-subtitle">اطلاعات عضو را به‌روزرسانی کن و تغییرات را ذخیره کن</p>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <div class="section-badge">
                <i class="bi bi-pencil-square"></i>
                <span>فرم ویرایش عضو</span>
            </div>

            <div class="member-top">
                <div class="member-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <div class="member-name">{{ $member->full_name ?? 'عضو صندوق' }}</div>
                    <div class="member-meta">
                        اطلاعات این عضو را ویرایش کن و در پایان ذخیره بزن.
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('members.update',$member) }}">
                @csrf
                @method('PUT')

                <div class="form-box">
                    @include('members.partials.form', ['member' => $member])
                </div>

                <div class="button-row">
                    <button class="btn btn-primary primary-btn">
                        <i class="bi bi-check2-circle ms-1"></i>
                        ذخیره تغییرات
                    </button>

                    <a href="{{ route('members.show',$member) }}" class="btn btn-outline-secondary secondary-btn">
                        <i class="bi bi-arrow-right ms-1"></i>
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection