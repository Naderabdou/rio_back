
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);

    $("#createOurPathsForm").validate({
        // initialize the plugin

        rules: {
            name_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlPath,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name_en: function() {
                            return $( "#name_en" ).val();
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },
            name_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlPath,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name_ar: function() {
                            return $( "#name_ar" ).val();
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
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
            image :  {
              required: true,
              accept: "image/png, image/jpeg, image/svg+xml",
              filesize: 1048576
             }
        },
        messages : {
            image : {
                accept : window.iconMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#UpdateOurPathsForm").validate({
        // initialize the plugin

        rules: {
            name_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlPath,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        name_en: function() {
                            return $( "#name_en" ).val();
                        },
                        id: function() {
                            return $( "#id" ).val(); // assuming the ID of the record is stored in a field with the ID "id"
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },
            name_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: window.UrlPath,
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        name_ar: function() {
                            return $( "#name_ar" ).val();
                        },
                        id: function() {
                            return $( "#id" ).val(); // assuming the ID of the record is stored in a field with the ID "id"
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
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
            image :  {
              accept: "image/png, image/jpeg, image/svg+xml",
              filesize: 1048576
             }
        },
        messages : {
            image : {
                accept : window.iconMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
