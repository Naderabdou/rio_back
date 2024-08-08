<div class="">
    <li class="nav-item dropdown dropdown-notification mr-25">

        <a class="nav-link"  data-toggle="dropdown"   wire:poll.5000ms="updateWebCount">
            {{-- <i class="fas fa-bell"></i> --}}
            <img src="{{ asset('site/images/notification.png') }}" width="20px" alt="" >
            @if ($count > 0)
                <span class="notification-dot">{{$count}}</span>
            @endif
        </a>
        @if ($count > 0)
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right scrollable-menu app-notify">
            <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                    <h4 class="notification-title mb-0  mr-auto">{{ transWord('الإشعارات') }}</h4>
                    {{-- <div class="badge badge-pill badge-light-primary">6 New</div> --}}
                </div>
            </li>

            <livewire:navbar-notify-list-web :notifications="$notifications" />

            <li class="dropdown-menu-footer all-notify-read">
                <a href="{{ route('site.notifiy.web') }}" class="btn btn-primary btn-block" >
                    {{ transWord('قراءة جميع الإشعارات') }}
                </a>
            </li>
        </ul>
        @else
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right scrollable-menu app-notify">
            <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                    <h4 class="notification-title mb-0 mr-auto">{{ transWord('الإشعارات') }}</h4>
                    {{-- <div class="badge badge-pill badge-light-primary">6 New</div> --}}
                </div>
            </li>
            <li class="dropdown-menu-footer all-notify-read">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" >
                    {{ transWord('لا يوجد إشعارات') }}
                </a>
            </li>
        @endif
    </li>
</div>
