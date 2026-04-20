<style>
    .field-box {
        padding: 18px;
        border: 1px solid #eef2f7;
        border-radius: 20px;
        background: #fcfdff;
        height: 100%;
    }

    .form-label.custom-label {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
    }

    .modern-input {
        height: 54px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #fff;
        font-size: 14px;
        color: #0f172a;
        transition: all .2s ease;
        box-shadow: none;
    }

    .modern-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 18px;
        pointer-events: none;
        z-index: 2;
    }

    .input-with-icon {
        padding-left: 46px;
    }

    .form-hint {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 8px;
    }
</style>
<div class="row g-4">
    <div class="col-12 col-md-6 col-xl-2">
        <div class="field-box">
            <label class="form-label custom-label">سال</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-calendar2-week"></i>
                </span>
                <input
                    name="year"
                    type="number"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('year', optional($period)->year ?? 1404) }}"
                    placeholder="مثلاً 1404"
                    required
                >
            </div>
            <div class="form-hint">سال دوره را وارد کنید.</div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-2">
        <div class="field-box">
            <label class="form-label custom-label">ماه</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-calendar-month"></i>
                </span>
                <input
                    name="month"
                    type="number"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('month', optional($period)->month ?? 1) }}"
                    placeholder="مثلاً 1"
                    required
                >
            </div>
            <div class="form-hint">شماره ماه دوره را وارد کنید.</div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="field-box">
            <label class="form-label custom-label">شروع</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-calendar-event"></i>
                </span>
                <input
                    name="starts_at"
                    type="date"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('starts_at', optional(optional($period)->starts_at)->format('Y-m-d')) }}"
                    required
                >
            </div>
            <div class="form-hint">تاریخ شروع این دوره را مشخص کنید.</div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="field-box">
            <label class="form-label custom-label">پایان</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-calendar-check"></i>
                </span>
                <input
                    name="ends_at"
                    type="date"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('ends_at', optional(optional($period)->ends_at)->format('Y-m-d')) }}"
                    required
                >
            </div>
            <div class="form-hint">تاریخ پایان این دوره را مشخص کنید.</div>
        </div>
    </div>
</div>