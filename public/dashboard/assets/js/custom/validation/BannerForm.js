
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);


    $("#createBannersForm").validate({
        // initialize the plugin

        rules: {
            title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            sub_title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            sub_title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            color_title: {
                required : true,
            },
            color_btn :{
                required : true,
            },
            color_ground :{
                required : true,

            },
            image: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            }


        },


        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#UpdateBannersForm").validate({
        // initialize the plugin

        rules: {
            title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            sub_title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            sub_title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            color_title: {
                required : true,
            },
            color_btn :{
                required : true,
            },
            color_ground :{
                required : true,

            },
            image: {

                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            }


        },
        messages: {
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
