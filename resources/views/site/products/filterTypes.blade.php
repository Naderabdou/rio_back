<div class="col-lg-4">
    <div class="filter-products">
        <div class="sub-filter-products">
            <div class="title-filter">
                <h2>{{ transWord('كل الاقسام') }}</h2>
            </div>
            <ul class="categories-a-filter ">
                @forelse ($categories as $category)
                    <li>
                        <div class="input-radio">
                            <input type="radio" id="categories-{{ $category->id }}" name="categories"
                                class="filter category_filter" data-category-id="{{ $category->id }}">
                            <label for="categories-{{ $category->id }}">
                                <img src="{{ $category->image_path }}" alt="">
                                {{ $category->name }}
                                <span> ( {{ $category->products_count }} ) </span>
                            </label>
                        </div>
                    </li>
                @empty
                    <li>
                        {{ transWord('لا يوجد اقسام') }}
                    </li>
                @endforelse


            </ul>
        </div>
        <div class="sub-filter-products">
            <div class="title-filter">
                <h2>{{ transWord('مادة التصنيع') }}</h2>
            </div>
            <ul class="check-filter">
                @forelse ($brands as $brand)
                    <li>
                        {{-- input-check --}}
                        {{-- <input type="checkbox" id="check-{{ $brand->id }}" class="filter brand_filter" name="check-product" value="{{ $brand->id }}"> --}}
                        <label> {{ $brand->name }} </label>
                    </li>
                @empty
                    <li>
                        {{ transWord('لا يوجد مواد تصنيع') }}
                    </li>
                @endforelse

            </ul>
        </div>
        <div class="sub-filter-products">
            <div class="title-filter">
                <h2>{{ transWord('السعر') }}</h2>

            </div>
            <div class="range_slider">
                {{-- <input type="text" class="js-range-slider" name="my_range" value="" data-skin="round"
                    data-type="double" data-min="100" data-max="1000" data-grid="false" /> --}}
                {{-- <div class="number_range_slider">

                    <input type="number" maxlength="10" value="10000" class="to filter" name="max_num"
                        id="max_num_filter" />
                    <input type="number" maxlength="10" value="100" class="from filter" name="min_num"
                        id="min_num_filter" />
                </div> --}}

                <div class="inputs-container ">
                    <div class="input"> <input value="10" id="min_num_filter" placeholder="{{ transWord('من') }}" type="number" name='min_num'> </div>
                    <div class="dash"></div>
                    <div class="input"> <input value="100000" id="max_num_filter" placeholder="{{ transWord('الي') }}" type="number" name='max_num'> </div>
                    <p type="submit" class ="filter-button"> تطبيق </p>
                </div>

            </div>
        </div>

    </div>
</div>
