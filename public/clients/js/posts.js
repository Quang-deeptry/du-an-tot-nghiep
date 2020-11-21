$(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#button-search").click(function (e) {
        e.preventDefault();
        let year = $("#year").find("option:selected").val();
        let month = $("#month").find("option:selected").val();
        let category = $("#category").find("option:selected").val();

        window.location.href =
            window.location.origin +
            "/news/q/" +
            year +
            "/" +
            month +
            "/" +
            category;
    });
});
