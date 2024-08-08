        <!-- start footer ==============================
        ============================== -->
        <footer class="footer" style="background-image: url( {{ asset('storage/' . getSetting('footer_image')) }});">
            <div class="main-container">
                <div class="logo-footer">
                    <img src="{{ asset('storage/' . getSetting('footer_logo')) }}" alt="">
                </div>
                <p> {{ getSetting('footer_desc', app()->getLocale()) }} </p>

                <div class="element-footer">
                    <ul>
                        <li><a href="{{ route('site.aboutUs') }}">{{ transWord('من نحن') }}</a></li>
                        <li><a href="{{ route('site.products') }}">{{ transWord('منتجاتنا') }}</a></li>
                        <li><a target="__blank"
                                href="{{ url(asset('storage/' . getSetting('policy_return'))) }}">{{ transWord('سياسه الاسترجاع و الاستبدال') }}</a>
                        </li>
                        <li><a target="__blank"
                                href="{{ url(asset('storage/' . getSetting('policy_shapping'))) }}">{{ transWord('سياسه الشحن') }}</a>
                        </li>
                        <li><a href="{{ route('site.contactUs') }}">{{ transWord('تواصل معنا') }}</a></li>
                    </ul>
                </div>
                <div class="sco-media-f">
                    <ul>
                        <li><a target="_blank" href="https://wa.me/{{ getSetting('whatsapp') }}"><i
                                    class="bi bi-whatsapp"></i></a></li>
                        <li><a target="_blank" href="{{ getSetting('twitter') }}"><i class="bi bi-twitter-x"></i></a>
                        </li>
                        <li><a target="_blank" href="{{ getSetting('instagram') }}"><i class="bi bi-instagram"></i></a>
                        </li>
                        <li><a target="_blank" href="{{ getSetting('facebook') }}"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li><a target="_blank" href="{{ getSetting('tiktok') }}"><i class="bi bi-tiktok"></i></a></li>

                    </ul>
                </div>
            </div>
            <div class="end-page">
                <p>
                    {{ transWord('كل الحقوق محفوظة') }} {{ getSetting('name_website', app()->getLocale()) }} &copy;
                    {{ date('Y') }}
                </p>
                <a target="_blank" href="https://jaadara.com/"> {{ transWord('صنع بكل حب ') }}<i class="bi bi-heart-fill"></i>
                    {{ transWord('في معامل جدارة ') }}</a>
            </div>


        </footer>
        <!-- end footer=========================
        ===========================  -->





        <!-- start modal aosh =============
        ======================== -->
        <div class="modal fade login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-fotm-aosh">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <i class="bi bi-x-circle"></i></span>
                        </button>
                        <div class="logo-aosh">
                            <a href="index.html">
                                <object data="{{ asset('site/images/logo.svg') }}" type="">
                                    <img src="{{ asset('site/images/logo.svg') }}" alt="">
                                </object>
                            </a>
                        </div>

                        <div class="links-tab-aosh">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-aosh" data-toggle="pill" href="#aosh-login"
                                        role="tab" aria-controls="aosh-login"
                                        aria-selected="true">{{ transWord('تسجيل دخول') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-lo" data-toggle="pill" href="#pills-profile"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">
                                        {{ transWord('انشاء حساب جديد') }}
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="aosh-login" role="tabpanel"
                                aria-labelledby="pills-aosh">
                                <form action="{{ route('site.login') }}" method="post" id="storeLogin">
                                    @csrf
                                    <div class="form-aosh">
                                        <div class="input-form">
                                            <input type="text"
                                                placeholder="{{ transWord('البريد الالكتروني/ رقم الهاتف') }}"
                                                class="form-control" name="emailOrPhone">
                                            <div style="color: red" id="emailOrPhone_error" class="error-message"></div>

                                        </div>
                                        <div class="input-form">
                                            <input type="password" placeholder="{{ transWord('كلمة المرور') }}"
                                                class="form-control" name="password">
                                            <span class="toggle-password" class="toggle-password"
                                                style="{{ app()->getLocale() === 'en' ? 'right: 22px;' : 'left: 22px;' }}">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div style="color: red" id="password_error" class="error-message"></div>

                                        </div>
                                        <div class="btn-aosh">
                                            <button id="btn_login"
                                                class="w-100 ctm-btn">{{ transWord('تسجيل الدخول') }}
                                            </button>
                                            <a id="forget_pass" href="" data-toggle="modal"
                                                data-target=".forget-password-modal"
                                                data-dismiss="modal">{{ transWord(' هل نسيت كلمة المرور ؟') }} </a>
                                        </div>
                                    </div>
                                </form>


                            </div>
                            {{-- register form --}}
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-lo">
                                <form action="{{ route('site.register') }}" method="post" id="register_store"
                                    data-email="{{ route('admin.check.email') }}"
                                    data-phone="{{ route('admin.check.phone') }}">

                                    @csrf
                                    <div class="form-aosh">
                                        <div class="input-form">
                                            <input type="text" placeholder="{{ transWord('الاسم') }}"
                                                class="form-control" name="name">
                                            <div style="color: red" id="name_error" class="error-message"></div>

                                        </div>

                                        <div class="input-form">
                                            <input id="email" type="email"
                                                placeholder="{{ transWord('البريد الالكتروني') }}"
                                                class="form-control" name="email">
                                            <div style="color: red" id="email_error" class="error-message"></div>

                                        </div>

                                        <div class="input-form">
                                            <input id="phone" type="tel"
                                                placeholder="{{ transWord('رقم الهاتف') }}" class="form-control"
                                                name="phone">
                                            <div style="color: red" id="phone_error" class="error-message"></div>

                                        </div>

                                        <div class="input-form">
                                            <input id="password" type="password"
                                                placeholder="{{ transWord('كلمة المرور') }}" class="form-control"
                                                name="password">
                                            <span class="toggle-password" class="toggle-password"
                                                style="{{ app()->getLocale() === 'en' ? 'right: 22px;' : 'left: 22px;' }}">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div style="color: red" id="password_error" class="error-message"></div>

                                        </div>

                                        <div class="input-form">
                                            <input id="password_confirmation" type="password"
                                                placeholder="{{ transWord('تأكيد كلمة المرور') }}"
                                                class="form-control" name="password_confirmation">
                                            <span class="toggle-password" class="toggle-password"
                                                style="{{ app()->getLocale() === 'en' ? 'right: 22px;' : 'left: 22px;' }}">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div style="color: red" id="password_confirmation_error"
                                                class="error-message"></div>

                                        </div>

                                        <div class="btn-aosh">

                                            <div class="input-check">
                                                <input type="checkbox" id="check-0" name="check">
                                                <label for="check-0">
                                                    {{ transWord('أوافق على شروط وأحكام وسياسة خصوصيةRioplast') }}
                                                </label>


                                                {{-- <div style="color: red" id="check_error" class="error-message"></div> --}}

                                            </div>
                                            <button class="w-100 ctm-btn" id="reg_btn">{{ transWord('تسجيل') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal aosh =============
        ======================== -->







        <!-- start modal forget-password  ===========
        =============== -->
        <div class="modal fade forget-password-modal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-fotm-aosh">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <i class="bi bi-x-circle"></i></span>
                        </button>
                        <div class="logo-aosh">
                            <a href="{{ route('site.home') }}">
                                <object data="{{ asset('site/images/logo.svg') }}" type="">
                                    <img src="{{ asset('site/images/logo.svg') }}" alt="">
                                </object>
                            </a>
                        </div>



                        <form action="{{ route('site.forgetPassword') }}" id="form_forget" method="post">
                            @csrf
                            <div class="title-aosh">
                                <h2>{{ transWord('نسيت كلمة المرور') }}</h2>
                                <p>{{ transWord('يمكنك تغيير كلمة المرور من خلال البريد الالكتروني الخاص بك ') }}</p>
                            </div>
                            <div class="form-aosh">

                                <div class="input-form">
                                    <input type="email" placeholder="{{ transWord('البريد الالكتروني') }}"
                                        class="form-control" name="email">
                                    <div style="color: red" class="email_error" class="error-message"></div>


                                </div>

                                <div class="btn-aosh">
                                    <button id="btn_forget" class="w-100 ctm-btn">{{ transWord('ارسال') }}</button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
        <!-- end modal forget-password  ===========
        =============== -->



        <!-- start modal code-password  ===========
        =============== -->
        <div class="modal fade code-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-fotm-aosh">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <i class="bi bi-x-circle"></i></span>
                        </button>
                        <div class="logo-aosh">
                            <a href="index.html">
                                <object data="{{ asset('site/images/logo.svg') }}" type="">
                                    <img src="{{ asset('site/images/logo.svg') }}" alt="">
                                </object>
                            </a>
                        </div>



                        <form action="{{ route('site.checkCode') }}" method="post" id="form_checkCode">
                            @csrf
                            <input type="hidden" name="email" id="email_check" value="">
                            <div class="title-aosh">
                                <h2>{{ transWord('ادخال كود التحقق') }}</h2>
                                <p id="email_code">
                                    {{ transWord('برجاء ادخال كود التحقق المرسل الي البريد الالكتروني') }}
                                    AHMED24@GMAIL.COM</p>
                            </div>
                            <div class="form-aosh">

                                <div class="otp-container">
                                    <input type="text" class="otp-input" pattern="\d" maxlength="1"
                                        name="code[]">
                                    <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled
                                        name="code[]">
                                    <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled
                                        name="code[]">
                                    <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled
                                        name="code[]">

                                </div>
                                <div style="color: red" class="code_error" class="error-message"></div>

                                <div class="btn-aosh">
                                    <button class="w-100 ctm-btn btn_checkCode">{{ transWord('ارسال') }}</button>
                                    <div class="resend-massage">
                                        <p>{{ transWord('لم يتم استلام الكود') }} <a id="resend_code"
                                                href="{{ route('site.resendCode') }}">
                                                {{ transWord('اضغط لاعادة الارسال') }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
        <!-- end modal code-password  ===========
        =============== -->



        <!-- start modal comfirm-password-modal  ===========
        =============== -->
        <div class="modal fade comfirm-password-modal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-fotm-aosh">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <i class="bi bi-x-circle"></i></span>
                        </button>
                        <div class="logo-aosh">
                            <a href="{{ route('site.home') }}">
                                <object data="{{ asset('site/images/logo.svg') }}" type="">
                                    <img src="{{ asset('site/images/logo.svg') }}" alt="">
                                </object>
                            </a>
                        </div>



                        <form action="{{ route('site.updatePassword') }}" id="form_update_password" method="POST">
                            <div class="title-aosh">
                                @csrf
                                <input type="hidden" name="email" id="email_update" value="">
                                <h2>{{ transWord('إعادة تعيين كلمة المرور') }}</h2>
                                <p>{{ transWord('يمكنك تغيير كلمة المرور الان لضمان ') }}</p>
                            </div>
                            <div class="form-aosh">

                                <div class="input-form">
                                    <input type="password" placeholder="{{ transWord('كلمة المرور') }}"
                                        class="form-control" name="password">
                                    <span class="toggle-password" class="toggle-password"
                                        style="{{ app()->getLocale() === 'en' ? 'right: 22px;' : 'left: 22px;' }}">
                                        <i class="fa fa-eye"></i>
                                    </span>

                                    <div style="color: red" class="password_error" class="error-message"></div>

                                </div>
                                <div class="input-form">
                                    <input type="password" placeholder="{{ transWord('تأكيد كلمة المرور') }}"
                                        class="form-control" name="password_confirmation">
                                    <span class="toggle-password" class="toggle-password"
                                        style="{{ app()->getLocale() === 'en' ? 'right: 22px;' : 'left: 22px;' }}">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    <div style="color: red" class="password_confirmation_error"
                                        class="error-message"></div>


                                </div>
                                <div class="btn-aosh">
                                    <button id="btn_password" class="w-100 ctm-btn">{{ transWord('ارسال') }}</button>

                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
        <!-- end modal forget-password  ===========
        =============== -->







        <!-- start add to cart  ======
    =================== -->
        <div class="cart-header" id="add_cart">
            <div class="title-cart-header" data-count="{{ auth()->user()?->cart?->orderItems?->count() ?? 0 }}">
                <h2> {{ transWord('عربة التسوق ') }}</h2>
                <div class="close-cart-header"><i class="bi bi-x-circle"></i></div>
            </div>

            <div class="product-cart-header">
                <ul>
                    @if (auth()->user() && auth()->user()->cart)
                        @php
                            $orderItems = auth()->user()->cart;
                        @endphp
                        @forelse ($orderItems->orderItems as $item)
                            <li>
                                <div class="img-product-cart-header">
                                    <img src="{{ $item?->products?->image_path }}" alt="">
                                </div>
                                <div class="text-product-cart-header">
                                    <h2> <span> {{ $item->product_name }}</span>
                                        <button class="remove-cart-header"
                                            data-url="{{ route('site.cart.destroy', $item->id) }}"> <i
                                                class="bi bi-trash"></i></button>
                                    </h2>
                                    <div>
                                        <span id="quanti_cart-{{ $item->id }}"> {{ $item->quantity }}</span>
                                        <div class="price-cart-header"> {{ $item->price }} {{ transWord('جنية') }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty

                            <h3 id="order_emty">
                                {{ transWord('لا يوجد منتجات في العربة') }}
                            </h3>
                        @endforelse
                    @else
                        <h3 id="order_emty">
                            {{ transWord('لا يوجد منتجات في العربة') }}
                        </h3>

                    @endif



                </ul>
            </div>
            @if (auth()->user() && auth()->user()->cart)
                @if ($orderItems->orderItems->count() > 0)
                    <div class="btns-cart-header">
                        <div class="total-cart-header pb-3">
                            <h2> {{ transWord('المجموع') }} <span class="totel_cart">
                                    {{ $orderItems->price_before_discount }} {{ transWord('جنية') }}
                                </span>
                            </h2>
                        </div>
                        <a href="{{ route('site.cart') }}" class="w-100 mt-2 ctm-btn2">
                            {{ transWord('مشاهدة عربة التسوق') }}</a>
                        <a href="{{ route('site.checkout') }}"
                            class="w-100 mt-2 ctm-btn">{{ transWord('اتمام عملية الشراء') }}</a>
                    </div>
                @endif
            @endif
        </div>
        <!-- end add to cart  ======
    =================== -->




        <!-- start menu responsive ===
        ======== -->
        <div class="bg_menu ">
        </div>
        <div class="menu_responsive" id="menu-div">

            <div class="logo-menu">
                <img src="{{ asset('storage/' . getSetting('logo')) }}" alt="">
            </div>
            {{-- <div class="search-mune">
                <form action="">
                    <input type="text" placeholder="البحث .. " class="form-control" name="search">
                    <button> <img src="images/icon/search.svg" alt=""></button>
                </form>
            </div> --}}

            @livewire('search-mobile')
            <div class="element_menu_responsive">
                <ul>
                    <li><a href="{{ route('site.home') }}">{{ transWord('الرئيسية') }}</a></li>
                    <li><a href="{{ route('site.aboutUs') }}"> {{ transWord('عن الشركة') }}</a></li>
                    <li><a href="{{ route('site.products') }}">{{ transWord(' منتجاتنا ') }}</a></li>
                    <li><a href="{{ route('site.contactUs') }}">{{ transWord('تواصل معنا') }}</a></li>
                    <li>
                        <a href="{{ route('site.lang', app()->getLocale() == 'ar' ? 'en' : 'ar') }}">
                            {{-- {{ app()->getLocale() === 'ar' ? 'English' : 'عربي' }} --}}
                            <img width="51px" height="37px"
                                src=" {{ app()->getLocale() === 'ar' ? asset('site/images/united.png') : asset('site/images/flag.png') }}"
                                alt="">
                        </a>

                    </li>
                </ul>
            </div>



            <div class="remove-mune">
                <span></span>
            </div>




        </div>



        <!-- end menu responsive ===
            ======== -->

        </div>


        @include('site.layouts.script')





        </body>
        <!-- end-body
    =================== -->

        </html>
