$(document).ready(function () {
    // alert();
   $('#add_outlet_form').validate({
       rules: {
           name: {
               required: true,
               maxlength: 255
           },
           email: {
            required: true,
            email:    true,
            remote: {
                url:  base_url + "/check_email",
                type: "POST",
                data: {
                    _token:   $('meta[name="csrf-token"]').attr("content"),
                    email:    function () { return $("#email").val(); },
                    staff_id: function () { return $("#staff_id").val() || null; }
                }
            }
        },
           password: {
               required: true,
           },
           phone: {
               required: true,
               number: true,
               minlength: 10,
               maxlength: 10
           },
           address:{
               required: true,
           },
           city: {
               required: true,
           },

       },

       messages: {
           name: {
               required: "Please enter item name",
               maxlength: "Name too long"
           },
           email: {
            required: "Please enter email",
            email:    "Please enter a valid email",
            remote:   "Email already exists"
        },
           password: {
               required: "Please enter password",
           },
           phone: {
               required: "Please enter phone number",
               number: "Please enter a valid phone number",
               minlength: "Please enter a valid phone number",
               maxlength: "Please enter a valid phone number",
           },
           address: {
               required: "Please enter address",
           },
           city: {
               required: "Please enter city",
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
          success: function (label, element) {
        $(element).removeClass("is-invalid");
        label.remove();
    },

    errorPlacement: function (error, element) {
        // ✅ remove duplicate errors first
        element.siblings(".invalid-feedback").remove();

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

$(document).on("click", ".delete-outlet", function () {
    // alert();
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
                    $('#staff-table').DataTable().ajax.reload(null, false);
                    toastr.success('Table Removed Successfully')
                },
                error: function () {
                    toastr.error('Table Not Removed Successfully')

                }
            });
        }
    });
});

});
