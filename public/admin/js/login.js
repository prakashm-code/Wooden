$(document).ready(function () {

    $("#formAuthentication").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },

        },

        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email"
            },
            password: {
                required: "Please enter your password",
            },

        },

        errorElement: "div",
        errorClass: "invalid-feedback",

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        errorPlacement: function (error, element) {
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#reset_password_link").validate({
        rules: {
            email: {
                required: true,
                email: true
            },


        },

        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email"
            },


        },

        errorElement: "div",
        errorClass: "invalid-feedback",

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        errorPlacement: function (error, element) {
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    // alert();

    $('#change_pwd_form').validate({
        rules: {
            password: {
                required: true,
            },
            // new_password: {
            //     required: true,
            // },
            c_password: {
                required: true,
                equalTo: "#password"
            },
        },
        messages: {
            password: {
                required: "Please enter your password",
            },
            // new_password: {
            //     required: "Please enter your new password",
            // },
            c_password: {
                required: "Please enter your confirm password",
                equalTo: "Password and confirm password not match"
            },
        },
        errorElement: "div",
        errorClass: "invalid-feedback",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function (error, element) {
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })

});
