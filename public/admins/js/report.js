$(document).ready(function () {
    var table = $("#order-report-table").DataTable();

    $("#filter").click(function () {
        table.draw();
    });

    $("#reset").click(function () {
        $("#start_date").val("");
        $("#end_date").val("");

        table.draw();
    });
    $(document).on("click", "#export_pdf", function () {
        $(".buttons-pdf").click();
    });
});
