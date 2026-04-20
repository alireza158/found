<style>
    .modern-form-card {
        border: 0;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        padding: 24px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .section-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .custom-label {
        font-weight: 700;
        color: #334155;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .modern-input,
    .modern-select,
    .modern-textarea {
        border: 1px solid #dbe2ea;
        border-radius: 16px;
        background: #fff;
        font-size: 14px;
        transition: all .25s ease;
        box-shadow: none;
    }

    .modern-input,
    .modern-select {
        height: 52px;
        padding: 0 16px;
    }

    .modern-textarea {
        padding: 14px 16px;
        min-height: 120px;
        resize: vertical;
    }

    .modern-input:focus,
    .modern-select:focus,
    .modern-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
    }

    .input-hint {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 8px;
    }

    .field-box {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 18px;
        padding: 16px;
        height: 100%;
    }

    .json-box {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        padding: 16px;
    }

    .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    @media (max-width: 767.98px) {
        .modern-form-card {
            padding: 18px;
            border-radius: 20px;
        }
    }
</style>

<div class="modern-form-card">
    <div class="badge-soft">
        <span>●</span>
        <span>تنظیمات قرعه‌کشی</span>
    </div>

    <h3 class="section-title">اطلاعات قرعه</h3>
    <p class="section-subtitle">اطلاعات دوره، تاریخ اجرا، روش انتخاب و قوانین مربوط به قرعه را وارد کنید.</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="field-box">
                <label class="form-label custom-label">ID دوره</label>
                <input
                    name="period_id"
                    type="number"
                    class="form-control modern-input"
                    value="{{ old('period_id', optional($draw)->period_id) }}"
                    required
                >
                <div class="input-hint">در نسخه کامل بهتر است این فیلد به صورت Dropdown انتخاب شود.</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="field-box">
                <label class="form-label custom-label">تاریخ قرعه</label>
                <input
                    name="draw_date"
                    type="date"
                    class="form-control modern-input"
                    value="{{ old('draw_date', optional(optional($draw)->draw_date)->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                    required
                >
            </div>
        </div>

        <div class="col-md-4">
            <div class="field-box">
                <label class="form-label custom-label">روش</label>
                <select name="method" class="form-select modern-select" required>
                    <option value="random" @selected(old('method', optional($draw)->method ?? 'random') === 'random')>random</option>
                    <option value="manual" @selected(old('method', optional($draw)->method ?? 'random') === 'manual')>manual</option>
                </select>
            </div>
        </div>

        @if($draw)
        <div class="col-md-6">
            <div class="field-box">
                <label class="form-label custom-label">برنده (اختیاری)</label>
                <input
                    name="winner_member_id"
                    type="number"
                    class="form-control modern-input"
                    value="{{ old('winner_member_id', optional($draw)->winner_member_id) }}"
                >
                <div class="input-hint">اگر این مقدار وارد شود، اجرای قرعه از همین عضو استفاده می‌کند.</div>
            </div>
        </div>
        @endif

        <div class="col-12">
            <div class="json-box">
                <label class="form-label custom-label">Rules JSON (اختیاری)</label>
                <textarea
                    name="rules_json"
                    class="form-control modern-textarea"
                    rows="4"
                    placeholder='{"require_no_active_loan":true,"require_paid_contribution":true}'
                >{{ old('rules_json', $draw ? json_encode($draw->rules_json, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
                <div class="input-hint">
                    قوانین دلخواه قرعه را به صورت JSON وارد کنید. مثال: فقط اعضایی که وام فعال ندارند و اشتراک پرداخت کرده‌اند.
                </div>
            </div>
        </div>
    </div>
</div>