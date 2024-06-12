<div class="user-accout">
    <div class="title-user-account">
        <img src="{{ auth()->user()->image != null ? auth()->user()->image_path : asset('site/images/user2.png') }}"
            alt="">
        <h2 id="name_profile"> {{ auth()->user()->name }}</h2>
        <h3 id="email_profile"> {{ auth()->user()->email }} </h3>
    </div>
    <ul>
        <li><a href="{{ route('site.profile') }}" class="{{ isActiveRoute('site.profile') }}"> <img
                    src="{{ asset('site/images/icon/profile.svg') }}" alt="">
                {{ transWord('حسابي') }} </a></li>
        <li><a href="{{ route('site.orders') }}" class="{{ areActiveRoutes(['site.orders','site.orders.show']) }}"> <img src="{{ asset('site/images/icon/task-square.svg') }}"
                    alt="">
                {{ transWord('طلباتي') }}</a></li>
        <li><a href="{{ route('site.address.index') }}" class="{{ isActiveRoute('site.address.index') }}"> <img src="{{ asset('site/images/icon/house.svg') }}"
                    alt=""> {{ transWord('العناوين') }} </a>
        </li>
        <li><a href="myacount.html" data-toggle="modal" data-target=".logout-modal"> <img
                    src="{{ asset('site/images/icon/logout.svg') }}" alt="">
                {{ transWord('تسجيل الخروج') }}
            </a></li>
    </ul>
</div>

<div class="modal fade logout-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="logout-page">
            <div class="img-logout">
                <img src="{{ asset('site/images/logout.png') }}" alt="">
            </div>
            <h2> {{ transWord('هل أنت متأكد من تسجيل الخروج') }}</h2>
            <div class="btn-logout d-flex align-item-center justify-content-center">
                <a href="{{ route('site.logout') }}" class="ctm-btn mx-2">{{ transWord('نعم') }}</a>
                <a href=""  id="btn-close-model" class="ctm-btn2 mx-2">{{ transWord('لا') }}</a>
            </div>
        </div>
    </div>
</div>
</div>
