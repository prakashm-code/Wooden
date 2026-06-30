$(document).ready(function () {
    $(
        "#add_plywood_form, #edit_plywood_form, #add_door_form ,#edit_door_form, #add_blockboard_form, #edit_blockboard_form"
    ).validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
            price: {
                required: true,
                number: true,
                min: 0,
            },
            market_price: {
                required: true,
                number: true,
                min: 0,
            },
        },

        messages: {
            name: {
                required: "Please enter plywood name",
                maxlength: "Name too long",
            },
            price: {
                required: "Please enter price",
                number: "Please enter a valid price",
                min: "Price should be greater than 0",
            },
            market_price: {
                required: "Please enter market price",
                number: "Please enter a valid market price",
                min: "Market price should be greater than 0",
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

        // ✅ clean up on success
        success: function (label, element) {
            $(element).removeClass("is-invalid");
            label.remove();
        },

        errorPlacement: function (error, element) {
            element.siblings(".invalid-feedback").remove();

            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $(form).find('button[type="submit"]').prop("disabled", true);
            form.submit();
        },
    });
});

$(document).on("click", ".delete-link", function () {
    let link = $(this);
    let url = link.data("url");
    let row = link.closest("tr");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function () {
                    row.css("background", "#ffe5e5");
                    row.fadeOut(300, function () {
                        $(this).remove();
                    });
                    $("#thali-table").DataTable().ajax.reload(null, false);
                    toastr.success("Menu Delete Successfully");
                },
                error: function () {
                    toastr.error("Menu Not Delete Successfully");
                },
            });
        }
    });
});
