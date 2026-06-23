$(document).ready(function () {
    $("#add_payment_form,#edit_payment_form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
        },

        messages: {
            name: {
                required: "Please enter payment name",
                maxlength: "Name too long",
            },
        },
    });

    $(document).on("click", ".delete-payment", function (e) {
        e.preventDefault();
        let url = $(this).data("url");
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
                    success: function (data) {
                        if (data.status == "1") {
                            // Swal.fire({
                            //     title: 'Deleted!',
                            //     text: name + ' has been deleted.',
                            //     icon: 'success',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // })
                            $("#payment-method-table")
                                .DataTable()
                                .ajax.reload(null, false);
                            toastr.success("Tax Delete Successfully");
                        }
                    },
                });
            }
        });
    });

    $(document).on("click", ".toggle-status", function (e) {
        e.preventDefault();
        let url = $(this).data("url");
        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data.status == "1") {
                    $("#payment-method-table")
                        .DataTable()
                        .ajax.reload(null, false);
                    toastr.success("Status Change Successfully");
                }
            },
        });
    });
});
