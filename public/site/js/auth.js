$(document).ready(function () {
    $(document).on('submit', '#register_store', function (e) {
        e.preventDefault();
        $('#reg_btn').prop('disabled', true);
        // Hide the button
        $('#reg_btn').hide();

        // Add a spinner
        $('#reg_btn').parent().append(
            `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
               `
        );

        var formData = new FormData($('#register_store')[0]);

        console.log('test');
        var url = this.action;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#register_store')[0].reset();

                $('.error-message').text('')
                Swal.fire({
                    icon: 'success',
                    title: `<h5> ${data.message}</h5> `,
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#reg_btn').prop('disabled', false);


                // Show the button
                $('#reg_btn').show();

                // Remove the spinner
                $('#reg_btn').next('.spinner-border').remove();

                // ajax reload
                setTimeout(function () {
                    location.reload();
                }, 1500);



            },
            error: function (data) {
                $('.error-message').text('');
                // Display validation errors under each input
                var errors = data.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = messages.join(', ');
                    //  console.log('#' + field + '_error');
                    $('#' + field + '_error').text(errorMessage);

                });

                $('#reg_btn').prop('disabled', false);


                // Show the button
                $('#reg_btn').show();

                // Remove the spinner
                $('#reg_btn').next('.spinner-border').remove();
            },

        });
    })


    $(document).on('submit', '#storeLogin', function (e) {
        e.preventDefault();
        $('#btn_login').prop('disabled', true);
        // Hide the button
        $('#btn_login').hide();
        $('#forget_pass').hide();

        // Add a spinner
        $('#btn_login').parent().append(
            `<div class="spinner-border spinner_login text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
               `
        );

        var formData = new FormData($('#storeLogin')[0]);

        console.log('test');
        var url = this.action;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data, 'data');
                $('#storeLogin')[0].reset();

                $('.error-message').text('')
                Swal.fire({
                    icon: 'success',
                    title: `<h5> ${data.message}</h5> `,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#forget_pass').show();

                $('#btn_login').prop('disabled', false);


                // Show the button
                $('#btn_login').show();

                // Remove the spinner
                $('.spinner_login').remove();


                // ajax reload
                setTimeout(function () {
                    location.reload();
                }, 1500);



            },
            error: function (data) {
                var text = data.responseJSON.message;
                $('.error-message').text('');
                $('#emailOrPhone_error').text(text);

                // Display validation errors under each input
                var errors = data.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = messages.join(', ');
                    //  console.log('#' + field + '_error');
                    $('#' + field + '_error').text(errorMessage);

                });

                $('#btn_login').prop('disabled', false);


                // Show the button
                $('#btn_login').show();
                $('#forget_pass').show();

                // Remove the spinner
                $('.spinner_login').remove();
            },

        });
    })

    $(document).on('submit', '#form_forget', function (e) {
        e.preventDefault();
        $('#btn_forget').prop('disabled', true);
        // Hide the button
        $('#btn_forget').hide();

        // Add a spinner
        $('#btn_forget').parent().append(
            `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
               `
        );





        var formData = new FormData($('#form_forget')[0]);


        var url = this.action;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data, 'data');
                // var html = $('#email_code').html();
                // var newHtml = html.replace('AHMED24@GMAIL.COM', data.email);
                // $('#email_code').html(newHtml);
                $('#email_code').html(function (_, html) {
                    return html.replace('AHMED24@GMAIL.COM', data.email);
                });
                $('#email_check').val(data.email);


                $('.forget-password-modal').modal('hide');
                $('.code-modal').modal('show');

                $('#btn_forget').prop('disabled', false);


                // Show the button
                $('#btn_forget').show();

                // Remove the spinner
                $('#btn_forget').next('.spinner-border').remove();





            },
            error: function (data) {
                var text = data.responseJSON.message;
                $('.error-message').text('');

                var errors = data.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = messages.join(', ');
                    //  console.log('#' + field + '_error');
                    $('.' + field + '_error').text(errorMessage);

                });
                $('#btn_forget').prop('disabled', false);


                // Show the button
                $('#btn_forget').show();

                // Remove the spinner
                $('#btn_forget').next('.spinner-border').remove();


            },

        });
    })

    $(document).on('submit', '#form_checkCode', function (e) {
        e.preventDefault();
        $('.resend-massage').hide();
        $('.btn_checkCode').prop('disabled', true);
        // Hide the button
        $('.btn_checkCode').hide();

        // Add a spinner
        $('.btn_checkCode').parent().append(
            `<div class="spinner-border  text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
               `
        );





        var formData = new FormData($('#form_checkCode')[0]);


        var url = this.action;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#email_update').val(data.email);
                $('.resend-massage').show();
                // console.log(data, 'data');
                // // var html = $('#email_code').html();
                // // var newHtml = html.replace('AHMED24@GMAIL.COM', data.email);
                // // $('#email_code').html(newHtml);
                // $('#email_code').html(function (_, html) {
                //     return html.replace('AHMED24@GMAIL.COM', data.email);
                // });

                $('#form_checkCode')[0].reset();

                $('.comfirm-password-modal').modal('show');
                $('.code-modal').modal('hide');

                $('.btn_checkCode').prop('disabled', false);


                // Show the button
                $('.btn_checkCode').show();

                // Remove the spinner
                $('.spinner-border').remove();





            },
            error: function (data) {
                var text = data.responseJSON.message;


                $('.resend-massage').show();

                $('.error-message').text('');
                $('.code_error').text(text);
                $('.btn_checkCode').prop('disabled', false);


                // Show the button
                $('.btn_checkCode').show();

                // Remove the spinner
                $('.spinner-border').remove();
                // Display validation errors under each input
                var errors = data.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = messages.join(', ');
                    //  console.log('#' + field + '_error');
                    $('.' + field + '_error').text(errorMessage);

                });




            },

        });
    })

    $(document).on('click', '#resend_code', function (e) {
        e.preventDefault();
        $('.resend-massage').hide();
        $('.btn_checkCode').prop('disabled', true);
        // Hide the button
        $('.btn_checkCode').hide();

        // Add a spinner
        $('.btn_checkCode').parent().append(
            `<div class="spinner-border  text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
               `
        );
        var email = $('#email_check').val();
        var url = $(this).attr('href') + '/' + email;

        $.ajax({
            url: url,
            type: "GET",

            contentType: false,
            processData: false,
            success: function (data) {
                $('.resend-massage').show();
                $('.btn_checkCode').prop('disabled', false);
                $('.btn_checkCode').show();

                // Remove the spinner


                Swal.fire({
                    icon: 'success',
                    title: `<h5> ${data.message}</h5> `,
                    showConfirmButton: false,
                    timer: 1500
                });

                $('.spinner-border').remove();


            },
            error: function (data) {
                var text = data.responseJSON.message;


                $('.resend-massage').show();

                $('.error-message').text('');
                $('.code_error').text(text);
                $('.btn_checkCode').prop('disabled', false);


                // Show the button
                $('.btn_checkCode').show();

                // Remove the spinner
                $('.spinner-border').remove();
                // Display validation errors under each input
                var errors = data.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = messages.join(', ');
                    //  console.log('#' + field + '_error');
                    $('.' + field + '_error').text(errorMessage);

                });




            },

        });



    });


    $(document).on('submit', '#form_update_password', function (e) {
        e.preventDefault();
        $('#btn_password').prop('disabled', true);
        // Hide the button
        $('#btn_password').hide();

        // Add a spinner
        $('#btn_password').parent().append(
            `<div class="spinner-border  text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
               `
        );





        var formData = new FormData($('#form_update_password')[0]);


        var url = this.action;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data, 'data');


                $('#form_update_password')[0].reset();



                $('#btn_password').prop('disabled', false);


                // Show the button
                $('#btn_password').show();

                // Remove the spinner
                $('#btn_password').next('.spinner-border').remove();
                Swal.fire({
                    icon: 'success',
                    title: `<h5> ${data.message}</h5> `,
                    showConfirmButton: false,
                    timer: 1500
                });

                $('.comfirm-password-modal').modal('hide');
                $('.error-message').text('');




            },
            error: function (data) {
                var text = data.responseJSON.message;



                $('.error-message').text('');
                $('#btn_password').prop('disabled', false);


                // Show the button
                $('#btn_password').show();

                // Remove the spinner
                $('.spinner-border').remove();
                // Display validation errors under each input
                var errors = data.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = messages.join(', ');
                    //  console.log('#' + field + '_error');
                    $('.' + field + '_error').text(errorMessage);

                });




            },

        });
    })

    var lang = 'ar';

    if (lang == 'ar') {
        var message = 'يجب عليك التسجيل لاستخدام هذه الميرة';
        var message_sure = 'هل تريد التسجبل ؟';
        var yes = 'نعم';
        var no = 'لا';
        var message_close = 'تم الالغاء بنجاح';
        var paynow = 'اشتري الان';
    } else {

        var message = 'You must register to use this feature';
        var message_sure = 'Do you want to register ?';
        var yes = 'Yes';
        var no = 'No';
        var message_close = 'Canceled successfully';
        var paynow = 'Pay Now';
    }

    $(document).on('click', '.auth_login', function (e) {
        e.preventDefault();
        Swal.fire({
            title: message_sure,
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: yes,
            cancelButtonText: no
        }).then((result) => {
            if (result.isConfirmed) {

                $('.login-modal').modal('show');

            } else {

            }
        })

    });

   
});
