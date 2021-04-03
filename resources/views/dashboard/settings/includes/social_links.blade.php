<div class="tile">
    <form action="{{ route('settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">روابط مواقع التواصل الاجتماعي</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="social_facebook">رابط حساب فيسبوك</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل رابط حساب فيسبوك"
                    id="social_facebook"
                    name="social_facebook"
                    value="{{ config('settings.social_facebook') }}"
                    {{--                    old(config('settings.social_facebook'),'social_facebook')--}}
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_twitter">رابط حساب تويتر</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل رابط حساب تويتر"
                    id="social_twitter"
                    name="social_twitter"
                    value="{{ config('settings.social_twitter') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_instagram">رابط حساب انستقرام</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل رابط حساب انستقرام"
                    id="social_instagram"
                    name="social_instagram"
                    value="{{ config('settings.social_instagram') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_youtube">رابط حساب يوتيوب</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="ادخل رابط حساب يوتيوب"
                    id="social_youtube"
                    name="social_youtube"
                    value="{{ config('settings.social_youtube')}}"
                />
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    @can('تعديل الاعدادات')
                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>تحديث
                            الاعداات
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </form>
</div>
