
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);

    $("#createSliderForm").validate({
        // initialize the plugin

        rules: {

            image: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576,
                
            },


        },
        messages: {
            image: {
                accept: window.iconMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#UpdateSliderForm").validate({
        // initialize the plugin

        rules: {

            icon: {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576

            },

        },
        messages: {
            icon: {
                accept: window.iconMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
