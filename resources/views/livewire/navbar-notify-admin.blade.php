<div>
    <li class="nav-item dropdown dropdown-notification mr-25">

        <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"  wire:poll.5000ms="updateCount">
            <i class="fas fa-bell"></i>
            @if ($count > 0)
                <span class="notification-dot">{{ $count }}</span>
            @endif
        </a>
        @if ($count > 0)
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right scrollable-menu">
            <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                    <h4 class="notification-title mb-0 mr-auto">{{ transWord('الإشعارات') }}</h4>
                    {{-- <div class="badge badge-pill badge-light-primary">6 New</div> --}}
                </div>
            </li>

            <livewire:navbar-notify-admin-list :notifications="$notifications" />

            <li class="dropdown-menu-footer">
                <a href="{{ route('admin.notifiy') }}" class="btn btn-primary btn-block" href="javascript:void(0)">
                    {{ transWord('قراءة جميع الإشعارات') }}
                </a>
            </li>
        </ul>
        @else
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right scrollable-menu">
            <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                    <h4 class="notification-title mb-0 mr-auto">{{ transWord('الإشعارات') }}</h4>
                    {{-- <div class="badge badge-pill badge-light-primary">6 New</div> --}}
                </div>
            </li>
            <li class="dropdown-menu-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" href="javascript:void(0)">
                    {{ transWord('لا يوجد إشعارات') }}
                </a>
            </li>
        @endif
    </li>
</div>
