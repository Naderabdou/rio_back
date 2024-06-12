
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);

    $("#createCouponsForm").validate({
        // initialize the plugin

        rules: {
            code: {
                required: true,
                minlength: 3,
                maxlength: 5,
                remote: {
                    url: window.coupons,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        code: function () {
                            return $("#code").val();
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
            value: {
                required: true,
                number: true,
                min: 1,

            },

            type : {
                required: true,

            },



        },


        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#UpdateCouponsForm").validate({
        // initialize the plugin

        rules: {
            code: {
                required: true,
                minlength: 3,
                maxlength: 5,
                remote: {
                    url: window.coupons,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        code: function () {
                            return $("#code").val();
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
            value: {
                required: true,
                number: true,
                min: 1,

            },

            type : {
                required: true,

            },



        },


        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
