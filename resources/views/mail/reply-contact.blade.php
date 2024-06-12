<x-mail::message>
    <div style="text-align: center;">
        <a target="__blank" href="{{ route('site.home') }}">
            <img src="{{ asset('site/images/logo.png') }}" alt="Logo" style="width: 100px; height: 100px;">
        </a>
    </div>
    <h1 style="text-align: center;">الرد من خلال موقع {{ getSetting('name_website_ar') }}</h1>
    <x-mail::panel>
        <p style="font-size: 16px; color: #333;">{{ $data }}</p>
    </x-mail::panel>
</x-mail::message>


