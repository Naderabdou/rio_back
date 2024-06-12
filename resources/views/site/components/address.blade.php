<div class="main-address-order">
    <div class="title-address-order">
        <h2>عنوان 2 </h2>
        <div class="d-flex gap-5">
            <a href="" data-toggle="modal"
                data-target=".address-modal-update-{{ $address->id }}"
                class="ctm-btn2">
                {{ transWord('تعديل') }}</a>

            <a href="{{ route('site.address.destroy',$address->id) }}"
                class="ctm-btn2 detele_address">
                {{ transWord('حذف') }}</a>
        </div>
    </div>
    <ul>
        <li> {{ transWord('المحافظة') }} <span> {{ $address->governorate->name }}
            </span></li>
        <li> {{ transWord('المدينة') }} <span> {{ $address->city->name }} </span></li>
        <li> {{ transWord('العنوان') }} <span> {{ $address->street }}</span></li>
    </ul>
</div>
<div class="modal fade address-modal-update-{{ $address->id }}" tabindex="-1"
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="main-add-address m-auto">
                <div class="img-add-address">
                    <img src="{{ asset('site/images/address.png') }}" alt="">
                </div>
                <div class="title-center mb-5">
                    <h2>{{ transWord('تعديل العنوان') }}</h2>
                </div>
                <form action="{{ route('site.address.update', $address->id) }}"
                    method="POST" class="address_update">
                    @csrf
                    @method('PUT')
                    <div class="input-form arrow-select">
                        <select class="form-select form-control governorate_id"
                            name="governorate_id">
                            <option value=""> {{ transWord('اختر المحافظه') }}
                            </option>
                            @foreach ($governorates as $governorate)
                                <option
                                    {{ $address->governorate_id == $governorate->id ? 'selected' : '' }}
                                    value="{{ $governorate->id }}">
                                    {{ $governorate->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-form arrow-select">
                        <select class="form-select form-control city_id" name="city_id">
                            <option value=""> {{ transWord('اختر المدينه') }}
                            </option>
                            @foreach ($cities as $city)
                                <option
                                    {{ $address->city_id == $city->id ? 'selected' : '' }}
                                    value="{{ $city->id }}">
                                    {{ $city->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-form">
                        <input type="text" name="street"
                            placeholder="{{ transWord('العنوان') }}"
                            class="form-control" value="{{ $address->street }}">
                    </div>

                    <div class="btn-add-address mt-4">
                        <button class="ctm-btn w-100"> {{ transWord('حفظ') }} </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>