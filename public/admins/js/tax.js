$(document).ready(function () {
    $('#add_tax_form,#edit_tax_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            percentage: {
                required: true,
                number: true,
                min: 0,
                max: 100
            },
        },

        messages: {
            name: {
                required: "Please enter item name",
                maxlength: "Name too long"
            },
            percentage: {
                required: "Please enter percentage",
                number: "Please enter a valid percentage",
                min: "Percentage should be greater than 0",
                max: "Percentage should be less than 100"
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
        },
        submitHandler: function (form) {
            $(form).find('button[type="submit"]').prop('disabled', true);
            form.submit();
        }

    });

    $(document).on('click', '.delete-tax', function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.status == '1') {
                            // Swal.fire({
                            //     title: 'Deleted!',
                            //     text: name + ' has been deleted.',
                            //     icon: 'success',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // })
                            $('#tax-table').DataTable().ajax.reload(null, false);
                            toastr.success('Tax Delete Successfully');
                        }
                    }
                })
            }
        })
    })
});
