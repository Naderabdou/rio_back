$(document).ready(function () {
    $("#excelForm").validate({
        // initialize the plugin

        rules: {
            file: {
                required: true,
                extension: "csv|xlsx"
            }
        },

        messages: {
            file: {
                extension: "هذا الملف غير مدعوم"
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
