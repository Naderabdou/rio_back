<header class="header active">
    <!-- top par  -->
    <div class="top-par">
        <div class="main-container">
            <div class="logo">
                <a href="{{ route('site.home') }}">
                    <object data="{{ asset('storage/' . getSetting('logo')) }}" type="">
                        <img src="{{ asset('storage/' . getSetting('logo')) }}" alt="">
                    </object>
                </a>
            </div>

            <div class="search-top-par">
                <form action="{{ route('site.products') }}">
                    <input type="text" placeholder="{{ transWord('البحث ..') }}" class="form-control" name="search">
                    <button> <img src="{{ asset('site/images/icon/search.svg') }}" alt=""></button>
                </form>
            </div>


            <div class="btn-top-par">



                @guest
                    <div class="btn-sin">

                        <a href="" data-toggle="modal" data-target=".login-modal">
                            <svg width="22" height="31" viewBox="0 0 22 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.0502 14.2718C10.9062 14.2574 10.7335 14.2574 10.5751 14.2718C7.14814 14.1566 4.42676 11.3488 4.42676 7.8931C4.42676 4.36537 7.27773 1.5 10.8199 1.5C14.3476 1.5 17.2129 4.36537 17.2129 7.8931C17.1986 11.3488 14.4772 14.1566 11.0502 14.2718Z"
                                    stroke="#00ABE3" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M3.61339 19.1278C0.128869 21.4604 0.128869 25.2617 3.61339 27.5799C7.57308 30.2293 14.067 30.2293 18.0267 27.5799C21.5112 25.2473 21.5112 21.446 18.0267 19.1278C14.0814 16.4928 7.58748 16.4928 3.61339 19.1278Z"
                                    stroke="#00ABE3" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span> {{ transWord('تسجيل الدخول') }} </span>
                        </a>
                    </div>

                @endguest


                @auth

                <div class="btn-sin">

                    <a href="{{ route('site.profile') }}">
                        <svg width="22" height="31" viewBox="0 0 22 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.0502 14.2718C10.9062 14.2574 10.7335 14.2574 10.5751 14.2718C7.14814 14.1566 4.42676 11.3488 4.42676 7.8931C4.42676 4.36537 7.27773 1.5 10.8199 1.5C14.3476 1.5 17.2129 4.36537 17.2129 7.8931C17.1986 11.3488 14.4772 14.1566 11.0502 14.2718Z"
                                stroke="#00ABE3" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M3.61339 19.1278C0.128869 21.4604 0.128869 25.2617 3.61339 27.5799C7.57308 30.2293 14.067 30.2293 18.0267 27.5799C21.5112 25.2473 21.5112 21.446 18.0267 19.1278C14.0814 16.4928 7.58748 16.4928 3.61339 19.1278Z"
                                stroke="#00ABE3" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span id="username"> {{ auth()->user()->name }}</span>
                    </a>
                </div>

                <div class="btn-heart">
                    <a href="">
                        <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.8267 28.2467C16.3734 28.4067 15.6267 28.4067 15.1734 28.2467C11.3067 26.9267 2.66675 21.42 2.66675 12.0867C2.66675 7.96667 5.98675 4.63333 10.0801 4.63333C12.5067 4.63333 14.6534 5.80667 16.0001 7.62C17.3467 5.80667 19.5067 4.63333 21.9201 4.63333C26.0134 4.63333 29.3334 7.96667 29.3334 12.0867C29.3334 21.42 20.6934 26.9267 16.8267 28.2467Z"
                                stroke="#333333" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span> {{ transWord('المفضلة') }} </span>
                    </a>
                </div>
                <div class="btn-cart-nav">
                    <a href="">
                        <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.6665 3.16665H4.98651C6.42651 3.16665 7.55984 4.40665 7.43984 5.83332L6.33317 19.1133C6.1465 21.2866 7.86649 23.1533 10.0532 23.1533H24.2532C26.1732 23.1533 27.8532 21.58 27.9998 19.6733L28.7198 9.67332C28.8798 7.45999 27.1998 5.65998 24.9732 5.65998H7.75985"
                                stroke="#333333" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M21.6667 29.8333C22.5871 29.8333 23.3333 29.0871 23.3333 28.1667C23.3333 27.2462 22.5871 26.5 21.6667 26.5C20.7462 26.5 20 27.2462 20 28.1667C20 29.0871 20.7462 29.8333 21.6667 29.8333Z"
                                stroke="#333333" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M11.0002 29.8333C11.9206 29.8333 12.6668 29.0871 12.6668 28.1667C12.6668 27.2462 11.9206 26.5 11.0002 26.5C10.0797 26.5 9.3335 27.2462 9.3335 28.1667C9.3335 29.0871 10.0797 29.8333 11.0002 29.8333Z"
                                stroke="#333333" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 11.1667H28" stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span> {{ transWord('السلة') }} </span>
                    </a>
                </div>
                @endauth
                <div class="menu-div">
                    <div class="content" id="times-ican">
                        <a href="#" title="Navigation menu" class="navicon" aria-label="Navigation">
                            <span class="navicon__item"></span>
                            <span class="navicon__item"></span>
                            <span class="navicon__item"></span>
                            <span class="navicon__item"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- = ---- = -->

    <nav class="nav-par">
        <div class="main-container">
            <div class="nav-all-categories">
                <button class="btn-all-categories"> <span>{{ transWord('كل الاقسام ') }}</span> </button>
                <div class="all-categories">
                    <ul>
                        @forelse ($categories as $category)
                            <li>
                                <button href=""> <span> <img src="{{ $category->image_path }}" alt="">
                                        {{ $category->name }}
                                    </span> <i class="bi bi-chevron-left"></i> </button>
                                <div class="show-categories">
                                    <h2> {{ $category->name }} <button class="back-categories"> <i
                                                class="bi bi-x-circle"></i>
                                        </button></h2>
                                    <ul>
                                        @foreach ($category->products as $product)
                                            <li><a href="{{ route('site.products.show', $product->id) }}">{{ $product->name }}
                                                    <i class="bi bi-chevron-left"></i> </a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </li>
                        @empty
                            <li>
                                <h2>
                                    {{ transWord('لا يوجد اقسام') }}
                                </h2>
                            </li>

                        @endforelse



                    </ul>
                </div>
            </div>
            <div class="element">
                <ul>
                    <li><a href="{{ route('site.home') }}">{{ transWord('الرئيسية') }}</a></li>
                    <li><a href="{{ route('site.aboutUs') }}"> {{ transWord('من نحن') }}</a></li>
                    <li><a href="{{ route('site.products') }}"> {{ transWord('منتجاتنا') }} </a></li>
                    <li><a href="{{ route('site.contactUs') }}">{{ transWord('تواصل معنا') }}</a></li>

                    <li> <a href="{{ route('site.lang', app()->getLocale() == 'ar' ? 'en' : 'ar') }}">{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sco-media">
                <ul>
                    <li><a target="_blank" href="https://wa.me/{{ getSetting('whatsapp') }}"><i
                                class="bi bi-whatsapp"></i></a></li>
                    <li><a href="{{ getSetting('twitter') }}"><i class="bi bi-twitter-x"></i></a></li>
                    <li><a href="{{ getSetting('instagram') }}"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="{{ getSetting('facebook') }}"><i class="bi bi-facebook"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('sub-header')

</header>
