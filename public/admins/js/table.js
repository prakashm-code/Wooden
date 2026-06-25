$(document).on("click", ".delete-table", function () {
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
                    $('#tax-table').DataTable().ajax.reload(null, false);
                    toastr.success('Table Removed Successfully')
                },
                error: function () {
                    toastr.error('Table Not Removed Successfully')

                }
            });
        }
    });
});
// alert();
