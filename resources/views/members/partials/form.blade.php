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

    .modern-input,
    .modern-select {
        height: 54px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #fff;
        font-size: 14px;
        color: #0f172a;
        transition: all .2s ease;
        box-shadow: none;
    }

    .modern-input:focus,
    .modern-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .input-with-icon {
        padding-left: 46px;
    }
</style>
<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="field-box">
            <label class="form-label custom-label">نام و نام خانوادگی</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-person"></i>
                </span>
                <input
                    name="full_name"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('full_name', optional($member)->full_name) }}"
                    placeholder="نام و نام خانوادگی را وارد کنید"
                    required
                >
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="field-box">
            <label class="form-label custom-label">موبایل</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-phone"></i>
                </span>
                <input
                    name="phone"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('phone', optional($member)->phone) }}"
                    placeholder="09xxxxxxxxx"
                >
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="field-box">
            <label class="form-label custom-label">کد ملی</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-credit-card-2-front"></i>
                </span>
                <input
                    name="national_id"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('national_id', optional($member)->national_id) }}"
                    placeholder="کد ملی"
                >
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="field-box">
            <label class="form-label custom-label">تاریخ عضویت</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-calendar-event"></i>
                </span>
                <input
                    name="joined_at"
                    type="date"
                    class="form-control modern-input input-with-icon"
                    value="{{ old('joined_at', optional(optional($member)->joined_at)->format('Y-m-d')) }}"
                >
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="field-box">
            <label class="form-label custom-label">وضعیت</label>
            <div class="input-icon-wrap">
                <span class="input-icon">
                    <i class="bi bi-check2-circle"></i>
                </span>
                <select class="form-select modern-select input-with-icon" name="is_active">
                    <option value="1" @selected(old('is_active', optional($member)->is_active ?? 1)==1)>فعال</option>
                    <option value="0" @selected(old('is_active', optional($member)->is_active ?? 1)==0)>غیرفعال</option>
                </select>
            </div>
        </div>
    </div>
</div>