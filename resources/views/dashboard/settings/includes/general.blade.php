<div class="tile">
    <form action="{{ route('settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">الاعدادات العامة</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">اسم المتجر</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل اسم المتجر"
                    id="site_name"
                    name="site_name"
                    value="{{ config('settings.site_name') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">عنوان المتجر</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل عنوان المتجر"
                    id="site_title"
                    name="site_title"
                    value="{{ config('settings.site_title') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_email_address">عنوان البريد الالكتروني</label>
                <input
                    class="form-control"
                    type="email"
                    placeholder="اخل عنوان البريد الالكتروني"
                    id="default_email_address"
                    name="default_email_address"
                    value="{{ config('settings.default_email_address') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_email_address">رقم الهاتف</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder=" رقم الهاتف"
                    id="default_phone"
                    name="default_phone"
                    value="{{ config('settings.default_phone') }}"
                />
            </div>

            <div class="form-group">
                <label class="control-label" for="default_country">اسم الدولة</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="اسم الدولة "
                    id="default_country"
                    name="default_country"
                    value="{{ config('settings.default_country') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_city">اسم المدينة</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder=" اسم المدينة"
                    id="default_city"
                    name="default_city"
                    value="{{ config('settings.default_city') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_address">اسم الشارع</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder=" اسم الشارع "
                    id="default_address"
                    name="default_address"
                    value="{{ config('settings.default_address') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="currency_code">رمز العملة</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل رمز العملة"
                    id="currency_code"
                    name="currency_code"
                    value="{{ config('settings.currency_code') }}"
                />
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    @can('تعديل الاعدادات')
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>تحديث الاعدادات</button>
                    @endcan
                </div>
            </div>
        </div>
    </form>
</div>
