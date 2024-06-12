@extends('dashboard.layouts.app')

@section('title', transWord('الرئيسية'))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Greetings Card starts -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ transWord('المقدمة') }}</h6>
                                </div>
                                <div class="card-body animate__animated animate__bounce">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                                            style="width: 25rem; filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.68));"
                                            src="{{ asset('dashboard/assets/img/home/jaadara.png') }}" alt="...">
                                    </div>
                                    <div>
                                        <p>
                                            {{ transWord('منذ البداية ومن أول يوم نشأت فيها شركة جدارة ونحن نسعى لنكون دائما جديرين بثقة عملاءنا و تحقيق المستوى المنشود من رضاهم ومن هذا المنطلق تم اتخاذ جدارة كأسم وشعار ومنهج لشركتنا.') }}
                                            <hr>
                                            {{ transWord('.شركة جدارة شركة رسمية مسجلة في سجل تجاري سعودي نقوم بخدمة عملائنا على شبكة  الأنترنت منذ عام 2009م  وتأسست رسميا فى العام 2013م') }}
                                            <hr>
                                            {{ transWord('نقدم خدمات تصميم مواقع الإنترنت وبرمجة تطبيقات الويب المختلفة وحلول التسويق الرقمي.') }}
                                        </p>
                                        <a class="btn btn-sm btn-primary" target="_blank" rel="nofollow"
                                            href="https://jaadara.com/">&rarr; {{ transWord('للمزيد من مشاريع جدارة') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Greetings Card ends -->

                        <!-- Statistics Card -->

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <a href="{{ route('admin.contacts.index') }}">
                                                <i class="fas fa-inbox fa-xl text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="card-text mt-1">{{ transWord('رسائل التواصل') }}</p>
                                    <h2 class="font-weight-bolder">{{ getCount('contact') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-success p-50 m-0">
                                        <div class="avatar-content">
                                            <a href="{{ route('admin.tools.index') }}">
                                                <i class="fas fa-network-wired fa-xl text-success"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="card-text mt-1">{{ transWord('أدوات الربط') }}</p>
                                    <h2 class="font-weight-bolder">{{ getCount('connectivityTool') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <a href="{{ route('admin.settings.create') }}">
                                                <i class="fas fa-gear fa-xl text-warning"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="card-text mt-1">{{ transWord('الإعدادات') }}</p>
                                    <h2 class="font-weight-bolder">{{ getCount('setting') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Statistics Card -->
            </div>

            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>

@endsection
