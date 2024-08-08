
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);
    $.validator.addMethod("discountedPrice", function (value, element) {
        var discount = $("#discount").val();
        return discount ? value !== '' : true;
    }, window.price_after);
    $.validator.addMethod("discountedPriceComp", function (value, element, params) {

        var priceValue = $('#price').val();

        var discountPrice = Number(value);

        return discountPrice <= Number(priceValue);
    }, window.discountPrice);



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
                discountedPrice: true,
                discountedPriceComp: {

                    originalPrice: $('#price').val()
                }





            },
            list_price: {
                required: true,
                number: true,
            },

            code_product: {
                required: true,
                minlength: 3,
                maxlength: 6,
                remote: {
                    url: window.urlCode,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        code_product: function () {
                            return $("#code_product").val();
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
            dimensions_product: {
                required: true,
                minlength: 3,

            },
            dimensions_carton: {
                required: true,
                minlength: 3,

            },
            num_carton: {
                required: true,
                number: true,

            },
            size_carton: {
                required: true,

            },
            weight_carton: {
                required: true,

            },
            'color[]': {
                required: true,


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
            list_price: {
                required: true,
                number: true,
            },
            discount: {
                number: true,

            },
            price_after_discount: {
                number: true,
                discountedPrice: true,
                discountedPriceComp: {
                    originalPrice: $('#price').val()
                }

            },
            code_product: {
                required: true,
                minlength: 3,
                maxlength: 6,
                remote: {
                    url: window.urlCode,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        code_product: function () {
                            return $("#code_product").val();
                        },
                        id: function () {
                            return $("#id").val(); // assuming the ID of the record is stored in a field with the ID "id"
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
            dimensions_product: {
                required: true,
                minlength: 3,

            },
            dimensions_carton: {
                required: true,
                minlength: 3,

            },
            num_carton: {
                required: true,
                number: true,

            },
            size_carton: {
                required: true,

            },
            weight_carton: {
                required: true,

            },
            'color[]': {
                required: true,


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
