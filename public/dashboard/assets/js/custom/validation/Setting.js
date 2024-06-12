$(document).ready(function () {
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);
    $("#updateForm").validate({

        // initialize the plugin

        rules: {

            about_image:{
                accept: "image/png, image/jpeg, image/svg+xml",

            },

            icon : {
                accept: "image/png, image/jpeg, image/svg+xml",
            },

            logo: {
                accept: "image/png, image/jpeg, image/svg+xml",
            },
            footer_logo: {
                accept: "image/png, image/jpeg, image/svg+xml",
            },
            favicon: {

                accept: "image/png, image/jpeg, image/svg+xml",
            },
            slider_image:{
                accept: "image/png, image/jpeg, image/svg+xml",
            },
            footer_image:{
                accept: "image/png, image/jpeg, image/svg+xml",

            },
            home_about_image:{
                accept: "image/png, image/jpeg, image/svg+xml",
            },
            home_about_icon:{
                accept: "image/png, image/jpeg, image/svg+xml",
            },
            ceo_photo:{
                accept: "image/png, image/jpeg, image/svg+xml",
            },






        },
        messages: {
            image: {
                accept: window.acceptSetting
            },
            photo: {
                accept: window.acceptSetting
            },
            icon: {
                accept: window.acceptSetting
            },
            about_image: {
                accept: window.acceptSetting
            },
            logo: {
                accept: window.acceptSetting
            },
            footer_logo: {
                accept: window.acceptSetting

            },
            slider_image: {
                accept: window.acceptSetting
            },
            footer_image: {
                accept: window.acceptSetting
            },
            home_about_image: {
                accept: window.acceptSetting
            },
            home_about_icon: {
                accept: window.acceptSetting
            },
            ceo_photo: {
                accept: window.acceptSetting
            },

            favicon: {
                accept: window.acceptSetting
            },
            media: {
                accept: window.acceptSettingVideo
            },
            frame: {
                accept: window.acceptSetting
            },
            link : {

                youtube: window.linkYoutube
            },
            ayah_number : {
                digits:  window.numberC,
                max : window.ayahNumber
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
