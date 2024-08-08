
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);

    $("#createOurValuesForm").validate({
        // initialize the plugin

        rules: {
            title_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true,

            },
            title_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true,

            },
            icon: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            },

            image: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            },

            desc_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true

            },
            desc_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true

            },
            product_id: {
                required: true
            }
        },
        messages: {
            icon: {
                accept: window.iconMessage
            },
            image: {
                accept: window.avatarMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#UpdateOurValuesForm").validate({
        // initialize the plugin

        rules: {
            title_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true,

            },
            title_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true,

            },
            icon: {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576

            },
            image: {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            },

            desc_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true

            },
            desc_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

                noSpecialChars: true

            },
            product_id: {
                required: true
            }

        },
        messages: {
            icon: {
                accept: window.iconMessage
            },
            image: {
                accept: window.avatarMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
