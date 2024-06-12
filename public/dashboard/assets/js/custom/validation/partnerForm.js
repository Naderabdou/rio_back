$(document).ready(function () {
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);
    $("#createPartnerForm").validate({
        // initialize the plugin

        rules: {

            link: {
                // required: true,
                url: true
            },
            image: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            },
        },

        messages: {
            image: {
                accept : window.avatarMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#updateForm").validate({
        // initialize the plugin

        rules: {

            link: {
                // required: true,
                url: true
            },
            image: {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576


            },
        },

        messages: {
            image: {
                accept : window.avatarMessage
            }

        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
