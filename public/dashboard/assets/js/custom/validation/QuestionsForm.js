$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);

    $("#createQuestionsForm").validate({
        // initialize the plugin



        rules: {

            question_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            question_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

            },

            answer_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,


            },
            answer_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

            },






        },



        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {

            form.submit();
        },
    });

    $("#updateQuestionsForm").validate({
        // initialize the plugin

        rules: {
            question_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,


            },
            question_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

            },

            answer_ar: {
                required: true,
                minlength: 3,
                maxlength: 255,


            },
            answer_en: {
                required: true,
                minlength: 3,
                maxlength: 255,

            },





        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
