@extends('dashboard.layouts.app')

@section('title', transWord('اضافة صور المنتج'))
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.products.index') }}">{{ transWord('المنتجات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('اضافة صور المنتج') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ transWord('اضافة صور المنتج') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.products_images.store') }}" method="POST"
                                        class="dropzone" id="dropzone" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="col-12">

                                        </div>

                                    </form>

                                    <a href="{{ route('admin.products.index') }}">
                                        <button type="submit" value="{{ transWord('حفظ') }}" class="btn btn-primary mt-2">
                                            {{ transWord('حفظ') }}g</button>
                                    </a>




                                    <table class="datatables-basic table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ transWord('الصورة') }}</th>
                                                <th>{{ __('models.actions') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody id='tbody'>
                                            @foreach ($product->images as $key => $image)
                                                <tr>
                                                    {{-- @dd($product->key) --}}
                                                    <td>{{ $product?->key }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage') . '/' . $image->image }}"
                                                            width="100px" height="100px">
                                                    </td>
                                                    <td class="text-center">

                                                        <form
                                                            action="{{ route('admin.products.images.delete', $image->id) }} "
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        <script src="{{ asset('dashboard/assets/js/custom/validation/scrapForm.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>

        <script src="https://cdn.tiny.cloud/1/ncu4y607nayo1coo3vekski4tweqhf55lrvzpu0mnmnsstgw/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>

        <script>
            var responses = {}; // Object to store the responses
            var fileCount = "{{ count($product->images) }}";
            var message = "{{ transWord('عدد الصور المرفوعة :') }}"


            function randomId() {
                return Math.floor(Math.random() * 1000); // Returns a random number between 0 and 999
            }
            Dropzone.options.dropzone = {
                dictDefaultMessage: "{{ transWord('اضغط هنا او اسحب الصور هنا') }}",
                dictRemoveFile: "{{ transWord('حذف الصوره') }}",
                dictCancelUpload: "{{ transWord('الغاء الرفع') }}",
                dictCancelUploadConfirmation: "{{ transWord('هل انت متاكد من الغاء الرفع') }}",
                dictMaxFilesExceeded: "{{ transWord('لا يمكنك رفع المزيد من الصور') }}",
                dictFileTooBig: "{{ transWord('الملف كبير جدا') }}",
                dictInvalidFileType: "{{ transWord('برجاء رفع صور من نوع jpeg , jpg , png') }}",
                dictResponseError: "{{ transWord('حدث خطأ اثناء الرفع') }}",

                maxFilesize: 50,
                acceptedFiles: ".jpeg,.jpg,.png",
                success: function(file, response) {
                    console.log(file.upload.uuid);

                    $('#images_table').css('display', 'block');

                    $('.dataTables_empty').hide();
                    fileCount++;

                    // Update the text of the element
                    $('#DataTables_Table_0_info').text(message + fileCount);

                    responses[file.name] = response.data;
                    responses[file.upload.uuid] = randomId();

                    var deleteUrl = "{{ route('admin.products.images.delete', 'id') }}".replace('id', response.id);


                    var tr = document.createElement('tr');
                    tr.id = 'image_' + responses[file.upload.uuid];
                    tr.innerHTML = `
                        <td></td>
                        <td>
                            <img src="{{ asset('storage') }}/${responses[file.name]}" width="100px" height="100px">
                        </td>
                        <td class="text-center">
                            <form action="${deleteUrl}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    `;
                    document.querySelector('.datatables-basic tbody').appendChild(tr);




                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-start',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: "تم اضافة الصورة بنجاح"
                    })


                },
                addRemoveLinks: true,
                removedfile: function(file) {
                    var name = responses[file.name];

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ route('admin.products.images.file') }}',
                        data: {
                            filename: name
                        },

                        success: function(data) {

                            $('.dataTables_empty').hide();
                            fileCount--;
                            $('#DataTables_Table_0_info').text(message + fileCount);


                            $('#image_' + responses[file.upload.uuid]).remove();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-start',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "تم الحذف الصورة بنجاح"
                            })



                        },

                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) :
                        void 0;
                },
                timeout: 900000,

            };
        </script>
    @endpush
@endsection
