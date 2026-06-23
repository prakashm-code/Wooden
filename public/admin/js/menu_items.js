$(document).ready(function () {

    $("#add_menu_item_form,#edit_menu_item_form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            // tax_percentage: {
            //     number: true,
            //     min: 0,
            //     max: 100
            // },
            // qty: {
            //     required: true,
            //     digits: true,
            //     min: 1
            // }
        },

        messages: {
            name: {
                required: "Please enter item name",
                maxlength: "Name too long"
            },
            price: {
                required: "Please enter item name",
                number: "Enter valid price",
                min: "Price cannot be negative"
            },
            // tax_percentage: {
            //     number: "Enter valid tax %",
            //     min: "Tax cannot be negative",
            //     max: "Tax cannot exceed 100%"
            // },
            // qty: {
            //     required: "Enter quantity",
            //     digits: "Only numbers allowed",
            //     min: "Minimum qty is 1"
            // }
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
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    row.css("background", "#ffe5e5");
                    row.fadeOut(300, function () {
                        $(this).remove();
                    });
                    $('#thali-table').DataTable().ajax.reload(null, false);
                    toastr.success('Menu Delete Successfully')
                },
                error: function () {
                    toastr.error('Menu Not Delete Successfully')

                }
            });
        }
    });
});
