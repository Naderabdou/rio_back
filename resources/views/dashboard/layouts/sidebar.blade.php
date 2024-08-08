<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a target="__blank" class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('storage/' . getSetting('logo')) }}" width="150px" alt="">
                </a>

            </li>

        </ul>
    </div>
    <div class="divider my-2"></div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main mb-4" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ isActiveRoute('admin.home') }}"><a class="d-flex align-items-center"
                    href="{{ route('admin.home') }}"><i class="fas fa-home"></i> <span
                        class="menu-title text-truncate">{{ transWord('الرئيسية') }}</span></a>
            </li>





            <li class="nav-item {{ areActiveRoutes(['admin.questions.index', 'admin.questions.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.questions.index') }}">
                    <i class="fas fa-question-circle"></i>
                    <span class="menu-title text-truncate">{{ transWord('الاسئله المتكرره') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.categories.index', 'admin.categories.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-list-alt"></i>
                    <span class="menu-title text-truncate">{{ transWord('الاقسام') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.features.index', 'admin.features.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.features.index') }}">
                    <i class="fas fa-star"></i>
                    <span class="menu-title text-truncate">{{ transWord('المميزات') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.brands.index') }}">
                    <i class="fas fa-tags"></i>
                    <span class="menu-title text-truncate">{{ transWord('مواد التصنيع') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.products.index', 'admin.products.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-box-open"></i>
                    <span class="menu-title text-truncate">{{ transWord('المنتجات') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.ourValues.index', 'admin.ourValues.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.ourValues.index') }}">
                    <i class="fas fa-heart"></i>
                    <span class="menu-title text-truncate">{{ transWord('خصائص المنتج') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.banners.index', 'admin.banners.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.banners.index') }}">
                    <i class="fas fa-ad"></i>
                    <span class="menu-title text-truncate">{{ transWord('الاعلانات') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.coupons.index', 'admin.coupons.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.coupons.index') }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="menu-title text-truncate">{{ transWord('اكواد الخصم') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.payments.index', 'admin.payments.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.payments.index') }}">
                    <i class="fas fa-credit-card"></i>
                    <span class="menu-title text-truncate">{{ transWord('وسائل الدفع') }}</span>
                </a>
            </li>


            <li class="nav-item {{ areActiveRoutes(['admin.governorates.index', 'admin.governorates.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.governorates.index') }}">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="menu-title text-truncate">{{ transWord('اسعار الشحن') }}</span>
                </a>
            </li>






            {{-- <li class="nav-item {{ areActiveRoutes(['admin.teams.index', 'admin.teams.edit']) }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.teams.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span class="menu-title text-truncate">{{ transWord('فريق العمل') }}</span>
                    </a>
                </li> --}}


            <li class="nav-item {{ areActiveRoutes(['admin.sliders.index', 'admin.sliders.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.sliders.index') }}">
                    <i class="fa-solid fa-images"></i>
                    <span class="menu-title text-truncate">{{ transWord('الاسليدر') }}</span>
                </a>
            </li>




            <li class="nav-item {{ areActiveRoutes(['admin.merchants.index', 'admin.merchants.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.merchants.index') }}">
                    <i class="fas fa-store"></i>
                    <span class="menu-title text-truncate">{{ transWord(' التجار') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.reviews.index', 'admin.reviews.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.reviews.index') }}">
                    <i class="fas fa-star"></i>
                    <span class="menu-title text-truncate">{{ transWord(' التقيمات') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.orders.index', 'admin.orders.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="menu-title text-truncate">{{ transWord(' طلبات المنتجات') }}</span>
                </a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.order-merchants.index', 'admin.order-merchants.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.order-merchants.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="menu-title text-truncate">{{ transWord('طلبات المنتجات التجار') }}</span>
                </a>
            </li>



            {{--
            <li class="nav-item {{ areActiveRoutes(['admin.subscribe.index', 'admin.subscribe.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.subscribe.index') }}">
                    <i class="fas fa-rss"></i>
                    <span class="menu-title text-truncate">{{ transWord(' الاشتركات') }}</span>
                </a>
            </li> --}}






            <li class="nav-item {{ areActiveRoutes(['admin.contacts.index', 'admin.contacts.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.contacts.index') }}"><i
                        class="fa-solid fa-inbox"></i><span
                        class="menu-title text-truncate">{{ transWord('رسائل التواصل') }}</span></a>
            </li>









            {{-- @can('tools')
                <li class="nav-item {{ areActiveRoutes(['admin.tools.index', 'admin.tools.edit']) }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.tools.index') }}"><i
                            class="fas fa-network-wired"></i><span
                            class="menu-title text-truncate">{{ transWord('أدوات الربط') }}</span></a>
                </li>
            @endcan --}}

            <li class="nav-item {{ isActiveRoute('admin.settings.create') }}"><a class="d-flex align-items-center"
                    href="{{ route('admin.settings.create') }}"><i class="fa-solid fa-gear"></i><span
                        class="menu-title text-truncate">{{ transWord('الإعدادات') }}</span></a>
            </li>
        </ul>

    </div>
</div>
<!-- END: Main Menu-->
