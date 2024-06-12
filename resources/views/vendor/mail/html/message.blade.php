<x-mail::layout>
{{-- Header --}}
<x-slot:header>
    <x-mail::header url="{{ route('site.home') }}">

    </x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
    {{ __('كل الحقوق محفوظة') }} {{ getSetting('name_website', app()->getLocale()) }} &copy;
                {{ date('Y') }}
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
