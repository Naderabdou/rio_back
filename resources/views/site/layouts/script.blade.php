<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('site/js/anime.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/lightgallery.min.js') }}"></script>
<script src="https://kit.fontawesome.com/392319d0e8.js" crossorigin="anonymous"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('site/js/auth.js') }}"></script>
@if (app()->getLocale() == 'ar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
@else
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
@endif
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
    @php
        $messages = [
            'avatarMessage' => transWord('The image must be png, jpg, jpeg,svg'),
            'backgroundMessage' => transWord('The background must be png, jpg, jpeg,svg'),
            'phoneMessage' => transWord('The phone must be numbers'),
            'emailmessage' => transWord('الرجاء ادخال الايميل من نطاق (gmail, yahoo, hotmail, outlook)'),
            'acceptMessage' => transWord('The type must be png, jpg, jpeg'),
            'acceptMessageVideo' => transWord('The type must be mp4'),

            'passwordConfirmationMessage' => transWord('The password and confirmation password do not match'),
            'phoneMinLengthMessage' => transWord('The phone must be at least 10 numbers'),
            'phoneMaxLengthMessage' => transWord('The phone must be at most 14 numbers'),
            'stringMessage' => transWord('يجب ان يحتوي علي حروف فقط'),
        ];
    @endphp

    @foreach ($messages as $key => $message)
        window.{{ $key }} = "{{ $message }}";
    @endforeach
</script>
<script>
    $(document).ready(function() {
        $('#btn-close-model').on('click', function(e) {
            e.preventDefault();
            $('.logout-modal').modal('hide');
        });
        $.validator.addMethod("noSpecialChars", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
        }, window.noSpecialChars);
        $.validator.addMethod("domain", function(value, element) {
            // Allow emails from gmail.com, yahoo.com, hotmail.com, and outlook.com
            return this.optional(element) ||
                /^[\w.-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com)$/.test(value);
        }, window.emailmessage);

        $.validator.addMethod("phone_type", function(value, element) {
            return this.optional(element) || /^[0-9+]+$/.test(value);
        }, window.phoneMessage);
        $.validator.addMethod('string', function(value, element) {
            return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
        }, window.stringMessage);



        $.validator.addMethod("fullname", function(value, element) {
            var words = value.split(' ');
            return this.optional(element) || /^[\u0600-\u06FFa-zA-Z-' ]+$/.test(value) && words
                .length >= 4;
        }, window.fullname);


        $("#contact_form").validate({


            rules: {
                // Define validation rules for your form fields here
                name: {
                    required: true,
                    minlength: 2,
                    noSpecialChars: true,
                    string: true
                },

                email: {
                    required: true,
                    minlength: 3,
                    domain: true
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 15,
                    phone_type: true,
                },
                message: {
                    required: true,
                    minlength: 3,

                },
                subject: {
                    required: true,
                    minlength: 3,

                },

                // Add more fields as needed
            },

            messages: {

                phone: {
                    minlength: window.phoneMinLengthMessage,
                    maxlength: window.phoneMaxLengthMessage,
                }



            },



            errorElement: "span",
            errorLabelContainer: ".errorTxt",


            submitHandler: function(form) {
                $('.ctm-btn').prop('disabled', true);
                // Hide the button
                $('.ctm-btn').hide();

                // Add a spinner
                $('.ctm-btn').parent().append(
                    `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
                </div>
                       `
                );


                var formData = new FormData(form);
                let url = form.action;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        form.reset();
                        Swal.fire({
                            icon: 'success',
                            title: `<h5> ${data.success}</h5> `,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('.ctm-btn').prop('disabled', false);


                        // Show the button
                        $('.ctm-btn').show();

                        // Remove the spinner
                        $('.ctm-btn').next('.spinner-border').remove();

                    },
                    error: function(data) {
                        $('.ctm-btn').prop('disabled', false);

                        // Show the button
                        $('.ctm-btn').show();

                        // Remove the spinner
                        $('.ctm-btn').next('.spinner-border').remove();
                        $('.error-message').text('');
                        var errors = data.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            var errorMessage = messages.join(', ');
                            $('#' + field + '_error').text(
                                errorMessage);
                        });
                    },
                });

            },
        });



    })
</script>

@stack('js')

<script src="{{ asset('site/js/otp.js') }}"></script>
<script src="{{ asset('site/js/custom.js') }}"></script>
