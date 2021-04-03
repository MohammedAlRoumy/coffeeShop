<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <h3 class="brand-logo" style="color: white">
            {{--            <img alt="Logo" src="{{asset('assets/media/logos/logo-light.png')}}" />--}}
            {{config('settings.site_name')}}
        </h3>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
										<path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
									</g>
								</svg>
                                <!--end::Svg Icon-->
							</span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
             data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{route('admin.dashboard')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-chalkboard"></i>
										</span>
                        <span class="menu-text">الرئيسية</span>
                    </a>
                </li>
                @can('المشرفين')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('admins.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-users-cog"></i>
										</span>
                            <span class="menu-text">المشرفون</span>
                        </a>
                    </li>
                @endcan
                @can('الوكلاء')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('agents.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
										<i class="fas fa-user-tie"></i>
										</span>
                            <span class="menu-text">الوكلاء</span>
                        </a>
                    </li>
                @endcan
                @can('المستخدمين')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('users.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
										<i class="fas fa-users"></i>
										</span>
                            <span class="menu-text">المستخدمون</span>
                        </a>
                    </li>
                @endcan
                @can('الصلاحيات')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('roles.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-coins"></i>
										</span>
                            <span class="menu-text">الصلاحيات</span>
                        </a>
                    </li>
                @endcan
                @can('العلامات التجارية')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('brands.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-gem"></i>
										</span>
                            <span class="menu-text">العلامات التجارية</span>
                        </a>
                    </li>
                @endcan
                @can('التصنيفات')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('categories.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-sitemap"></i>
										</span>
                            <span class="menu-text">التصنيفات</span>
                        </a>
                    </li>
                @endcan
                @can('المنتجات')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('products.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-weight-hanging"></i>
										</span>
                            <span class="menu-text">المنتجات</span>
                        </a>
                    </li>
                @endcan
                @can('الطلبات')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('orders.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-clipboard-list"></i>
										</span>
                            <span class="menu-text">الطلبات</span>
                        </a>
                    </li>
                @endcan
                @can('اكواد الخصم')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('coupons.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="far fa-money-bill-alt"></i>
										</span>
                            <span class="menu-text">اكواد الخصم</span>
                        </a>
                    </li>
                @endcan
                @can('الدول')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('countries.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fab fa-font-awesome-flag"></i>
										</span>
                            <span class="menu-text">الدول</span>
                        </a>
                    </li>
                @endcan
                @can('المدن')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('cities.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-city"></i>
										</span>
                            <span class="menu-text">المدن</span>
                        </a>
                    </li>
                @endcan
                @can('السلايدر')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('sliders.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-sliders-h"></i>
										</span>
                            <span class="menu-text">السلايدر</span>
                        </a>
                    </li>
                @endcan
                @can('من نحن')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('abouts.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-microphone"></i>
										</span>
                            <span class="menu-text">من نحن</span>
                        </a>
                    </li>
                @endcan
                @can('اتصل بنا')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('contacts.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="far fa-comment-dots"></i>
										</span>
                            <span class="menu-text">رسائل اتصل بنا</span>
                        </a>
                    </li>
                @endcan
                @can('الاعدادات')
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route('settings.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-cogs"></i>
										</span>
                            <span class="menu-text">الاعدادات</span>
                        </a>
                    </li>
                @endcan
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
