
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);



    $("#createProductsForm").validate({
        // initialize the plugin

        rules: {
            name_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            name_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },


            image: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 3145728
            },
            sub_title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,


            },
            sub_title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            label_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,


            },
            label_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            label_color: {
                required: true,

            },
            has_offer: {
                required: true,


            },
            category_id: {
                required: true,
            },
            brand_id: {
                required: true,
            },
            desc_ar: {
                required: true,
                minlength: 3,

            },
            desc_en: {
                required: true,
                minlength: 3,

            },
            price: {
                required: true,
                number: true,
            },
            discount: {
                // required: true,
                number: true,

            },
            price_after_discount: {
                // required: true,
                number: true,

            },
            stock: {
                required: true,
                number: true,

            },
            'key_ar[]': {
                minlength: 2,
                noSpecialChars: true,


            },
            'key_en[]': {
                minlength: 2,

                noSpecialChars: true,

            },
            'value_ar[]': {

                noSpecialChars: true,
            }
            ,
            'value_en[]': {

                noSpecialChars: true,
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

    $("#updateProductsForm").validate({
        // initialize the plugin

        rules: {
            name_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            name_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },


            image: {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 2097152
            },
            sub_title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,


            },
            sub_title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            label_ar: {
                required: true,
                minlength: 3,


            },
            label_en: {
                required: true,
                minlength: 3,
            },
            label_color: {
                required: true,

            },
            has_offer: {
                required: true,


            },
            category_id: {
                required: true,
            },
            brand_id: {
                required: true,
            },
            desc_ar: {
                required: true,
                minlength: 3,

            },
            desc_en: {
                required: true,
                minlength: 3,

            },
            price: {
                required: true,
                number: true,
            },
            discount: {
                required: true,
                number: true,

            },
            price_after_discount: {
                required: true,
                number: true,

            },
            stock: {
                required: true,
                number: true,

            },
            'key_ar[]': {
                minlength: 2,
                noSpecialChars: true,


            },
            'key_en[]': {
                minlength: 2,
                noSpecialChars: true,

            },
            'value_ar[]': {

                noSpecialChars: true,
            }
            ,
            'value_en[]': {
                noSpecialChars: true,
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
