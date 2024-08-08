$(document).ready(function () {

    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod("domain", function (value, element) {
        // Allow emails from gmail.com, yahoo.com, hotmail.com, and outlook.com
        return this.optional(element) ||
            /^[\w.-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com)$/.test(value);
    }, window.emailmessage);

    $.validator.addMethod("phone_type", function (value, element) {
        return this.optional(element) || /^[0-9+]+$/.test(value);
    }, window.phoneMessage);
    $.validator.addMethod('string', function (value, element) {
        return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
    }, window.stringMessage);

    $.validator.addMethod("egyptPhone", function (value, element) {
        return this.optional(element) || /^(?:\+2)?01[0-9]{8,9}$/.test(value);
    }, window.egyptPhone);

    $.validator.addMethod("fullname", function (value, element) {
        var words = value.split(' ');
        return this.optional(element) || /^[\u0600-\u06FFa-zA-Z-' ]+$/.test(value) && words
            .length >= 2;
    }, window.fullname);


    $("#MerchantsFormCreate").validate({
        // initialize the plugin

        rules: {
            name: {
                required: true,
                minlength: 2,
                noSpecialChars: true,
                string: true,
                fullname: true,
            },

            email: {
                required: true,
                minlength: 3,
                domain: true,
                remote: {
                    url: window.merchantsEmail,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        email: function () {
                            return $("#email").val();
                        }
                    },
                    dataFilter: function (data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },
            phone: {
                required: true,
                egyptPhone: true,
                phone_type: true,
                minlength: 11,
                maxlength: 12,
                remote: {
                    url: window.merchantsPhone,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phone: function () {
                            return $("#phone").val();
                        }
                    },
                    dataFilter: function (data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },
            password: {
                required: true,
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            messages: {

                phone: {
                    minlength: window.phoneMinLengthMessage,
                    maxlength: window.phoneMaxLengthMessage,
                },
                password_confirmation: {
                    equalTo: window.passwordConfirmMessage
                },




            },




        },


        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });





});
