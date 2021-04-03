<div class="tile">
    <form action="{{ route('settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">إعدادات بوابات الدفع</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="moyasar_payment_method" style="font-size:large">بوابة الدفع ميسر</label>
                <select name="moyasar_payment_method" id="moyasar_payment_method" class="form-control">
                    <option value="1" {{ (config('settings.moyasar_payment_method')) == 1 ? 'selected' : '' }}>تفعيل</option>
                    <option value="0" {{ (config('settings.moyasar_payment_method')) == 0 ? 'selected' : '' }}>تعطيل</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="moyasar_key">المفتاح</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="أدخل مفتاح بوابة ميسر"
                    id="moyasar_key"
                    name="moyasar_key"
                    value="{{ config('settings.moyasar_key') }}"
                />
            </div>
            <div class="form-group pb-2">
                <label class="control-label" for="moyasar_secret_key">المفتاح السري</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل المفتاح السري لبوابة ميسر"
                    id="moyasar_secret_key"
                    name="moyasar_secret_key"
                    value="{{ config('settings.moyasar_secret_key') }}"
                />
            </div>

        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    @can('تعديل الاعدادات')
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>تحديث التعديلات</button>
                    @endcan
                </div>
            </div>
        </div>
    </form>
</div>
