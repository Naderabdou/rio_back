
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
                noSpecialChars: true,
                remote: {
                    url: window.UrlValue,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title_en: function () {
                            return $("#title_en").val();
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
            title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlValue,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title_ar: function () {
                            return $("#title_ar").val();
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
            icon: {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
            },

            desc_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            desc_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true

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

    $("#UpdateOurValuesForm").validate({
        // initialize the plugin

        rules: {
            title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlValue,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        title_en: function () {
                            return $("#title_en").val();
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
            title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlValue,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        title_ar: function () {
                            return $("#title_ar").val();
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
            icon: {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576

            },
            desc_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            desc_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true

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
