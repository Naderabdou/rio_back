<div>
    <li class="scrollable-container media-list overflow-hidden" wire:poll.5000ms="refreshNotifications">
        @foreach ($notifications as $notification)
            <a class="d-flex" href="javascript:void(0)">
                <div class="media d-flex align-items-start">
                    <div class="media-left">
                        {{-- <div class="avatar"><img src="{{ $notification->data['image'] }}" alt="avatar" width="32"
                                height="32"></div> --}}
                    </div>
                    <div class="media-body">
                        @if ($notification->data['type_order']== 'user')
                        <a href="{{ route('admin.notifiy.read', ['id' => $notification->id, 'order_id' => $notification->data['order_id']]) }}">

                            <p class="media-heading">
                                {{ $notification->data['body'] }}
                            </p>
                        </a>
                        @else
                        <a href="{{ route('admin.notifiy.read', ['id' => $notification->id, 'order_id' => $notification->data['order_id']]) }}">

                            <p class="media-heading">
                                {{ $notification->data['body'] }}
                            </p>
                        </a>
                        @endif
                        <small class="notification-text">{{ $notification->created_at->format('Y-m-d H:i A') }}</small>
                    </div>
                </div>
            </a>
        @endforeach
    </li>
</div>
