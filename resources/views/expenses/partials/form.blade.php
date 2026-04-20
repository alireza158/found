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

    .field-box {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 18px;
        padding: 16px;
        height: 100%;
    }

    .modern-input {
        height: 52px;
        border: 1px solid #dbe2ea;
        border-radius: 16px;
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

    .input-hint {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 8px;
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
        <span>اطلاعات هزینه</span>
    </div>

    <h3 class="section-title">فرم ثبت هزینه</h3>
    <p class="section-subtitle">اطلاعات مربوط به مبلغ، تاریخ، دسته‌بندی و توضیحات هزینه را وارد کنید.</p>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="field-box">
                <label class="form-label custom-label">مبلغ</label>
                <input
                    name="amount"
                    type="number"
                    class="form-control modern-input"
                    value="{{ old('amount', optional($expense)->amount) }}"
                    required
                >
                <div class="input-hint">مبلغ هزینه را به تومان وارد کنید.</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="field-box">
                <label class="form-label custom-label">تاریخ</label>
                <input
                    name="occurred_at"
                    type="date"
                    class="form-control modern-input"
                    value="{{ old('occurred_at', optional(optional($expense)->occurred_at)->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                    required
                >
            </div>
        </div>

        <div class="col-md-3">
            <div class="field-box">
                <label class="form-label custom-label">دسته</label>
                <input
                    name="category"
                    class="form-control modern-input"
                    value="{{ old('category', optional($expense)->category) }}"
                    placeholder="مثلاً اداری، نگهداری..."
                    required
                >
            </div>
        </div>

        <div class="col-md-9">
            <div class="field-box">
                <label class="form-label custom-label">توضیح</label>
                <input
                    name="description"
                    class="form-control modern-input"
                    value="{{ old('description', optional($expense)->description) }}"
                    placeholder="توضیحی درباره این هزینه بنویسید"
                >
                <div class="input-hint">این بخش اختیاری است اما برای شفافیت بیشتر بهتر است تکمیل شود.</div>
            </div>
        </div>
    </div>
</div>