<div>
    <li class="scrollable-container media-list overflow-hidden" wire:poll.8000ms="refreshWebNotifications">
        @foreach ($notifications as $notification)
            <a class="d-flex" href="javascript:void(0)">
                <div class="media d-flex align-items-start flex-column notify-item">
                    <div class="media-left">
                        {{-- <div class="avatar"><img src="{{ $notification->data['image'] }}" alt="avatar" width="32"
                                height="32"></div> --}}
                    </div>
                    <div class="media-body">
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.notifiy.read', ['id' => $notification->id, 'order_id' => $notification->data['order_id']]) }}">

                                <p class="media-heading">
                                    {{ $notification->data['body'] }}
                                </p>
                            </a>
                            <small
                                class="notification-text">{{ $notification->created_at->format('Y-m-d H:i A') }}</small>
                        @else
                        <a href="{{ route('site.notifiy.web.read', ['id' => $notification->id, 'order_id' => $notification->data['order_id']]) }}">
                            {{-- <h6 class="media-heading">{{ $notification->data['order_number'] }}</h6> --}}
                            <p class="media-heading">
                                {{ $notification->data['body'] }}
                            </p>
                        </a>
                        <small class="notification-text">{{ $notification->created_at->format('Y-m-d H:i A') }}</small>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </li>
</div>
