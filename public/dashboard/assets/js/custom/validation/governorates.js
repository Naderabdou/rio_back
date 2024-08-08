$("#governorates_update").validate({
    // initialize the plugin

    rules: {
        name_ar: {
            required: true,
            minlength: 3,
            maxlength: 255,


        },
        name_en: {
            required: true,
            minlength: 3,
            maxlength: 255,

        },
        tax : {
            required: true,
            number: true,
        },

    },


    errorElement: "span",
    errorLabelContainer: ".errorTxt",

    submitHandler: function (form) {
        form.submit();
    },
});
