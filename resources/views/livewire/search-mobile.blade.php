<div>
    <div class="search-mune">
        <form action="{{ route('site.products') }}">
            <input wire:model.live.debounce="search" type="text" placeholder="{{ transWord('البحث ..') }} " class="form-control" name="search">
            <button> <img src="{{ asset('site/images/icon/search.svg') }}" alt=""></button>
        </form>
    </div>
    <div class="search-result" style="display:{{ $isSearch ? 'block' : 'none' }}">
        @forelse ($results as  $result)
            <p>
                <a href="{{ route('site.products.show', $result->id) }}">
                    {{ $result->name }}
                </a>

            </p>
        @empty
            <p>
                {{ transWord('لا يوجد نتائج') }}
            </p>
        @endforelse
    </div>
</div>
