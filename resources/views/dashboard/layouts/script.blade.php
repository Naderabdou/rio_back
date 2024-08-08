<!-- BEGIN: Vendor JS-->
<script src="{{ asset('dashboard/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('dashboard/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('dashboard/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script>
    @php
        $messages = [
            'avatarMessage' => transWord('The image must be png, jpg, jpeg,svg'),
            'iconMessage' => transWord('يجب ان يكون الايقونه من نوع png, jpg, jpeg,svg'),
            'phoneMessage' => transWord('The phone must be numbers'),
            'emailmessage' => transWord('الرجاء ادخال الايميل من نطاق (gmail, yahoo, hotmail, outlook)'),
            'acceptMessage' => transWord('يجب ان يكون الصوره او الايقونه من نوع png, jpg, jpeg,svg'),
            'acceptMessageVideo' => transWord('The type must be mp4'),
            'linkYoutube' => transWord('The video link must be allowed from youtube'),
            'facebookMessage' => transWord('The link must be from facebook'),
            'twitterMessage' => transWord('The link must be from twitter'),
            'linkedinMessage' => transWord('The link must be from linkedin'),
            'githubMessage' => transWord('The link must be from github'),
            'passwordConfirmationMessage' => transWord('The password and confirmation password do not match'),
            'phoneMinLengthMessage' => transWord('The phone must be at least 10 numbers'),
            'phoneMaxLengthMessage' => transWord('The phone must be at most 14 numbers'),
            'youtube' => transWord('Please enter a valid YouTube URL'),
            'vimeo' => transWord('Please enter a valid Vimeo URL'),
            'videoMessage' => transWord('The video must be mp4'),
            'noSpecialChars' => transWord('The field must not contain special characters'),
            'acceptMessagePdf' => transWord('يجب ان يكون الملف من نوع pdf'),
            'acceptSetting' => transWord('يجب ان يكون الصوره او الايقونه من نوع png, jpg, jpeg,svg'),
            'filesize' => transWord('يجب ان يكون حجم الصوره او الفيديو اقل او يساوي 1 ميجا'),
            'discountPrice' => transWord('يجب ان يكون السعر بعد الخصم اقل من السعر الاساسي او يساويه'),
            'price_after' => transWord('حقل السعر بعد الخصم مطلوب'),
            'required' => transWord('هذا الحقل مطلوب'),
            'fullname' => transWord('يجب ادخال الاسم الثلاثي'),
            'passwordConfirmationMessage' => transWord('The password and confirmation password do not match'),
            'phoneMaxLengthMessage' => transWord('The phone must be at most 11 numbers'),
            'stringMessage' => transWord('يجب ان يحتوي علي حروف فقط'),
            'passwordConfirmMessage' => transWord('The password and confirmation password do not match'),
            'fullname' => transWord('يجب ادخال الاسم الثلاثي'),
            'egyptPhone'=> transWord('Please specify a valid Egyptian phone number and start with 010 , 012 , 011 , 015'),
            'videoMessage' => transWord('The video must be mp4'),

        ];
    @endphp

    @foreach ($messages as $key => $message)
        window.{{ $key }} = "{{ $message }}";
    @endforeach
</script>

{{-- <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}

<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('dashboard/app-assets/js/scripts/pages/page-auth-login.js') }}"></script>
<!-- END: Page JS-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (app()->getLocale() == 'ar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
@else
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
@endif



</script>

<script>
    var locale = '{!! config('app.locale') !!}';


    $('.table').DataTable({
        "language": {
            "url": locale == 'ar' ? "https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json" :
                "https://cdn.datatables.net/plug-ins/1.11.5/i18n/en-GB.json"
        },
    });
</script>






<!-- ====================================== save token firebase ========================================== -->
{{-- <script src="https://www.gstatic.com/firebasejs/10.12.3/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/10.12.3/firebase-analytics.js"></script> --}}

{{-- <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>



<script>
    var firebaseConfig = {
        apiKey: "AIzaSyDaj8Jx5Dx1JoqPSEM8K1sMbQu2XP6T0j0",
        authDomain: "zadapp-8a43d.firebaseapp.com",
        projectId: "zadapp-8a43d",
        storageBucket: "zadapp-8a43d.appspot.com",
        messagingSenderId: "700480979872",
        appId: "1:700480979872:web:3175d97d2b1851cb579ac5",
        measurementId: "G-W7S6TM1RYL"
    };
    firebase.initializeApp(firebaseConfig);


    // var db = firebase.firestore();

    const messaging = firebase.messaging();

    @if (Auth::check())
        startFCM();
    @endif

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.store.token') }}",
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        //    alert('Token stored.');
                    },
                    error: function(error) {
                        //    alert(error);
                    },
                });
            }).catch(function(error) {
                alert(error);
            });
    }

    messaging.onMessage(function(payload) {

        // console.log("Message received. ");
        console.log(payload);
        // append notification

        // // canceled-orders
        // if (payload.data.status == 'cancel_request') {
        //     var html = '<li><a href="' + window.location.origin + '/dashboard/canceled-orders' + '">' +
        //         payload.notification.body +
        //         '</a></li>';
        // } else {
        //     var html = '<li><a href="' + window.location.origin + '/dashboard/orders' + '">' +
        //         payload.notification.body +
        //         '</a></li>';
        // }



        // $('.no-notify').text('');
        // $('.notification-list').append(html);

        // const title = payload.notification.title;
        // const options = {
        //     body: payload.notification.body,
        //     // icon: payload.notification.icon,
        // };


        // if (Notification.permission === 'granted') {
        //     navigator.serviceWorker.ready.then(function(registration) {
        //         registration.showNotification(title, options);
        //     });
        // }

    });
</script> --}}


@stack('js')

@if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
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
            title: "{{ session()->get('success') }}"
        })
    </script>
@endif

@if (session()->has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: "{{ session()->get('error') }}"
        })
    </script>
@endif

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.preview-formFile').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#formFile").change(function() {
            readURL(this);
        });
    });
</script>


@livewireScripts
